<?php

namespace Test\Feature\Components\Form;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

class RadioInputTest extends TestCase
{
    #[Test]
    public function simple_radio_input()
    {
        $input = ComponentBuilder::make(ComponentEnum::RADIO_INPUT);

        $this->blade('{{ $input }}', [
            'input' => $input,
        ])
            ->assertSee('<input type="radio"', false)
            ->assertSee('/>', false);
    }

    #[Test]
    public function radio_input_does_not_accepts_content()
    {
        $input = ComponentBuilder::make(ComponentEnum::RADIO_INPUT)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('This is a span')
            );

        $this->blade('{{ $input }}', [
            'input' => $input,
        ])
            ->assertDontSee('<span', false)
            ->assertDontSee('This is a span')
            ->assertDontSee('</span>', false);
    }

    #[Test]
    public function radio_input_accepts_attributes()
    {
        $form = ComponentBuilder::make(ComponentEnum::RADIO_INPUT)
            ->setAttribute('id', 'input_id')
            ->setAttribute('value', 'Input');

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
            ->assertSee('id="input_id"', false)
            ->assertSee('value="Input"', false);
    }

    #[Test]
    public function radio_input_accepts_sub_components()
    {
        $form = ComponentBuilder::make(ComponentEnum::RADIO_INPUT)
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Nice Span'),
            ]);

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
            ->assertDontSee('<span', false)
            ->assertDontSee('Nice Span')
            ->assertDontSee('</span>', false);

    }

    #[Test]
    public function radio_input_accepts_theme()
    {
        $theme = [
            'display' => 'inline-block',
        ];

        $input = ComponentBuilder::make(ComponentEnum::RADIO_INPUT)
            ->setThemes($theme);

        $this->blade('{{ $input }}', [
            'input' => $input,
        ])
            ->assertSee('class="'.getThemes($theme), false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
