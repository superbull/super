<?php

namespace Superbull\Super\Exception;

class Unauthorized extends ApiException
{
    public function __construct()
    {
        parent::__construct('Login is required', 401);
    }
}