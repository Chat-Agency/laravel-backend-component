<?php

namespace Tests\Feature\Components\Form;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class FieldsetTest extends TestCase
{
    /** @test */
    public function simple_fieldset()
    {
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET);

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
        ->assertSee('<fieldset', false);
    }

    /** @test */
    public function fieldset_accepts_content()
    {
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('Span content')
            );

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
        ->assertSee('<fieldset', false)
        ->assertSee('Span content')
        ->assertSee('</fieldset>', false);
    }

    
    /** @test */
    public function fieldset_accepts_attributes()
    {
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setAttribute('for', 'fieldset_for');

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
        ->assertSee('for="fieldset_for"', false);
    }

    /** @test */
    public function fieldset_accepts_sub_components()
    {
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('First span'),
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Second span'),
            ]);

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
        ->assertSee('<span', false)
        ->assertSee('First span')
        ->assertSee('</span>', false)
        ->assertSee('Second span');
        
    }

    /** @test */
    public function fieldset_accepts_theme()
    {
        $theme = [
            'color' =>  'default',
        ];
        
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setThemes($theme);
        
        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}
