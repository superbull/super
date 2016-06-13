<?php
namespace Superbull\Super\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Superbull\Super\Exception\ApiExceptionInterface;
use WoohooLabs\Harmony\Exception\RouteNotFoundException;
use WoohooLabs\Harmony\Exception\MethodNotAllowedException;

class ErrorHandlerMiddleware
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
        try {
            return $next($request, $response);
        } catch (ApiExceptionInterface $apiException) {
            return new JsonResponse($apiException->getErrorData(), $apiException->getCode());
        } catch (RouteNotFoundException $routeNotFoundException) {
            return new JsonResponse([
                'error' => "Route not found."
            ], 400);
        } catch (MethodNotAllowedException $methodNotAllowedException) {
            return new JsonResponse([
                'error' => "Method not allowed."
            ], 400);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
