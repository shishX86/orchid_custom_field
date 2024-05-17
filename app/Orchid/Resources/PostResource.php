<?php

namespace App\Orchid\Resources;

use App\Models\Posttype;
use App\Orchid\Fields\PageConstructor;
use App\Orchid\Filters\PostFilter;
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
use Orchid\Support\Facades\Dashboard;

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
            TD::make('name', 'Название')->width(350),
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
            Sight::make('posttype_id', 'Тип поста')
                ->render(function($model) {
                    return $model->posttype->name;
                }),
            Sight::make('description', 'Описание'),
            Sight::make('content', 'Набор полей')->render(function($model) {
                $fields = $model->fields;
                $output = $fields->map(fn($field) => $field->name)->toArray();

                return implode(', ', $output);
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
        return [
            new PostFilter('event')
        ];
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

    /**
     * Get the resource should be displayed in the navigation
     *
     * @return bool
     */
    public static function displayInNavigation(): bool
    {
        return false;
    }
}
