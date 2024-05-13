<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;

class PostFilter extends Filter
{
    protected $slug;

    public function __construct(string $slug = 'page')
    {
        parent::__construct();

        $this->slug = $slug;
    }

    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return '';
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return [];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('posttype', function (Builder $query) {
            $query->where('slug', $this->request->get('posttype') ?? 'page');
        });
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [];
    }
}
