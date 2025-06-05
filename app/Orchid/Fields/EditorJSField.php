<?php

declare(strict_types=1);

namespace App\Orchid\Fields;
use Orchid\Screen\Field;

class EditorJSField extends Field {
    protected $view = 'fields.vue-editor';

    protected $attributes = [
        'initialData' => false,
        'containerid' => 'editorjs'
    ];
}