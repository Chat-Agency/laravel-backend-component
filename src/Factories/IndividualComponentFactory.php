<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Factories;

use ChatAgency\BackendComponents\Concerns\isFactory;
use ChatAgency\BackendComponents\Contracts\BackendComponent;
use ChatAgency\BackendComponents\Contracts\CompoundComponent;
use ChatAgency\BackendComponents\Contracts\IndividualComponent;

final class IndividualComponentFactory
{
    use isFactory;

    /**
     * @param array{
     *  name:  int|string,
     *  component: class-string<BackendComponent|CompoundComponent>,
     * } $componentArray
     */
    public function initComponent(array $componentArray): BackendComponent|CompoundComponent
    {
        $componentClass = $componentArray['component'];

        return match (true) {
            in_array(IndividualComponent::class, class_implements($componentClass)) => (new $componentClass),
            default => (new $componentClass($componentArray['name'])),
        };

    }
}
