<?php

namespace Tests\Feature\Components\Lists;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class OrderedListTest extends TestCase
{
    /** @test */
    public function empty_ordered_list()
    {
        $orderedList = ComponentBuilder::make(ComponentEnum::OL);

        $this->blade('{{ $orderedList }}', [
            'orderedList' => $orderedList,
        ])
        ->assertSee('<ol', false)
        ->assertSee('</ol>', false);
    }

    
    /** @test */
    public function ordered_list_accepts_content()
    {
        $orderedList = ComponentBuilder::make(ComponentEnum::OL)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::LI)
                    ->setContent('List content')
            );

        $this->blade('{{ $orderedList }}', [
            'orderedList' => $orderedList,
        ])
        ->assertSee('<li', false)
        ->assertSee('List content')
        ->assertSee('</li>', false);
    }

    
    /** @test */
    public function ordered_list_accepts_attributes()
    {
        $orderedList = ComponentBuilder::make(ComponentEnum::OL)
            ->setAttribute('id', 'list_id');

        $this->blade('{{ $orderedList }}', [
            'orderedList' => $orderedList,
        ])
        ->assertSee('id="list_id"', false);
    }

    /** @test */
    public function ordered_list_accepts_sub_components()
    {
        $orderedList = ComponentBuilder::make(ComponentEnum::OL)
            ->setAttribute('id', 'main_list')
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::LI)
                    ->setContent('First list item'),
                ComponentBuilder::make(ComponentEnum::LI)
                    ->setContent('Second list item'),
                // nested list
                ComponentBuilder::make(ComponentEnum::OL)
                    ->setAttribute('id', 'nested_list')
                    ->setContent(
                        ComponentBuilder::make(ComponentEnum::LI)
                            ->setContent('First nested list item'),
                    ),
            ]);

        $this->blade('{{ $orderedList }}', [
            'orderedList' => $orderedList,
        ])
        ->assertSee('<ol id="main_list"', false)
        ->assertSee('<li', false)
        ->assertSee('First list item')
        ->assertSee('</li>', false)
        ->assertSee('Second list item')
        ->assertSee('<ol id="nested_list"', false)
        ->assertSee('First nested list item');
    }

    /** @test */
    public function ordered_list_accepts_theme()
    {
        $theme = [
            'lists' =>  'ordered',
        ];
        
        $orderedList = ComponentBuilder::make(ComponentEnum::OL)
            ->setThemes($theme);
        
        $this->blade('{{ $orderedList }}', [
            'orderedList' => $orderedList,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}
