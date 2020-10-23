# Laravel Nova Carbon Modifier Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/illizian/nova-emoji-field-container.svg)](https://packagist.org/packages/illizian/nova-emoji-field-container)
[![License](https://img.shields.io/packagist/l/Illizian/nova-emoji-field-container.svg)](https://github.com/Illizian/nova-emoji-field-container/blob/master/LICENSE.md)

## Description

A Laravel Nova field that add's an emoji picker to a sub field.

### Demo

![Demo](https://raw.githubusercontent.com/Illizian/nova-emoji-field-container/main/docs/nova-emoji-field-container-demo.gif)

### Installation

The package can be installed through Composer.

```bash
composer require illizian/nova-emoji-field-container
```

## Usage

Add a `\Illizian\NovaEmojiFieldContainer\NovaEmojiFieldContainer`, field to your fields, like so:

```php
/* ... */
use \Illizian\NovaEmojiFieldContainer\NovaEmojiFieldContainer;
/* ... */

class Example extends Resource
{
    /* ... */
    public function fields(Request $request)
    {
        return [
            /* ... */
            NovaEmojiFieldContainer::make([
                Textarea::make(__('Message'), 'message'),
            ]),
        ];
    }
```

## License

The MIT License (MIT). Please see [License File](https://github.com/Illizian/nova-emoji-field-containerblob/main/LICENSE.md) for more information.
