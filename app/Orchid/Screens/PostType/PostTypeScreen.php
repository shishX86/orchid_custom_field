<?php

namespace App\Orchid\Screens\PostType;

use App\Models\PostType;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Illuminate\Support\Str;

class PostTypeScreen extends Screen
{
    /**
     * @var PostType
     */
    public $postType;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(PostType $postType): iterable
    {
        return [
            'postType' => $postType
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->postType->exists ? 'Редактирование типа записи' : 'Создание типа записи';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        $saveButton = $this->postType->exists ? 'Обновить' : 'Создать';

        return [
            Button::make($saveButton)
                ->icon('save')
                ->method('createOrUpdate')
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
            Layout::rows([
                Input::make('postType.name')
                    ->title('Название')
                    ->placeholder('Введите название типа записи')
                    ->help('Название типа записи')
                    ->required(),

                Input::make('postType.slug')
                    ->title('Slug')
                    ->placeholder('Введите slug')
                    ->help('Уникальный идентификатор типа записи')
                    ->required(),
            ])
        ];
    }

    /**
     * @param PostType $postType
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(PostType $postType, Request $request)
    {
        $data = $request->get('postType');
        
        $postType->fill([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'visibility' => $data['visibility'] ?? 'local',
            'description' => $data['description'] ?? null
        ]);

        if (!$postType->exists) {
            $postType->save();
        } else {
            $postType->update();
        }

        return redirect()->route('platform.posttype.list');
    }
} 