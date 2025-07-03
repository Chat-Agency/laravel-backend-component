<?php

declare(strict_types=1);

namespace Feature\Utils;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Utils\CellBag;
use ChatAgency\BackendComponents\Utils\TableUtil;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\processThemes;

class TableUtilTest extends TestCase
{
    #[Test]
    public function a_table_can_be_created_using_the_table_til()
    {
        $table = TableUtil::make(
            ['first column', 'second column'],
            [
                [
                    'first row first column', 'first row first column',
                ],
                [
                    'second row first column', 'second row first column',
                ],
            ]
        )->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('<table', false)
            ->assertSee('<tr', false)
            ->assertSee('<td', false)
            ->assertSee('first column')
            ->assertSee('second column')
            ->assertSee('first row first column')
            ->assertSee('first row first column')
            ->assertSee('second row first column')
            ->assertSee('second row first column')
            ->assertSee('</td>', false)
            ->assertSee('</tr>', false)
            ->assertSee('</table>', false);
    }

    #[Test]
    public function the_array_can_also_contain_components()
    {
        $table = TableUtil::make(
            ['first column', 'second column'],
            [
                [
                    ComponentBuilder::make(ComponentEnum::SPAN)
                        ->setContent('Inside a span'),
                    'first row first column',
                ],
                [
                    'second row first column', 'second row first column',
                ],
            ]
        )
            ->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table,
        ])
            ->assertSee('<span', false)
            ->assertSee('Inside a span', false)
            ->assertSee('</span>', false);
    }

    #[Test]
    public function a_different_theme_can_be_used_on_any_of_the_components()
    {
        $table = TableUtil::make(
            ['first column', 'second column'],
            [
                [
                    'first row first column', 'first row first column',
                ],
                [
                    'second row first column', 'second row first column',
                ],
            ]

        );

        $table1 = $table->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table1,
        ])
            ->assertDontSee('text-black', false);

        $table2 = $table->setTheme('td', [
            'color' => 'default',
        ])
            ->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $table2,
        ])
            ->assertSee('text-black', false);

    }

    #[Test]
    public function when_provided_an_empty_head_array_no_head_is_created()
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

        );

        $component = $table->getComponent();

        // dd($component);

        $this->blade('{{ $table }}', [
            'table' => $component,
        ])
            ->assertDontSee('<thead', false);
    }

    #[Test]
    public function a_theme_and_attributes_can_be_passed_if_an_array_is_passed_as_content()
    {
        $themeHd = [
            'color' => 'success',
        ];
        $theme = [
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
                    /**
                     * Pass an array instead of a string
                     * to set attributes and theme
                     */
                    [
                        'content' => 'first row first column',
                        'attributes' => [
                            'rowspan' => '2',
                        ],
                        'theme' => $theme,
                    ],
                    'first row second column',
                ],
                [
                    'second row first column',
                    'second row second column',
                ],
            ]

        );

        $component = $table->getComponent();

        // dd($component);

        $this->blade('{{ $table }}', [
            'table' => $component,
        ])
            ->assertSee('rowspan="2"', false)
            ->assertSee(processThemes($themeHd), false)
            ->assertSee(processThemes($theme), false);
    }

    #[Test]
    public function a_theme_and_attributes_can_be_added_to_a_cell_if_a_cell_bag_is_passed_as_content()
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
                    'second row first column',
                    'second row second column',
                ],
            ]

        );

        $component = $table->getComponent();

        $this->blade('{{ $table }}', [
            'table' => $component,
        ])
            ->assertSee('first head column', false)
            ->assertSee('second row second column', false)
            ->assertSee('rowspan="2"', false)
            ->assertSee(processThemes($theme), false);

    }
}
