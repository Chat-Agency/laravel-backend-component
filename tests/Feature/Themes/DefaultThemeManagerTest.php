<?php

declare(strict_types=1);

namespace Feature\Themes;

use ChatAgency\BackendComponents\Themes\DefaultThemeManager;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\processThemes;

class DefaultThemeManagerTest extends TestCase
{
    #[Test]
    public function default_theme_manager_helps_creating_themes()
    {
        $theme = [
            'display' => 'flex',
        ];

        $manager = new DefaultThemeManager;

        $this->assertEquals($manager->processThemes($theme), processThemes($theme));

    }
}
