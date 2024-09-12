# Laravel Backend Component

Backend Components is a package that helps creating Laravel component using PHP classes.

[Documentation](https://github.com/Chat-Agency/backend-component-docs)

## Installation

```bash
composer require chat-agency/laravel-backend-component
```

## Basic use

Use the MainBackendComponent to construct the compoennt, passing the name of the component as a first parameter.

```php
use ChatAgency\LaravelBackendComponents\MainBackendComponent;

$button = new MainBackendComponent("inline.button");
```

Alternative, there are multiple builders and enums to make creating an instance easier.

```php
use ChatAgency\LaravelBackendComponents\Enums\ComponentEnum;
use ChatAgency\LaravelBackendComponents\MainBackendComponent;

$button = ComponentBuilder::make(ComponentEnum::BUTTON);
```

Since the main component class implements the Laravel [Htmlable](https://laravel.com/api/8.x/Illuminate/Contracts/Support/Htmlable.html) interface, the component can be outputted using simple blade without the need to use the unescaped data sintax.

```blade
{{ $button }}
```
