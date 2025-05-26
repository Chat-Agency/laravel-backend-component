<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Exceptions;

use Throwable;

class ThemeDoesNotExistsException extends \Exception
{
    public function __construct($message, $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__.": [{$this->code}]: {$this->message}\n";
    }
}
