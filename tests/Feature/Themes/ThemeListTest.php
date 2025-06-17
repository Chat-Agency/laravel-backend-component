<?php

declare(strict_types=1);

namespace Feature\Themes;

use ChatAgency\BackendComponents\Utils\ThemeList;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ThemeListTest extends TestCase
{
    #[Test]
    public function all_themes_are_valid_arrays()
    {
        $list = ThemeList::make();

        $this->assertIsArray($list->scanFiles());
    }
}
