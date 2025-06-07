<?php

namespace App\Orchid\Screens\PostType;

use App\Models\PostType;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Color;

class PostTypeListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'postTypes' => PostType::filters()->defaultSort('id', 'desc')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Типы записей';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать')
                ->icon('plus')
                ->route('platform.posttype.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('postTypes', [
                TD::make('id'),
                TD::make('name', 'Название')
                    ->render(fn (PostType $postType) => Link::make($postType->name)
                        ->route('platform.posttype.edit', [$postType->id])),
                TD::make('slug', 'Slug'),
                TD::make('visibility', 'Видимость')
                    ->render(function(PostType $postType) {
                        return ($postType->visibility === 'global')
                            ? 'Сквозной'
                            : 'Локальный';
                    }),
                TD::make(__('Действия'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (PostType $postType) {
                        return Group::make([
                            Link::make('Редактировать')
                                ->icon('pencil')
                                ->route('platform.posttype.edit', [$postType->id]),
                            ModalToggle::make('Удалить')
                                ->icon('trash')
                                ->modal('removePostTypeModal')
                                ->method('removePostType')
                                ->modalTitle('Удаление типа страницы')
                                ->asyncParameters([
                                    'postType' => $postType->id
                                ])
                        ]);
                    }),
            ]),

            Layout::modal('removePostTypeModal', [
                    Layout::rows([
                        Select::make('new_posttype_id')
                            ->title('К какому типу перепривязать страницы?')
                            ->fromQuery(
                                PostType::query()->where('id', '!=', request('postType')), 
                                'name', 
                                'id'
                            )
                            ->help('Страницы будут перемещены в выбранный тип')
                            ->empty(false)
                            ->required()
                    ])
                ])
                ->applyButton('Удалить')
                ->closeButton('Отмена')
                ->async('asyncGetPostType')
        ];
    }

    /**
     * @param Request $request
     */
    public function removePostType(Request $request): void
    {
        $postType = PostType::findOrFail($request->get('postType'));
        $newPostTypeId = $request->input('new_posttype_id');
        
        // Если есть новый тип страницы, перемещаем все страницы в него
        if ($newPostTypeId) {
            $postType->posts()->update(['posttype_id' => $newPostTypeId]);
            Toast::success('Страницы перемещены в другой тип');
        } else {
            // Если нового типа нет, удаляем страницы
            $postType->posts()->delete();
            Toast::info('Связанные страницы удалены');
        }
        
        // Удаляем сам тип страницы
        $postType->delete();
        
        Toast::success('Тип страницы успешно удален');
    }

    /**
     * @param Request $request
     */
    public function reassignPosts(Request $request): void
    {
        $oldPostType = PostType::findOrFail($request->get('id'));
        $newPostTypeId = $request->get('new_posttype_id');
        
        // Перемещаем все страницы в новый тип
        $oldPostType->posts()->update(['posttype_id' => $newPostTypeId]);
        
        // Удаляем старый тип страницы
        $oldPostType->delete();
        
        Toast::success('Страницы успешно перемещены, старый тип страницы удален');
    }
    
    public function asyncGetPostType(PostType $postType)
    {
        $filteredPostTypes = PostType::where('id', '!=', $postType->id)->get();
        $output = $filteredPostTypes->map(function($postType) {
            return [
                'id' => $postType->id,
                'text' => $postType->name
            ];
        })->toArray();

        return [
            'filteredPostTypes' => $output
        ];
    }
} 