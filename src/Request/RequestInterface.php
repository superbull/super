<?php
namespace Superbull\Super\Request;

use Psr\Http\Message\ServerRequestInterface;

interface RequestInterface extends ServerRequestInterface
{
    /**
     * @return array
     */
    public function getSort();

    /**
     * @return array
     */
    public function getPagination();
}