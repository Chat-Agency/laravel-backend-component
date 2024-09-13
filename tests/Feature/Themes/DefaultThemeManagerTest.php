<?php

namespace Feature\Themes;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use ChatAgency\BackendComponents\Themes\DefaultThemeManager;

use function ChatAgency\BackendComponents\getThemes;

class DefaultThemeManagerTest extends TestCase
{
    #[Test]
    public function default_theme_manager_helps_creating_themes()
    {
        $theme = [
            'display' => 'flex',
        ];
        
        $manager = new DefaultThemeManager();

        $this->assertEquals($manager->getThemes($theme), getThemes($theme));

    }
}
