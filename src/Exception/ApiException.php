<?php

namespace Superbull\Super\Exception;

use Superbull\Super\Exception\ApiExceptionInterface;

abstract class ApiException extends \Exception implements ApiExceptionInterface
{
    /**
     * @param string $message
     */
    public function __construct($message, $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function getErrorData()
    {
        return [
            'error' => $this->getMessage(),
            'code'  => $this->getCode(),
        ];
    }
}