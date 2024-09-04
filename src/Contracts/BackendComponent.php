<?php

namespace ChatAgency\BackendComponents\Contracts;

use ChatAgency\BackendComponents\Contracts\AttributeBag;

interface BackendComponent {
    
    public function useLocal($local = true) : static;

    public function getName() : string;

    public function getNamespace() : string | null;

    public function getPath() : string;

    public function getComponentPath() : string;

    public function getAttributes() : array;

    public function getAttribute(string $name) : string | null;

    public function getAttributeBag() : AttributeBag;

    public function setNamespace(string $namespace) : static;

    public function setPath(string $path) : static;

    public function setType(?string $name = null) : static;

    public function setAttribute(string $name, $content) : static;

    public function setAttributes(array $attributes) : static;
    
    public function toArray() : array;

    public function __toString() : string;

    public function toHtml();
}
