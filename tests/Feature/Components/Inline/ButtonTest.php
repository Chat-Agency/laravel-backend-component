<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ButtonTest extends TestCase
{
    #[Test]
    public function simple_button()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON);

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
            ->assertSee('<button', false)
            ->assertSee('</button>', false);
    }

    #[Test]
    public function button_accepts_content()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Span content')
            );

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
            ->assertSee('<button ', false)
            ->assertSee('<span', false)
            ->assertSee('Span content')
            ->assertSee('</span>', false)
            ->assertSee('</button>', false);
    }

    #[Test]
    public function button_accepts_attributes()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button')
            ->setAttribute('type', 'submit');

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
            ->assertSee('<button', false)
            ->assertSee('type="submit"', false)
            ->assertSee('</button>', false);
    }

    #[Test]
    public function button_accepts_sub_components()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button')
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Inside span'),
            ]);

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
            ->assertSee('<button', false)
            ->assertSee('<span', false)
            ->assertSee('</span>', false)
            ->assertSee('Inside span')
            ->assertSee('</button>', false);

    }

    #[Test]
    public function button_accepts_theme()
    {
        $theme = [
            'action' => 'default',
        ];

        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button')
            ->setThemes($theme);

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
            ->assertSee('<button', false)
            ->assertSee('class="'.bladeThemes($theme), false)
            ->assertSee('</button>', false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
