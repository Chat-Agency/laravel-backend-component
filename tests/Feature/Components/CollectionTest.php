<?php

declare(strict_types=1);

namespace Tests\Feature\Components;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class CollectionTest extends TestCase
{
    #[Test]
    public function empty_collection()
    {
        $collection = ComponentBuilder::make(ComponentEnum::COLLECTION);

        $this->blade('{{ $collection }}', [
            'collection' => $collection,
        ])
            ->assertSee('', false);
    }

    #[Test]
    public function collection_accepts_content()
    {
        $collection = ComponentBuilder::make(ComponentEnum::COLLECTION)
            ->setContent(
                ComponentBuilder::make(ComponentEnum::PARAGRAPH)
                    ->setContent('This is the content content')
            );

        $this->blade('{{ $collection }}', [
            'collection' => $collection,
        ])
            ->assertSee('<p', false)
            ->assertSee('This is the content content')
            ->assertSee('</p>', false);
            ;
    }
}
