<?php

namespace Tests\Feature\Components\Lists;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use function ChatAgency\BackendComponents\bladeThemes;

class OrderedListTest extends TestCase
{
    #[Test]
    public function empty_ordered_list()
    {
        $orderedList = ComponentBuilder::make(ComponentEnum::OL);

        $this->blade('{{ $orderedList }}', [
            'orderedList' => $orderedList,
        ])
            ->assertSee('<ol', false)
            ->assertSee('</ol>', false);
    }

    #[Test]
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

    #[Test]
    public function ordered_list_accepts_attributes()
    {
        $orderedList = ComponentBuilder::make(ComponentEnum::OL)
            ->setAttribute('id', 'list_id');

        $this->blade('{{ $orderedList }}', [
            'orderedList' => $orderedList,
        ])
            ->assertSee('id="list_id"', false);
    }

    #[Test]
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

    #[Test]
    public function ordered_list_accepts_theme()
    {
        $theme = [
            'lists' => 'ordered',
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
