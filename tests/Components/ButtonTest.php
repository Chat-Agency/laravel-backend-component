<?php

namespace Tests\Components;

use Tests\TestCase;
use ChatAgency\BackendComponents\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;


class ButtonTest extends TestCase
{
    use InteractsWithViews;
    
    /** @test */
    public function simple_button()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button');

        $this->blade('{{ $button }}', [
            'button' => $button,
        ])
        ->assertSee('Nice button')
        ->assertSee('button ')
        ->assertSee('class=')
        ->assertSee('/button');
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
        ->assertSee('type=')
        ->assertSee('submit');
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
        ->assertSee('Inside span')
        ->assertSee('/span')
        ->assertSee('/button');
        
    }
}