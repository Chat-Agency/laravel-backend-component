<?php

namespace Tests\Feature\Components\Form;

use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use Tests\TestCase;

class FormTest extends TestCase
{
    /** @test */
    public function simple_form()
    {
        $form = ComponentBuilder::make(ComponentEnum::FORM);

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertSee('<form', false)
        ->assertSee('</form>', false);
    }

    /** @test */
    public function form_accepts_content()
    {
        $form = ComponentBuilder::make(ComponentEnum::FORM)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::BUTTON)
                    ->setContent('Send Form')
            );

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertSee('<button', false)
        ->assertSee('Send Form')
        ->assertSee('</button>', false);
    }

    /** @test */
    public function form_accepts_attributes()
    {
        $form = ComponentBuilder::make(ComponentEnum::FORM)
            ->setAttribute('method', 'post')
            ->setAttribute('action', '/')
            ->setAttribute('enctype', 'multipart/form-data');

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertSee('method="POST"', false)
        ->assertSee('action="/"', false)
        ->assertSee('enctype="multipart/form-data"', false);
    }

    /** @test */
    public function form_accepts_sub_components()
    {
        $form = ComponentBuilder::make(ComponentEnum::FORM)
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::LABEL)
                    ->setContent('First Name')
                    ->setAttribute('for', 'first_name'),
                ComponentBuilder::make(ComponentEnum::TEXT_INPUT)
                    ->setAttribute('id',  'first_name'),
            ]);

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertSee('<label for="first_name"', false)
        ->assertSee('First Name')
        ->assertSee('</label>', false)
        ->assertSee('<input type="text"', false);
        
    }

    /** @test */
    public function form_accepts_theme()
    {
        $theme = [
            'display' =>  'flex',
        ];
        
        $form = ComponentBuilder::make(ComponentEnum::FORM)
            ->setThemes($theme);
        
        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertSee('class="'.bladeThemes($theme), false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

    /** @test */
    public function form_accepts_container_extra_params()
    {
        $form = ComponentBuilder::make(ComponentEnum::FORM)
            ->setExtra('has_button', true);

        $this->blade('{{ $form }}', [
            'form' => $form,
        ])
        ->assertSee('<button', false)
        ->assertSee('</button>', false)
        ;
        
    }
}