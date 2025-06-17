<?php

namespace Feature\Themes;

use ChatAgency\BackendComponents\Utils\ThemeList;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ThemeListTest extends TestCase
{
    #[Test]
    public function all_themes_are_valid_arrays()
    {
        $list = ThemeList::make(); 

        $this->assertIsArray($list->scanFiles());
    }
}
