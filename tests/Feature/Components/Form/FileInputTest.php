<?php

namespace Test\Feature\Components\Form;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class FileInputTest extends TestCase
{
    /** @test */
    public function simple_file_input()
    {
        $input = ComponentBuilder::make(ComponentEnum::FILE_INPUT);

        $this->blade('{{ $input }}', [
            'input' => $input,
        ])
        ->assertSee('<input type="file"', false)
        ->assertSee('/>', false);
    }

    /** @test */
    public function file_input_does_not_accepts_content()
    {
        $input = ComponentBuilder::make(ComponentEnum::FILE_INPUT)
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
    public function file_input_accepts_attributes()
    {
        $form = ComponentBuilder::make(ComponentEnum::FILE_INPUT)
            ->setAttribute('id', 'input_id');

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertSee('id="input_id"', false);
    }
    
    /** @test */
    public function file_input_does_not_accept_value_attribute()
    {
        $form = ComponentBuilder::make(ComponentEnum::FILE_INPUT)
            ->setAttribute('value', 'Input');

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertDontSee('value="Input"', false);
    }

    /** @test */
    public function file_input_accepts_sub_components()
    {
        $form = ComponentBuilder::make(ComponentEnum::FILE_INPUT)
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
    public function file_input_accepts_theme()
    {
        $theme = [
            'display' =>  'inline-block',
        ];
        
        $input = ComponentBuilder::make(ComponentEnum::FILE_INPUT)
            ->setThemes($theme);
        
        $this->blade('{{ $input }}', [
            'input' => $input,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}