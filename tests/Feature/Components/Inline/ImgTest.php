<?php

namespace Tests\Feature\Components\Inline;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

class ImgTest extends TestCase
{
    #[Test]
    public function simple_image()
    {
        $img = ComponentBuilder::make(ComponentEnum::IMG);

        $this->blade('{{ $img }}', [
            'img' => $img,
        ])
            ->assertSee('<img', false)
            ->assertSee('/>', false);
    }

    #[Test]
    public function image_has_no_content()
    {
        $img = ComponentBuilder::make(ComponentEnum::IMG)
            ->setContent('Nice image');

        $this->blade('{{ $img }}', [
            'img' => $img,
        ])
            ->assertDontSee('Nice image');
    }

    #[Test]
    public function image_accepts_attributes()
    {
        $img = ComponentBuilder::make(ComponentEnum::IMG)
            ->setAttribute('src', asset('path/to/image.jpg'))
            ->setAttribute('alt', 'Nice image');

        $this->blade('{{ $img }}', [
            'img' => $img,
        ])
            ->assertSee('<img', false)
            ->assertSee('src="'.asset('path/to/image.jpg').'"', false)
            ->assertSee('alt="Nice image"', false)
            ->assertSee('/>', false);
    }

    #[Test]
    public function image_does_not_accept_sub_components()
    {
        $image = ComponentBuilder::make(ComponentEnum::IMG)
            ->setSubComponent(
                ComponentBuilder::make(ComponentEnum::SPAN)
            );

        $this->blade('{{ $image }}', [
            'image' => $image,
        ])
            ->assertDontSee('<span', false)
            ->assertDontSee('</span>', false);
    }

    #[Test]
    public function image_accepts_theme()
    {
        $theme = [
            'display' => 'block',
        ];

        $img = ComponentBuilder::make(ComponentEnum::IMG)
            ->setAttribute('src', asset('path/to/image.jpg'))
            ->setAttribute('alt', 'Nice image')
            ->setThemes($theme);

        $this->blade('{{ $img }}', [
            'img' => $img,
        ])
            ->assertSee('<img', false)
            ->assertSee('class="'.getThemes($theme), false)
            ->assertSee('/>', false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
