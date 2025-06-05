<?php

namespace App\Orchid\Screens\Template;

use App\Models\Template;
use App\Orchid\Fields\EditorJSField;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Str;

class TemplateScreen extends Screen
{
    /**
     * @var Template
     */
    public $template;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Template $template): iterable
    {
        return [
            'template' => $template
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->template->exists ? 'Редактирование компонента' : 'Создание компонента';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->icon('pencil')
                ->method('save')
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
                Input::make('template.name')
                    ->title('Название набора'),
                
                Select::make('template.visibility')
                    ->options([
                        'local'   => 'Локальный',
                        'global' => 'Сквозной',
                    ])
                    ->title('Область видимости'),

                Select::make('template.posts')
                    ->fromModel(\App\Models\Post::class, 'name')
                    ->empty('На всех')
                    ->title('Отображать на конкретных страницах'),

                EditorJSField::make('template.content')
                    ->containerid('editorjs')
                    ->initialData($this->template->content ?? null)
            ])
        ];
    }

    /**
     * @param Template $template
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Template $template, Request $request)
    {
        $data = $request->get('template');
        
        $template->fill([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'visibility' => $data['visibility'] ?? null,
            'content' => $data['content']
        ])->save();

        return redirect()->route('platform.template.list');
    }
} 