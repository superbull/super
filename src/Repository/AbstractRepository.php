<?php
namespace Superbull\Super\Repository;

use Aura\Sql\ExtendedPdo;

abstract class AbstractRepository
{
    protected $pdo;

    public function __construct(
        ExtendedPdo $pdo
    ) {
        $this->pdo = $pdo;
    }
}