<?php

namespace App\Orchid\Resources;

use App\Models\Post;
use App\Models\Posttype;
use App\Orchid\Fields\EditorJSField;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Relation;

class FieldResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Field::class;

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
        return [
            Input::make('name')->title('Название набора'),
            Select::make('select')
                ->options([
                    'index'   => 'Пост',
                    'noindex' => 'Глобально',
                ])
                ->title('Область видимости'),

            Relation::make('display')
                ->fromModel(Post::class, 'name')
                ->title('Отобразить на страницах'),

            EditorJSField::make('editor')
                ->containerid('editorjs')
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
            TD::make('type', 'Видимость')
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
}
