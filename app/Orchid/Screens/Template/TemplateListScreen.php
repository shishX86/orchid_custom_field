<?php

namespace App\Orchid\Screens\Template;

use App\Models\Template;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class TemplateListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'templates' => Template::filters()->defaultSort('id', 'desc')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Компоненты';
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
                ->route('platform.template.edit')
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
            Layout::table('templates', [
                TD::make('id'),
                TD::make('name', 'Название')
                    ->render(fn (Template $template) => Link::make($template->name)
                        ->route('platform.template.edit', $template)),
                TD::make('visibility', 'Видимость')
                    ->render(function(Template $template) {
                        return ($template->visibility === 'global')
                            ? 'Сквозной'
                            : 'Локальный';
                    }),
                TD::make(__('Действия'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Template $template) {
                        return Button::make('Удалить')
                            ->icon('trash')
                            ->confirm('Вы уверены, что хотите удалить этот компонент?')
                            ->method('remove', ['id' => $template->id]);
                    }),
            ])
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request, Template $template): void
    {
        $template = Template::findOrFail($request->get('id'));
        
        // Удаляем все связи с постами
        $template->posts()->detach();
        
        // Теперь можно удалить сам шаблон
        $template->delete();
    }
} 