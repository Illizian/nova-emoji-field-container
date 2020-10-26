<?php

namespace Illizian\NovaEmojiFieldContainer;

use Laravel\Nova\Fields\Field;

class NovaEmojiFieldContainer extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-emoji-field-container';

    /**
     * @var array
     */
    public $fields;

    /**
     * Create a new field.
     *
     * @param string|callable|null $attribute
     * @param array $fields
     */
    public function __construct(array $fields = [])
    {
        $this->withMeta(['fields' => $fields]);
    }

    /**
     * Resolve the field's value.
     *
     * @param mixed $resource
     * @param string|null $attribute
     * @return void
     */
    public function resolve($resource, $attribute = null) : void
    {
        foreach ($this->meta['fields'] as $field) {
            $field->resolve($resource, $attribute);
        }
    }

    /**
     * Get the validation rules for this field.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function getRules(NovaRequest $request) : array
    {
        $rules = parent::getRules($request);

        foreach ($this->meta['fields'] as $field) {
            $rules = array_merge($rules, $field->getRules($request));
        }

        return $rules;
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param NovaRequest $request
     * @param Model $model
     * @return void
     */
    public function fill(NovaRequest $request, $model) : void
    {
        foreach ($this->meta['fields'] as $field) {
            $field->fill($request, $model);
        }
    }

    /**
     * Prepare the field for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize() : array
    {
        return array_merge([ 'fields' => $this->meta['fields'] ], parent::jsonSerialize());
    }
}
