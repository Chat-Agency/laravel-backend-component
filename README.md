# Laravel Backend Component

[![Tests](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/run-tests.yml/badge.svg)](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/run-tests.yml)

[![PHPStan](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/phpstan.yml/badge.svg)](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/phpstan.yml)

[![Laravel Pint](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/Chat-Agency/laravel-backend-component/actions/workflows/fix-php-code-style-issues.yml)



Backend Components is a package that facilitates the creation of Laravel components using PHP classes.

[Documentation](https://github.com/Chat-Agency/backend-component-docs)

## Installation

```bash
composer require chat-agency/laravel-backend-component
```

To use the package’s `Tailwind` themes, you need to include the assets’ path to the configuration file:

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

Use the MainBackendComponent class to construct your component. Pass the name of the component as the first parameter:

```php
use ChatAgency\BackendComponents\MainBackendComponent;

$button = new MainBackendComponent("inline.button");
```

Alternatively, there’s a builder and an enum that make creating instances easier:

```php
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\MainBackendComponent;

$button = ComponentBuilder::make(ComponentEnum::BUTTON);
```
Since the main component class implements the Laravel [Htmlable](https://laravel.com/api/8.x/Illuminate/Contracts/Support/Htmlable.html) interface, you can output the component using simple Blade syntax. No escaping needed:

```blade
{{ $button }}
```

# Tests

Tests can be run using composer:
```
composer test
```

If your're planning on doing a pull request you should use the `qa` command. It runs `phpstan`, `pint` and `tests`. These are the same commands used on the Github `actions`.

```
composer qa 
```

## License

This package is licensed with the [MIT License](https://choosealicense.com/licenses/mit/#).