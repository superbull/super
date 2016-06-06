<?php
namespace Superbull\Super\Request;

use Psr\Http\Message\ServerRequestInterface;

interface RequestInterface extends ServerRequestInterface
{
    /**
     * Returns a query parameter with a name of $name if it is present in the request, or the $default value otherwise.
     *
     * @param string $name
     * @param mixed $default
     * @return array|string
     */
    public function getQueryParam($name, $default = null);

    /**
     * @return array|null
     */
    public function getPagination();
}