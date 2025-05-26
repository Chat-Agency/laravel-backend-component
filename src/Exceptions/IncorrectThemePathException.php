<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Exceptions;

use Throwable;

class IncorrectThemePathException extends \Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 500, ?Throwable $previous = null)
    {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__.": [{$this->code}]: {$this->message}\n";
    }
}
