<?php

declare(strict_types=1);

namespace App\Orchid\Fields;
use App\Models\Template;
use Orchid\Screen\Field;

class PageConstructor extends Field {
    protected $view = 'fields.editor';

    protected $attributes = [
        'readOnly' => false,
        'containerid' => 'editorjs',
        'blocksData' => []
    ];

    protected $inlineAttributes = [
        'title',
        'name',
        'readonly'
    ];
}