<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

class SmallTest extends TestCase
{
    #[Test]
    public function simple_empty_small()
    {
        $small = ComponentBuilder::make(ComponentEnum::SMALL);

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('<small', false)
            ->assertSee('</small>', false);
    }

    #[Test]
    public function small_accepts_content()
    {
        $small = ComponentBuilder::make(ComponentEnum::SMALL)
            ->setContent('Nice b tag');

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('Nice b tag');
    }
    
    #[Test]
    public function small_accepts_contents_array()
    {
        $small = ComponentBuilder::make(ComponentEnum::SMALL)
            ->setContents([
                'content 1 ',
                'content 2',
            ]);

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('<small', false)
            ->assertSee('content 1 ')
            ->assertSee('content 2')
            ->assertSee('</small>', false);
    }

    #[Test]
    public function small_accepts_attributes()
    {
        $small = ComponentBuilder::make(ComponentEnum::SMALL)
            ->setAttribute('id', 'nice_small');

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('id="nice_small"', false);
    }

    #[Test]
    public function small_accepts_theme()
    {
        $theme = [
            'display' => 'inline-block',
        ];

        $small = ComponentBuilder::make(ComponentEnum::SMALL)
            ->setThemes($theme);

        $this->blade('{{ $small }}', [
            'small' => $small,
        ])
            ->assertSee('class="'.getThemes($theme), false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
