<?php

namespace ChatAgency\BackendComponents\Contracts;

interface ContentComponent
{
    public function getContent() : string| BackendComponent |null;

    public function setContent(string|BackendComponent $content) : static;

}
