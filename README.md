# Laravel Backend Component

[![Tests](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/run-tests.yml/badge.svg)](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/run-tests.yml) [![PHPStan](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/phpstan.yml/badge.svg)](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/phpstan.yml) [![Laravel Pint](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/fix-php-code-style-issues.yml)

A package that simplifies the creation of Laravel components using PHP classes.

[Documentation](https://github.com/Chat-Agency/backend-component-docs)

## Installation

Install the package via Composer:

```bash
composer require chat-agency/laravel-backend-component
```
To use the package’s `Tailwind` themes, add the assets’ path to the configuration file:

```javascript
export default {
    content: [
        './vendor/chat-agency/laravel-backend-component/resources/views/**/*.blade.php', // <- this line
        // other paths
    ],
    // ...
};
```

## Basic use

Use the MainBackendComponent class to construct your component. Pass the component name/path as the first parameter:

```php
use ChatAgency\BackendComponents\MainBackendComponent;

$button = new MainBackendComponent("inline.button");
```
Alternatively, builders and an enum are available to streamline instance creation:

```php
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;

$button = ComponentBuilder::make(ComponentEnum::BUTTON);
```
Since the main component class implements Laravel’s [Htmlable](https://laravel.com/api/8.x/Illuminate/Contracts/Support/Htmlable.html) interface, you can output the component using simple Blade syntax—no escaping needed:

```blade
{{ $button }}
```

## Tailwind Theming

The package also supports theming, primarily for Tailwind classes.

All themes are stored inside `resources/views/` by default, ensuring seamless Tailwind class discovery

```php
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;

$button = ComponentBuilder::make(ComponentEnum::BUTTON)
    ->setTheme('theme_file', 'theme_name');
```

# Tests

Run tests using Composer:

```
composer test
```

If you're submitting a pull request, use the `qa` command—it runs `phpstan`, `pint`, and `tests`. These are the same checks performed in GitHub Actions

```
composer qa 
```

# License

This package is licensed under the [MIT License](https://choosealicense.com/licenses/mit/#).