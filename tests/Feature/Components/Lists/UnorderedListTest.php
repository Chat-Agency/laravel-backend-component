<?php

namespace Tests\Feature\Components\Lists;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class UnorderedListTest extends TestCase
{
    /** @test */
    public function empty_unordered_list()
    {
        $unorderedList = ComponentBuilder::make(ComponentEnum::UL);

        $this->blade('{{ $unorderedList }}', [
            'unorderedList' => $unorderedList,
        ])
        ->assertSee('<ul', false)
        ->assertSee('</ul>', false);
    }

    
    /** @test */
    public function unordered_list_accepts_content()
    {
        $unorderedList = ComponentBuilder::make(ComponentEnum::UL)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::LI)
                    ->setContent('List content')
            );

        $this->blade('{{ $unorderedList }}', [
            'unorderedList' => $unorderedList,
        ])
        ->assertSee('<li', false)
        ->assertSee('List content')
        ->assertSee('</li>', false);
    }

    
    /** @test */
    public function unordered_list_accepts_attributes()
    {
        $unorderedList = ComponentBuilder::make(ComponentEnum::UL)
            ->setAttribute('id', 'list_id');

        $this->blade('{{ $unorderedList }}', [
            'unorderedList' => $unorderedList,
        ])
        ->assertSee('id="list_id"', false);
    }

    /** @test */
    public function unordered_list_accepts_sub_components()
    {
        $unorderedList = ComponentBuilder::make(ComponentEnum::UL)
            ->setAttribute('id', 'main_list')
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::LI)
                    ->setContent('First list item'),
                ComponentBuilder::make(ComponentEnum::LI)
                    ->setContent('Second list item'),
                // nested list
                ComponentBuilder::make(ComponentEnum::UL)
                    ->setAttribute('id', 'nested_list')
                    ->setContent(
                        ComponentBuilder::make(ComponentEnum::LI)
                            ->setContent('First nested list item'),
                    ),
            ]);

        $this->blade('{{ $unorderedList }}', [
            'unorderedList' => $unorderedList,
        ])
        ->assertSee('<ul id="main_list"', false)
        ->assertSee('<li', false)
        ->assertSee('First list item')
        ->assertSee('</li>', false)
        ->assertSee('Second list item')
        ->assertSee('<ul id="nested_list"', false)
        ->assertSee('First nested list item');
    }

    /** @test */
    public function unordered_list_accepts_theme()
    {
        $theme = [
            'lists' =>  'unordered',
        ];
        
        $unorderedList = ComponentBuilder::make(ComponentEnum::UL)
            ->setThemes($theme);
        
        $this->blade('{{ $unorderedList }}', [
            'unorderedList' => $unorderedList,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}
