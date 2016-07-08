<?php
namespace Superbull\Super\Repository;

use Psr\Log\LoggerInterface;
use Aura\Sql\ExtendedPdo;

abstract class AbstractRepository
{
    protected $logger;
    protected $pdo;

    public function __construct(
        ExtendedPdo $pdo
    ) {
        $this->logger = $logger;
        $this->pdo = $pdo;
    }
}