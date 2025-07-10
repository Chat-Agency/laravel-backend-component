<?php

declare(strict_types=1);

namespace Tests\Feature\Utils;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use ChatAgency\BackendComponents\Utils\CellBag;
use ChatAgency\BackendComponents\Utils\TableUtil;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

use function ChatAgency\BackendComponents\processThemes;

final class TableUtilTest extends TestCase
{
    #[Test]
    public function it_can_create_a_table_using_the_table_util()
    {
        $table = TableUtil::make(
            ['first column', 'second column'],
            [
                [
                   ComponentBuilder::make(ComponentEnum::SPAN)
                        ->setContent('Inside a span'),
                    'first row first column',
                    'first row second column',
                ],
                [
                    'second row first column', 'second row second column',
                ],
            ]
        )->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('<table', false)
            ->assertSee('<thead', false)
            ->assertSee('<tbody', false)
            ->assertSee('<tr', false)
            ->assertSee('<th', false)
            ->assertSee('first column', false)
            ->assertSee('second column', false)
            ->assertSee('<td', false)
            ->assertSee('first row second column', false)
            ->assertSee('second row first column', false)
            ->assertSee('second row second column', false)
            ->assertSee('</table>', false);
    }


    #[Test]
    public function it_can_contain_components_in_cells()
    {
        $table = TableUtil::make(
            ['first column', 'second column'],
            [
                [
                    ComponentBuilder::make(ComponentEnum::SPAN)
                        ->setContent('Inside a span'),
                    'first row second column',
                ],
                [
                    'second row first column', 'second row second column',
                ],
            ]
        )
            ->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('<span', false)
            ->assertSee('Inside a span', false)
            ->assertSee('</span>', false)
            ->assertSee('first row second column');
    }

    #[Test]
    public function it_does_not_create_a_thead_when_head_array_is_empty_with_no_head()
    {
        $table = TableUtil::make(
            [],
            [
                [
                    'first row first column',
                    'first row second column',
                ],
                [
                    'second row first column',
                    'second row second column',
                ],
            ]
        )->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertDontSee('<thead', false)
            ->assertDontSee('</thead>', false);
    }

    #[Test]
    public function it_can_have_attributes_passed_via_a_cell_bag()
    {
        $themeHd = [
            'color' => 'success',
        ];
        $themeTd = [
            'color' => 'error',
        ];

        $table = TableUtil::make(
            [
                [
                    'content' => 'first column',
                    'theme' => $themeHd,
                ],
                'second column',
            ],
            [
                [
                    [
                        'content' => 'first row first column',
                        'attributes' => [
                            'rowspan' => '2',
                        ],
                        'theme' => $themeTd,
                    ],
                    'first row second column',
                ],
                [
                    'second row second column',
                ],
            ]
        )->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('rowspan="2"', false)
            ->assertSee(processThemes($themeHd), false)
            ->assertSee(processThemes($themeTd), false);
    }

    #[Test]
    public function it_can_have_attributes_passed_via_a_cell_bag_with_no_theme()
    {
        $theme = [
            'color' => 'error',
        ];

        $table = TableUtil::make(
            [
                new CellBag(
                    content: 'first head column',
                ),
                'second head column',
            ],
            [
                [
                    new CellBag(
                        content: 'first row first column',
                        attributes: [
                            'rowspan' => '2',
                        ],
                        theme: $theme,
                    ),
                    'first row second column',
                ],
                [
                    'second row second column',
                ],
            ]
        )->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('first head column', false)
            ->assertSee('second row second column', false)
            ->assertSee('rowspan="2"', false)
            ->assertSee(processThemes($theme), false);
    }

    #[Test]
    public function it_can_have_attributes_passed_via_an_array()
    {
        $tableThemes = ['table' => 'custom-table-class'];
        $thThemes = ['table' => 'custom-th-class'];
        $trThemes = ['table' => 'custom-tr-class'];
        $tdThemes = ['table' => 'custom-td-class'];

        $tableUtil = TableUtil::make(['head1'], [['body1']]);

        $tableUtil->setTableThemes($tableThemes)
            ->setThThemes($thThemes)
            ->setTrThemes($trThemes)
            ->setTdThemes($tdThemes);

        $component = $tableUtil->getComponent();

        $this->assertEquals($component->getThemes(), $tableThemes);

        /** @var \ChatAgency\BackendComponents\Contracts\CompoundComponent $thead */
        $thead = $component->getContent(0);
        /** @var \ChatAgency\BackendComponents\Contracts\CompoundComponent $trHead */
        $trHead = $thead->getContent(0);
        /** @var \ChatAgency\BackendComponents\Contracts\CompoundComponent $th */
        $th = $trHead->getContent(0);
        $this->assertEquals($th->getThemes(), $thThemes);

        /** @var \ChatAgency\BackendComponents\Contracts\CompoundComponent $tBody */
        $tBody = $component->getContent(1);
        /** @var \ChatAgency\BackendComponents\Contracts\CompoundComponent $trBody */
        $trBody = $tBody->getContent(0);
        $this->assertEquals($trBody->getThemes(), $trThemes);

        /** @var \ChatAgency\BackendComponents\Contracts\CompoundComponent $td */
        $td = $trBody->getContent(0);
        $this->assertEquals($td->getThemes(), $tdThemes);
    }

    
}

