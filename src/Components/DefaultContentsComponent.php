<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components;

use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\ContentsComponent;
use Illuminate\Contracts\Support\Htmlable;

use function ChatAgency\BackendComponents\backendComponentNamespace;
use function ChatAgency\BackendComponents\isComponent;

final class DefaultContentsComponent implements ContentsComponent, Htmlable
{
    /**
     * @param  array<string|int, string|int|CompoundComponent>  $contents
     */
    public function __construct(
        private array $contents
    ) {}

    public function toHtml()
    {
        /** @var non-falsy-string $view */
        $view = backendComponentNamespace().'_utilities.resolve-content';

        /**
         * PHPStan bug
         * https://github.com/larastan/larastan/issues/2213
         *
         * @phpstan-ignore argument.type
         */
        return view($view)
            ->with('contents', $this->contents)
            ->render();

    }

    /**
     * @return array<int|string, string|int|array<string, array<mixed>|bool|string|null>>
     */
    public function toArray(): array
    {
        $contentArray = [];

        foreach ($this->contents as $key => $content) {
            $contentArray[$key] = isComponent($content) ? $content->toArray() : $content;
        }

        return $contentArray;
    }
}
