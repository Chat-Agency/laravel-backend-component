<?php

namespace Test\Feature\Components\Form;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class CheckboxInputTest extends TestCase
{
    /** @test */
    public function simple_checkbox_input()
    {
        $input = ComponentBuilder::make(ComponentEnum::CHECKBOX_INPUT);

        $this->blade('{{ $input }}', [
            'input' => $input,
        ])
        ->assertSee('<input type="checkbox"', false)
        ->assertSee('/>', false);
    }

    /** @test */
    public function checkbox_input_does_not_accepts_content()
    {
        $input = ComponentBuilder::make(ComponentEnum::CHECKBOX_INPUT)
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

    
    /** @test */
    public function checkbox_input_accepts_attributes()
    {
        $form = ComponentBuilder::make(ComponentEnum::CHECKBOX_INPUT)
            ->setAttribute('id', 'input_id')
            ->setAttribute('value', 'Input');

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertSee('id="input_id"', false)
        ->assertSee('value="Input"', false);
    }

    /** @test */
    public function checkbox_input_accepts_sub_components()
    {
        $form = ComponentBuilder::make(ComponentEnum::CHECKBOX_INPUT)
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

    /** @test */
    public function checkbox_input_accepts_theme()
    {
        $theme = [
            'display' =>  'inline-block',
        ];
        
        $input = ComponentBuilder::make(ComponentEnum::CHECKBOX_INPUT)
            ->setThemes($theme);
        
        $this->blade('{{ $input }}', [
            'input' => $input,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}