<?php

namespace Superbull\Super\Exception;

class ValidationFailed extends ApiException
{
    protected $errors = [];

    public function __construct($errors)
    {
        parent::__construct('Validation Failed', 422);
        $this->errors = $errors;
    }

    public function getErrorData()
    {
        return [
            'message' => $this->getMessage(),
            'code'  => $this->getCode(),
            'errors' => $this->errors,
        ];
    }
}