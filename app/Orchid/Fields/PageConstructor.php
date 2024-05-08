<?php

declare(strict_types=1);

namespace App\Orchid\Fields;
use Orchid\Screen\Field;

class PageConstructor extends Field {
    protected $view = 'fields.editor';

    protected $attributes = [
        'readOnly' => false,
        'containerid' => 'editorjs'
    ];

    protected $inlineAttributes = [
        'title',
        'name',
        'readonly'
    ];
}