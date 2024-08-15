<?php

namespace Tests\Components;

use Tests\TestCase;
use ChatAgency\BackendComponents\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;


class ButtonTest extends TestCase
{
    /** @test */
    public function simple_button()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button');

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
        ->assertSee('<button', false)
        ->assertSee('Nice button')
        ->assertSee('</button>', false);
    }

    /** @test */
    public function button_with_component_content()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Span content')
            );

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
        ->assertSee('<button ', false)
        ->assertSee('<span', false)
        ->assertSee('Span content')
        ->assertSee('</span>', false)
        ->assertSee('</button>', false);
    }

    /** @test */
    public function button_with_arguments()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button')
            ->setAttribute('type', 'submit');

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
        ->assertSee('<button', false)
        ->assertSee('type="submit"', false)
        ->assertSee('</button>', false);
    }

    /** @test */
    public function button_with_sub_components()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button')
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Inside span')
            ]);

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
        ->assertSee('<button', false)
        ->assertSee('<span', false)
        ->assertSee('</span>', false)
        ->assertSee('Inside span')
        ->assertSee('</button>', false);
        
    }

    /** @test */
    public function button_with_theme()
    {
        $theme = [
            'action' =>  'default',
        ];
        
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button')
            ->setThemes($theme);
        
        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
        ->assertSee('<button', false)
        ->assertSee('class="'.bladeThemes($theme), false)
        ->assertSee('</button>', false);
    }
}