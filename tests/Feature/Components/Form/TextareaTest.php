<?php

namespace Tests\Feature\Components\Form;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class TextareaTest extends TestCase
{
    /** @test */
    public function simple_textarea()
    {
        $textarea = ComponentBuilder::make(ComponentEnum::TEXTAREA);

        $this->blade('{{ $textarea }}', [
            'textarea' => $textarea,
        ])
        ->assertSee('<textarea', false);
    }

    /** @test */
    public function textarea_accepts_content()
    {
        $textarea = ComponentBuilder::make(ComponentEnum::TEXTAREA)
            ->setContent('Textarea content');

        $this->blade('{{ $textarea }}', [
            'textarea' => $textarea,
        ])
        ->assertSee('<textarea', false)
        ->assertSee('Textarea content')
        ->assertSee('</textarea>', false);
    }

    
    /** @test */
    public function textarea_accepts_attributes()
    {
        $textarea = ComponentBuilder::make(ComponentEnum::TEXTAREA)
            ->setAttribute('for', 'textarea_for');

        $this->blade('{{ $textarea }}', [
            'textarea' => $textarea,
        ])
        ->assertSee('for="textarea_for"', false);
    }

    /** @test */
    public function textarea_does_not_accept_sub_components()
    {
        $textarea = ComponentBuilder::make(ComponentEnum::TEXTAREA)
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('First span'),
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Second span'),
            ]);

        $this->blade('{{ $textarea }}', [
            'textarea' => $textarea,
        ])
        ->assertDontSee('<span', false)
        ->assertDontSee('First span')
        ->assertDontSee('</span>', false)
        ->assertDontSee('Second span');
        
    }

    /** @test */
    public function textarea_accepts_theme()
    {
        $theme = [
            'display' =>  'block',
        ];
        
        $textarea = ComponentBuilder::make(ComponentEnum::TEXTAREA)
            ->setThemes($theme);
        
        $this->blade('{{ $textarea }}', [
            'textarea' => $textarea,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}
