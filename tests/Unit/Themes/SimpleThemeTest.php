<?php

namespace Tests\Unit\Themes;

use ChatAgency\BackendComponents\Themes\DefaultThemeBag;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
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

        $this->assertEquals($manager->getThemes($theme), 'flex');
    }

    #[Test]
    public function if_multiple_multiple_values_are_needed_in_a_same_theme_a_theme_bag_can_be_used()
    {
        $theme = [
            'display' => 'flex',
            'flex' => new DefaultThemeBag([
                'gap-sm',
                'items-center',
            ]),
        ];

        $manager = new DefaultThemeManager;

        $this->assertEquals($manager->getThemes($theme), 'flex gap-1 items-center');

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

        $this->assertEquals($manager->getThemes($theme), 'flex gap-1 items-center');

    }

    #[Test]
    public function a_static_make_can_be_called_on_the_theme_bag()
    {
        $theme = [
            'display' => 'flex',
            'flex' => DefaultThemeBag::make([
                'gap-sm',
                'items-center',
            ]),
        ];

        $manager = new DefaultThemeManager;

        $this->assertEquals($manager->getThemes($theme), 'flex gap-1 items-center');

    }
}
