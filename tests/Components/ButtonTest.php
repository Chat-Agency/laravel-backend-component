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

        $this->blade(
                htmlentities(
                    $button->toHtml()
                )
            )
            ->assertSee('<button ')
            ->assertSee('class="')
            ->assertSee('Nice button')
            ->assertSee('</button>');
    }

    /** @test */
    public function button_with_arguments()
    {
        $button = ComponentBuilder::make(ComponentEnum::BUTTON)
            ->setContent('Nice button')
            ->setAttribute('type', 'submit');

        $this->blade(
                htmlentities(
                    $button->toHtml()
                )
            )
            ->assertSee('type=')
            ->assertSee('submit');
    }
}