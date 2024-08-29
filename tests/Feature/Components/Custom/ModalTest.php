<?php

namespace Tests\Feature\Components\Custom;

use Tests\TestCase;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Themes\DefaultThemeBag;

class ModalTest extends TestCase
{
    /** @test */
    public function simple_modal()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL);

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        // inertia's code
        ->assertSee('x-data="{ \'showModal\': false }"', false)
        // overlay classes
        ->assertSee('class="'.bladeThemes(['modal' => 'overlay']), false);
    }

    /** @test */
    public function modal_accepts_content()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setContent("This is the modal's content");

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee("This is the modal's content");
    }

    /** @test */
    public function modal_accepts_attributes()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setAttribute('id', 'my_modal');

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee('id="my_modal"', false);
    }

    /** @test */
    public function modal_accepts_sub_components()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::DIV)
                    ->setContent('Sub Component inside modal')
                    ->setAttribute('id', 'modal_body')
            ]);

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee('Sub Component inside modal')
        ->assertSee('<div id="modal_body"', false);
    }

    /** @test */
    public function modal_accepts_theme()
    {
        $theme = ['modal' => 'default'];
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setThemes($theme);

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);
    }

    /** @test */
    public function modal_accepts_button_slot()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
        ->setSlot(
            'button', 
            ComponentBuilder::make(ComponentEnum::BUTTON)
                ->setContent('Open Modal')
                ->setAttribute('type', 'button')
                ->setAttribute('@click', 'showModal = true')
        );

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee('<button', false)
        ->assertSee('@click="showModal = true"', false)
        ->assertSee('type="button"', false)
        ->assertSee('Open Modal')
        ->assertSee('</button>', false);
    }

    /** @test */
    public function modal_accepts_title_slot()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setSlot(
                'title', 
                ComponentBuilder::make(ComponentEnum::DIV)
                    ->setContent('This is the title')
                    ->setAttribute('id', 'modal_title')
            );

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee('<div id="modal_title"', false)
        ->assertSee('This is the title');
    }

    /** @test */
    public function modal_accepts_body_slot()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setSlot(
                'body', 
                ComponentBuilder::make(ComponentEnum::DIV)
                    ->setContent('This is the body')
                    ->setAttribute('id', 'modal_body')
            );

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee('<div id="modal_body"', false)
        ->assertSee('This is the body');
    }

    /** @test */
    public function modal_accepts_footer_slot()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setSlot(
                'footer', 
                ComponentBuilder::make(ComponentEnum::DIV)
                    ->setContent('This is the footer')
                    ->setAttribute('id', 'modal_footer')
            );

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee('<div id="modal_footer"', false)
        ->assertSee('This is the footer');
    }

    /** @test */
    public function modal_does_not_accept_arbitrary_slots()
    {
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setSlot(
                'arbitrary_slo', 
                ComponentBuilder::make(ComponentEnum::DIV)
                    ->setContent('This is the arbitrary slot')
                    ->setAttribute('id', 'modal_arbitrary_slot')
            );

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertDontSee('<div id="modal_arbitrary_slot"', false)
        ->assertDontSee('This is the arbitrary slot');
    }

    /** @test */
    public function modal_accepts_container_extra_params()
    {
        $containerTheme = [
            'display' => 'flex',
            'flex' => 'items-center',
        ];
        
        $modal = ComponentBuilder::make(ComponentEnum::MODAL)
            ->setExtra('container',  [
                'theme' => $containerTheme,
            ]);

        $this->blade('{{ $modal }}', [
            'modal' => $modal,
        ])
        ->assertSee('class="'.bladeThemes($containerTheme), false);
        
    }
}
