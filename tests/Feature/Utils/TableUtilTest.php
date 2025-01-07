<?php

declare(strict_types=1);

namespace Feature\Utils;

use ChatAgency\BackendComponents\Utils\TableUtil;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TableUtilTest extends TestCase
{
    #[Test]
    public function a_table_can_be_created_using_the_tableUtil()
    {
        $table = TableUtil::make(
            ['first column', 'second column'],
            [[
                [
                    'first row first column', 'first row first column',
                ],
                [
                    'second row first column', 'second row first column',
                ],
            ]]
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
}
