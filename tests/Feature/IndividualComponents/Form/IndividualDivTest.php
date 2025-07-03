<?php

declare(strict_types=1);

namespace Feature\IndividualComponents\Form;

use ChatAgency\BackendComponents\Builders\ComponentBuilder;
use ChatAgency\BackendComponents\Components\Individual\DivComponent;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

use function ChatAgency\BackendComponents\processThemes;

class IndividualDivTest extends TestCase
{
    #[Test]
    public function empty_individual_div()
    {
        $div = new DivComponent;

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('<div', false)
            ->assertSee('</div>', false);
    }

    #[Test]
    public function individual_div_accepts_content()
    {
        $div = (new DivComponent)
            ->setContent('This is the content content');

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('<div', false)
            ->assertSee('This is the content content')
            ->assertSee('</div>', false);
    }

    #[Test]
    public function a_div_accepts_content_and_can_be_accessed_using_a_key()
    {
        $div = (new DivComponent)->setContent('Nice content', 1);

        $this->assertEquals('Nice content', $div->getContent(1));
    }

    #[Test]
    public function individual_div_accepts_contents_array()
    {
        $div = (new DivComponent)
            ->setContents([
                ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Span'),
                ComponentBuilder::make(ComponentEnum::BOLD)
                    ->setContent('Bold'),
            ]);

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('<div', false)
            ->assertSee('<span', false)
            ->assertSee('Span')
            ->assertSee('</span>', false)
            ->assertSee('<b', false)
            ->assertSee('Bold')
            ->assertSee('</b>', false)
            ->assertSee('</div>', false);
    }

    #[Test]
    public function individual_div_input_accepts_attributes()
    {
        $div = (new DivComponent)
            ->setAttribute('id', 'div_id');

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('id="div_id"', false);
    }

    #[Test]
    public function div_accepts_theme()
    {
        $theme = [
            'color' => 'success',
        ];

        $div = (new DivComponent)
            ->setThemes($theme);

        $this->blade('{{ $div }}', [
            'div' => $div,
        ])
            ->assertSee('class="'.processThemes($theme), false);

    }

    #[Test]
    public function the_component_can_return_an_array_representation()
    {
        $div = (new DivComponent)
            ->setContents([
                'span_1' => ComponentBuilder::make(ComponentEnum::SPAN)
                    ->setContent('Span'),
                'bold_1' => ComponentBuilder::make(ComponentEnum::BOLD)
                    ->setContent('Bold'),
            ]);

        $divArray = $div->toArray();

        $this->assertIsArray($divArray);
        $this->assertIsArray($divArray['contents']);
        $this->assertIsArray($divArray['attributes']);

        $this->assertIsArray($divArray['contents']['span_1']);
        $this->assertIsArray($divArray['contents']['bold_1']);

        $this->assertIsArray($divArray['contents']['span_1']['contents']);
        $this->assertEquals('Span', $divArray['contents']['span_1']['contents'][0]);
    }
}
