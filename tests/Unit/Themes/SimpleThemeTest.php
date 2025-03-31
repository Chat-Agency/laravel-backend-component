<?php

declare(strict_types=1);

namespace Tests\Unit\Themes;

use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SimpleThemeTest extends TestCase
{
    #[Test]
    public function a_theme_can_be_created_using_the_theme_manager()
    {
        $theme = [
            'display' => 'flex',
        ];

        $manager = new DefaultThemeManager;

        $this->assertEquals($manager->processThemes($theme), 'flex');
    }

    #[Test]
    public function if_multiple_multiple_values_are_needed_in_a_same_theme_an_array_can_be_used()
    {
        $theme = [
            'display' => 'flex',
            'flex' => [
                'gap-sm',
                'items-center',
            ],
        ];

        $manager = new DefaultThemeManager;

        $this->assertEquals($manager->processThemes($theme), 'flex gap-1 items-center');

    }

    #[Test]
    public function the_manager_cache_can_be_disabled()
    {
        $theme = [
            'display' => 'flex',
            'flex' => [
                'gap-sm',
                'items-center',
            ],
        ];

        $manager = new DefaultThemeManager;

        $manager->unsetCacheHits()
            ->disableCache();

        $manager->processThemes($theme);
        $manager->processThemes($theme);

        $this->assertEquals(0, $manager->getCacheHits());

    }

    #[Test]
    public function an_exception_is_thrown_if_the_theme_default_path_is_incorrect()
    {

        $this->expectException(Exception::class);

        $theme = [
            'display' => 'flex',
            'flex' => [
                'gap-sm',
                'items-center',
            ],
        ];

        $manager = new DefaultThemeManager;

        $manager->setDefaultPath('this/path/is/not/real/');

        $manager->processThemes($theme);

    }

    #[Test]
    public function an_exception_is_thrown_if_the_theme_file_path_is_incorrect()
    {
        $this->expectException(Exception::class);

        $theme = [
            'non_existing_theme_file' => 'nope',
        ];

        $manager = new DefaultThemeManager;

        $manager->processThemes($theme);

    }
}
