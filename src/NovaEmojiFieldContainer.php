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
}
