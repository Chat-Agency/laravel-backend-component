<?php

declare(strict_types=1);

namespace Unit\Components;

use ChatAgency\BackendComponents\Components\DefaultLivewireComponent;
use ChatAgency\BackendComponents\Contracts\LivewireComponent;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DefaultLivewireComponentTest extends TestCase
{
    #[Test]
    public function it_can_render_a_livewire_component()
    {
        $component = new DefaultLivewireComponent(
            // Livewire component class
            // cannot test since Livewire is not installed
            name: LivewireComponent::class
        );

        $component
            // not required for the specific livewire component
            // ->setLivewire(livewire: true)
            ->setLivewireKey(livewireKey: 'livewire-key')
            ->setLivewireParams(livewireParams: [
                'first_param' => 'First',
            ]);

        $this->assertEquals(
            expected: '@livewire($name, $params, key($key))',
            actual: $component->toHtml(),
        );
    }
}
