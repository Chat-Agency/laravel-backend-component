<?php

namespace Tests\Feature\Components\Form;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\getThemes;

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
    public function fieldset_accepts_sub_components()
    {
        $fieldset = ComponentBuilder::make(ComponentEnum::FIELDSET)
            ->setChildren([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('First span'),
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Second span'),
            ]);

        $this->blade('{{ $fieldset }}', [
            'fieldset' => $fieldset,
        ])
            ->assertSee('<span', false)
            ->assertSee('First span')
            ->assertSee('</span>', false)
            ->assertSee('Second span');

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
            ->assertSee('class="'.getThemes($theme), false);

        $this->assertNotEmpty(getThemes($theme));
    }
}
