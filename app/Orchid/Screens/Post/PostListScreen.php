<?php

namespace App\Orchid\Screens\Post;

use App\Models\Post;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class PostListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $query = Post::filters()->defaultSort('id', 'desc');
        
        if (request()->has('posttype')) {
            $query->where('posttype_id', request()->get('posttype'));
        }
        
        return [
            'posts' => $query->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Страницы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        $posttype = request()->get('posttype');
        
        return [
            Link::make('Создать')
                ->icon('plus')
                ->route('platform.post.create', $posttype ? ['posttype' => $posttype] : [])
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
            Layout::table('posts', [
                TD::make('id'),
                TD::make('name', 'Название')
                    ->width('400px')
                    ->render(fn (Post $post) => $post->name),
                TD::make('posttype', 'Тип страницы')
                    ->render(function(Post $post) {
                        return $post->posttype ? $post->posttype->name : '-';
                    }),
                TD::make(__('Действия'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Post $post) {
                        return Group::make([
                            Link::make('Редактировать')
                                ->icon('pencil')
                                ->route('platform.post.edit', $post),
                            Button::make('Удалить')
                                ->icon('trash')
                                ->confirm('Вы уверены, что хотите удалить эту страницу?')
                                ->method('remove', ['id' => $post->id])
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
        $post = Post::findOrFail($request->get('id'));
        
        // Удаляем связи с шаблонами
        $post->templates()->detach();
        
        // Теперь можно удалить сам пост
        $post->delete();
    }
} 