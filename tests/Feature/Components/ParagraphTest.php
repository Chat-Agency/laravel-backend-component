<?php

namespace Tests\Feature\Components;

use Tests\TestCase;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;

class ParagraphTest extends TestCase
{
    /** @test */
    public function empty_paragraph()
    {
        $paragraph = ComponentBuilder::make(ComponentEnum::PARAGRAPH);

        $this->blade('{{ $paragraph }}', [
            'paragraph' => $paragraph,
        ])
        ->assertSee('<p', false)
        ->assertSee('</p>', false);
    }

    /** @test */
    public function paragraph_accepts_content()
    {
        $paragraph = ComponentBuilder::make(ComponentEnum::PARAGRAPH)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::LINK)
                    ->setContent('Link content')
            );

        $this->blade('{{ $paragraph }}', [
            'paragraph' => $paragraph,
        ])
        ->assertSee('<p ', false)
        ->assertSee('<a', false)
        ->assertSee('Link content')
        ->assertSee('</a>', false)
        ->assertSee('</p>', false);
    }

    /** @test */
    public function paragraph_accepts_attributes()
    {
        $paragraph = ComponentBuilder::make(ComponentEnum::PARAGRAPH)
            ->setContent('Nice paragraph')
            ->setAttribute('id', 'paragraph_id');

        $this->blade('{{ $paragraph }}', [
            'paragraph' => $paragraph,
        ])
        ->assertSee('<p', false)
        ->assertSee('id="paragraph_id"', false)
        ->assertSee('</p>', false);
    }

    /** @test */
    public function paragraph_accepts_sub_components()
    {
        $paragraph = ComponentBuilder::make(ComponentEnum::PARAGRAPH)
            ->setContent('Nice paragraph')
            ->setSubComponents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Inside span'),
                    ComponentBuilder::make(ComponentEnum::LINK)
                    ->setContent('Inside link')
                    ->setAttribute('href', 'https://google.com'),
            ]);

        $this->blade('{{ $paragraph }}', [
            'paragraph' => $paragraph,
        ])
        ->assertSee('<p', false)
        ->assertSee('<span', false)
        ->assertSee('Inside span')
        ->assertSee('</span>', false)
        ->assertSee('href="https://google.com"', false)
        ->assertSee('Inside link')
        ->assertSee('</p>', false);
        
    }

    /** @test */
    public function paragraph_accepts_theme()
    {
        $theme = [
            'color' =>  'success',
        ];
        
        $paragraph = ComponentBuilder::make(ComponentEnum::PARAGRAPH)
            ->setContent('Nice paragraph')
            ->setThemes($theme);
        
        $this->blade('{{ $paragraph }}', [
            'paragraph' => $paragraph,
        ])
        ->assertSee('<p', false)
        ->assertSee('class="'.bladeThemes($theme), false)
        ->assertSee('</p>', false);

        $this->assertNotEmpty(bladeThemes($theme));
    }

}
