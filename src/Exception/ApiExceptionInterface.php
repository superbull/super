<?php
namespace Superbull\Super\Exception;

interface ApiExceptionInterface
{
    /**
     * @return Array
     */
    public function getErrorData();
}