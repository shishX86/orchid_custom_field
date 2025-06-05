<?php

namespace App\Orchid\Screens\PostType;

use App\Models\PostType;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

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
                            Button::make('Удалить')
                                ->icon('trash')
                                ->confirm('Вы уверены, что хотите удалить этот тип записи?')
                                ->method('remove', ['id' => $postType->id])
                        ]);
                    }),
            ])
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        $postType = PostType::findOrFail($request->get('id'));
        
        // Удаляем все связанные записи
        $postType->posts()->delete();
        
        // Теперь можно удалить сам тип записи
        $postType->delete();
    }
} 