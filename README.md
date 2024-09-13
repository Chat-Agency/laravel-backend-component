# Laravel Backend Component

Backend Components is a package that facilitates the creation of Laravel components using PHP classes.

[Documentation](https://github.com/Chat-Agency/backend-component-docs)

## Installation

```bash
composer require chat-agency/laravel-backend-component
```

## Basic use

Use the MainBackendComponent class to construct your component. Pass the name of the component as the first parameter:

```php
use ChatAgency\LaravelBackendComponents\MainBackendComponent;

$button = new MainBackendComponent("inline.button");
```

Alternatively, there’s a builder and an enum that make creating instances easier:

```php
use ChatAgency\LaravelBackendComponents\Enums\ComponentEnum;
use ChatAgency\LaravelBackendComponents\MainBackendComponent;

$button = ComponentBuilder::make(ComponentEnum::BUTTON);
```
Since the main component class implements the Laravel [Htmlable](https://laravel.com/api/8.x/Illuminate/Contracts/Support/Htmlable.html) interface, you can output the component using simple Blade syntax without the need for unescaped data syntax:

```blade
{{ $button }}
```
