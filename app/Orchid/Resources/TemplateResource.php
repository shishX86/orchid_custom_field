<?php

namespace App\Orchid\Resources;

use App\Models\Post;
use App\Models\Posttype;
use App\Orchid\Fields\EditorJSField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;

class TemplateResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Template::class;

    public static function singularLabel(): string
    {
        return 'Компонент';
    }

    public static function label(): string
    {
        return 'Компоненты';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        $model = self::$model::find(request('id'));

        return [
            Input::make('name')->title('Название набора'),
            Input::make('slug')->title('Уникальный идентификатор'),
            Select::make('visibility')
                ->options([
                    'local'   => 'Локальный',
                    'global' => 'Сквозной',
                ])
                ->title('Область видимости'),
            
            // Select::make('posttypes')
            //     ->fromModel(Posttype::class, 'name')
            //     ->empty('На всех')
            //     ->title('Отображать на типах страниц'),

            Select::make('posts2')
                ->fromModel(Post::class, 'name')
                ->empty('На всех')
                ->title('Отображать на конкретных страницах'),

            EditorJSField::make('content')
                ->containerid('templateEditor')
                ->initialData($model->content)
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
            TD::make('slug', 'Уникальный идентификатор'),
            TD::make('visibility', 'Видимость')
                ->render(function($model) {
                    return ($model->visibility === 'global')
                        ? 'Сквозной'
                        : 'Локальный';
                })
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [];
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

    public function onSave(ResourceRequest $request, Model $model)
    {
        $data = $request->all();
        $model->slug = Str::slug($data['slug']);
        $model->name = $data['name'];
        $model->visibility = $data['visibility'] ?? null;
        $model->content = $data['content'];
        $model->save();
    }
}
