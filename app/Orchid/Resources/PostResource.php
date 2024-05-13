<?php

namespace App\Orchid\Resources;

use App\Models\Posttype;
use App\Orchid\Fields\PageConstructor;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Illuminate\Http\Request;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layout;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class PostResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Post::class;

    public static function singularLabel(): string
    {
        return 'Страница';
    }

    public static function label(): string
    {
        return 'Страницы';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')->title('Название поста'),
            TextArea::make('description')->title('Описание поста')->rows(5),
            Relation::make('posttype_id')->fromModel(Posttype::class, 'name')->title('Тип поста'),
            PageConstructor::make('editor'),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('name', 'Название'),
            TD::make('posttype', 'Тип поста')->render(function($model) {
                return $model->posttype->name;
            }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('name', 'Название'),
            Sight::make('posttype_id', 'Тип поста')->render(function($model) {
                return $model->posttype->name;
            }),
            Sight::make('description', 'Описание'),
            Sight::make('content', 'Набор полей')->render(function($model) {
                return $model->content;
            }),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Action to create and update the model
     *
     * @param ResourceRequest $request
     * @param Model           $model
     */
    public function onSave(ResourceRequest $request, Model $model)
    {
        dd($request->all());
        // $model->forceFill($request->all())->save();
    }
}
