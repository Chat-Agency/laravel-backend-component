<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components;

use ChatAgency\BackendComponents\Concerns\IsLivewireComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;

class DefaultLivewireComponent implements Htmlable, LivewireComponent
{
    use IsLivewireComponent;

    /**
     * @param  class-string  $name
     */
    public function __construct(
        private string $name
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function toHtml(): string
    {
        /**
         * PHPStan bug
         * https://github.com/larastan/larastan/issues/2213
         *
         * @phpstan-ignore argument.type
         */
        return view(backendComponentNamespace().'_utilities.resolve-livewire-component', [
            'component' => $this,
        ])->render();
    }
}
