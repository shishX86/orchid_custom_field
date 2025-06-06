<?php

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use App\Models\Posttype;
use App\Orchid\Fields\PageConstructor;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Str;

class PostScreen extends Screen
{
    /**
     * @var Post
     */
    public $post;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Post $post): iterable
    {
        if (!$post->exists && request()->has('posttype')) {
            $post->posttype_id = request()->get('posttype');
        }

        return [
            'post' => $post
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->post->exists ? 'Редактирование страницы' : 'Создание страницы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        $saveButton = $this->post->exists ? 'Обновить' : 'Создать';

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
                Input::make('post.name')
                    ->title('Название страницы')
                    ->required(),
                
                Input::make('post.slug')
                    ->title('Уникальный идентификатор')
                    ->required(),

                TextArea::make('post.description')
                    ->title('Описание страницы')
                    ->rows(5),

                Relation::make('post.posttype_id')
                    ->fromModel(Posttype::class, 'name')
                    ->title('Тип страницы')
                    ->required(),

                PageConstructor::make('post.editor')
                    ->title('Конструктор страницы')
            ])
        ];
    }

    /**
     * @param Post $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Post $post, Request $request)
    {
        $data = $request->get('post');
        
        $post->fill([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'posttype_id' => $data['posttype_id'],
            'content' => $data['editor'] ?? '[]',
            'slug' => Str::slug($data['slug'])
        ]);

        if (!$post->exists) {
            $post->save();
        } else {
            $post->update();
        }

        return redirect()->route('platform.post.list');
    }
} 