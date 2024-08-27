<?php

namespace Tests\Components\Inline;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class ImgTest extends TestCase
{
    /** @test */
    public function simple_image()
    {
        $img = ComponentBuilder::make(ComponentEnum::IMG);

        $this->blade('{{ $img }}', [
            'img' => $img,
        ])
        ->assertSee('<img', false)
        ->assertSee('/>', false);
    }

    /** @test */
    public function image_has_no_content()
    {
        $img = ComponentBuilder::make(ComponentEnum::IMG)
            ->setContent('Nice image');

        $this->blade('{{ $img }}', [
            'img' => $img,
        ])
        ->assertDontSee('Nice image');
    }

    /** @test */
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

    /** @test */
    public function image_accepts_theme()
    {
        $theme = [
            'display' =>  'block',
        ];
        
        $img = ComponentBuilder::make(ComponentEnum::IMG)
            ->setAttribute('src', asset('path/to/image.jpg'))
            ->setAttribute('alt', 'Nice image')
            ->setThemes($theme);

        $this->blade('{{ $img }}', [
            'img' => $img,
        ])
        ->assertSee('<img', false)
        ->assertSee('class="'.bladeThemes($theme), false)
        ->assertSee('/>', false);

        $this->assertNotEmpty(bladeThemes($theme));
    }
}
