<?php
namespace Superbull\Super\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class BodyParserMiddleware
{
    protected $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param callable $next
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        if (!$request->getParsedBody() && 
            in_array($request->getMethod(), ['POST', 'PUT', 'DELETE'], true)
        ) {
            if ($request->getHeaderLine('Content-Type') === "application/json") {
                $request = $request->withParsedBody(json_decode((string) $request->getBody(), true));
            }
        }

        return $next($request);
    }
}
