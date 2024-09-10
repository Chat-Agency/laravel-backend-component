<?php

namespace Test\Feature\Components\Table;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use function ChatAgency\BackendComponents\bladeThemes;

class TableTest extends TestCase
{
    #[Test]
    public function empty_table()
    {
        $table = ComponentBuilder::make(ComponentEnum::TABLE);

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('<table', false)
            ->assertSee('</table>', false);
    }

    #[Test]
    public function table_accepts_content()
    {
        $table = ComponentBuilder::make(ComponentEnum::TABLE)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::TBODY)
            );

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('<tbody', false)
            ->assertSee('</tbody>', false);
    }

    #[Test]
    public function table_accepts_attributes()
    {
        $table = ComponentBuilder::make(ComponentEnum::TABLE)
            ->setAttribute('id', 'table_id');

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('id="table_id"', false);
    }

    #[Test]
    public function table_accepts_sub_components()
    {
        $table = ComponentBuilder::make(ComponentEnum::TABLE)
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::CAPTION)
                    ->setContent('Beautiful Table'),

                // head
                ComponentBuilder::make(ComponentEnum::THEAD)
                    ->setSubComponents([
                        // row
                        ComponentBuilder::make(ComponentEnum::TR)
                            ->setContent(
                                // cell
                                ComponentBuilder::make(ComponentEnum::TH)
                                    ->setContent('First head')
                            ),
                    ]),
                // body
                ComponentBuilder::make(ComponentEnum::TBODY)
                    ->setSubComponents([
                        // row
                        ComponentBuilder::make(ComponentEnum::TR)
                            ->setContent(
                                // cell
                                ComponentBuilder::make(ComponentEnum::TD)
                                    ->setContent('First cell')
                            ),
                    ]),
            ]);

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('<table', false)
            ->assertSee('<caption', false)
            ->assertSee('Beautiful Table')
            ->assertSee('</caption>', false)
            ->assertSee('<thead', false)
            ->assertSee('<tr', false)
            ->assertSee('<th', false)
            ->assertSee('First head')
            ->assertSee('</th>', false)
            ->assertSee('</tr>', false)
            ->assertSee('</thead>', false)
            ->assertSee('<tbody', false)
            ->assertSee('<td', false)
            ->assertSee('First head')
            ->assertSee('</td>', false)
            ->assertSee('</tbody>', false)
            ->assertSee('</table>', false);
    }

    #[Test]
    public function table_accepts_theme()
    {
        $theme = [
            'size' => 'w-full',
        ];

        $table = ComponentBuilder::make(ComponentEnum::TABLE)
            ->setThemes($theme);

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
