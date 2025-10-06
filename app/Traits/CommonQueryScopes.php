<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait CommonQueryScopes
{
    /**
     * Scope to filter results by a date column.
     */
    public function scopeFilterByDate(Builder $query, ?string $date, string $column = 'date'): Builder
    {
        if ($date) {
            $query->whereDate($column, $date);
        }

        return $query;
    }

    /**
     * Scope to search results by title column.
     */
    public function scopeSearchByTitle(Builder $query, ?string $title, string $column = 'title'): Builder
    {
        if ($title) {
            $query->where($column, 'like', "%{$title}%");
        }

        return $query;
    }
}
