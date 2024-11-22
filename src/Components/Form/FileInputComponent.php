<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Components\Form;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Arrayable;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Concerns\IsThemeable;
use ChatAgency\BackendComponents\Contracts\ThemeManager;
use ChatAgency\BackendComponents\Contracts\ThemeComponent;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use ChatAgency\BackendComponents\Concerns\IsBackendComponent;
use ChatAgency\BackendComponents\Components\DefaultAttributeBag;

use function ChatAgency\BackendComponents\backendComponentNamespace;

class FileInputComponent implements Arrayable, BackendComponent, Htmlable, ThemeComponent
{
    use IsBackendComponent,
        IsThemeable;

    public function __construct(
        private ThemeManager $themeManager = new DefaultThemeManager
    ) {}

    public function toArray(): array
    {
        return [
            'attributes' => $this->getAttributes(),
            'themes' => $this->compileTheme(),
        ];
    }

    public function toHtml()
    {
        return view(
            backendComponentNamespace()
                .'components.'
                .ComponentEnum::FILE_INPUT->value
        )
            ->with(
                'attrs',
                new DefaultAttributeBag(
                    attributes: $this->getAttributes(),
                    themes: $this->compileTheme()
                )
            )
            ->render();

    }
}
