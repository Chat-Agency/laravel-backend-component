<?php

declare(strict_types=1);

namespace Tests\Feature\Components\Form;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\processThemes;

class FieldsetTest extends TestCase
{
    #[Test]
    public function simple_fieldset()
    {
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET);

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
            ->assertSee('<fieldset', false);
    }

    #[Test]
    public function fieldset_accepts_content()
    {
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('Span content')
            );

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
            ->assertSee('<fieldset', false)
            ->assertSee('Span content')
            ->assertSee('</fieldset>', false);
    }

    #[Test]
    public function fieldset_accepts_contents_array()
    {
        $header = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setContents([
                ComponentBuilder::make(ComponentEnum::TEXT_INPUT),
                ComponentBuilder::make(ComponentEnum::EMAIL_INPUT),
            ]);

        $this->blade('{{ $header }}', [
            'header' => $header,
        ])
            ->assertSee('<fieldset', false)
            ->assertSee('<input type="text"', false)
            ->assertSee('<input type="email"', false)
            ->assertSee('</fieldset>', false);
    }

    #[Test]
    public function fieldset_accepts_attributes()
    {
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setAttribute('for', 'fieldset_for');

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
            ->assertSee('for="fieldset_for"', false);
    }

    #[Test]
    public function fieldset_accepts_theme()
    {
        $theme = [
            'color' => 'default',
        ];

        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setThemes($theme);

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
            ->assertSee('class="'.processThemes($theme), false);

        $this->assertNotEmpty(processThemes($theme));
    }
}
