<?php

namespace Feature\Components\Details;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use ChatAgency\BackendComponents\Enums\ComponentEnum;
use ChatAgency\BackendComponents\Builders\ComponentBuilder;

class DetailsTest extends TestCase
{
    #[Test]
    public function empty_details()
    {
        $details = ComponentBuilder::make(ComponentEnum::DETAILS);

        $this->blade('{{ $details }}', [
            'details' => $details,
        ])
            ->assertSee('<details', false)
            ->assertSee('</details>', false);
    }
}
