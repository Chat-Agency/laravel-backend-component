<?php

namespace Tests\Feature\Components\Form;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

class LegendTest extends TestCase
{
    #[Test]
    public function simple_legend()
    {
        $legend = ComponentBuilder::make(ComponentEnum::LEGEND);

        $this->blade('{{ $legend }}', [
            'legend' => $legend,
        ])
            ->assertSee('<legend', false);
    }

    #[Test]
    public function legend_accepts_content()
    {
        $legend = ComponentBuilder::make(ComponentEnum::LEGEND)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('Span content')
            );

        $this->blade('{{ $legend }}', [
            'legend' => $legend,
        ])
            ->assertSee('<legend', false)
            ->assertSee('Span content')
            ->assertSee('</legend>', false);
    }

    #[Test]
    public function legend_accepts_attributes()
    {
        $legend = ComponentBuilder::make(ComponentEnum::LEGEND)
            ->setAttribute('for', 'legend_for');

        $this->blade('{{ $legend }}', [
            'legend' => $legend,
        ])
            ->assertSee('for="legend_for"', false);
    }

    #[Test]
    public function legend_accepts_sub_components()
    {
        $legend = ComponentBuilder::make(ComponentEnum::LEGEND)
            ->setChildren([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('First span'),
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Second span'),
            ]);

        $this->blade('{{ $legend }}', [
            'legend' => $legend,
        ])
            ->assertSee('<span', false)
            ->assertSee('First span')
            ->assertSee('</span>', false)
            ->assertSee('Second span');

    }

    #[Test]
    public function legend_accepts_theme()
    {
        $theme = [
            'color' => 'default',
        ];

        $legend = ComponentBuilder::make(ComponentEnum::LEGEND)
            ->setThemes($theme);

        $this->blade('{{ $legend }}', [
            'legend' => $legend,
        ])
            ->assertSee('class="'.getThemes($theme), false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
