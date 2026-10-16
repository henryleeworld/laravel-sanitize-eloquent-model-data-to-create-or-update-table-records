<?php

namespace App\Builder;

use Closure;
use Illuminate\Database\Eloquent\Builder as BaseBuilder;

class SanitizableQueryBuilder extends BaseBuilder
{
    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  (\Closure(): array)|array  $values
     * @return TModel
     */
    public function updateOrCreate(array $attributes, Closure|array $values = [])
    {
        return parent::updateOrCreate($attributes, $this->model->sanitizeToModelFillable($values));
    }

    /**
     * Get the first record matching the attributes. If the record is not found, create it.
     *
     * @param  array  $attributes
     * @param  (\Closure(): array)|array  $values
     * @return TModel
     */
    public function firstOrCreate(array $attributes = [], Closure|array $values = [])
    {
        return parent::firstOrCreate($attributes, $this->model->sanitizeToModelFillable($values));
    }

    /**
     * Get the first record matching the attributes or instantiate it.
     *
     * @param  array  $attributes
     * @param  (\Closure(): array)|array  $values
     * @return TModel
     */
    public function firstOrNew(array $attributes = [], Closure|array $values = [])
    {
        return parent::firstOrNew($attributes, $this->model->sanitizeToModelFillable($values));
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return TModel
     */
    public function create(array $attributes = [])
    {
        return parent::create($this->model->sanitizeToModelFillable($attributes));
    }

    /**
     * Save a new model and return the instance. Allow mass-assignment.
     *
     * @param  array  $attributes
     * @return TModel
     */
    public function forceCreate(array $attributes)
    {
        return parent::forceCreate($this->model->sanitizeToModelFillable($attributes));
    }

    /**
     * Update records in the database.
     *
     * @param  array  $values
     * @return int
     */
    public function update(array $values)
    {
        return parent::update($this->model->sanitizeToModelFillable($values));
    }
}