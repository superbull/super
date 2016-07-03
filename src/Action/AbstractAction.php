<?php
namespace Superbull\Super\Action;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use \Superbull\Super\Exception\ValidationFailed;

abstract class AbstractAction
{
    protected $logger;
    protected $rules = [];

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->validate($request->getQueryParams());
    }

    protected function validate($queryParams)
    {
        $v = new \Valitron\Validator($queryParams);
        $v->rules($this->rules);
        if(!$v->validate()) {
            throw new ValidationFailed($v->errors());
        }
    }
}