<?php
namespace Superbull\Super\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class CorsMiddleware
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
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ORIGIN'])) {
                $response = $response->withHeader('Access-Control-Allow-Origin', "{$_SERVER['HTTP_ORIGIN']}");
                $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                $response = $response->withHeader(
                    'Access-Control-Allow-Methods', 
                    'GET, POST, OPTIONS'
                );         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                $response = $response->withHeader(
                    "Access-Control-Allow-Headers", 
                    "{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}"
                );

            return $response->withStatus(200);
        } else {
            
            $response = $next(null, $response);
            
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                $response = $response->withHeader('Access-Control-Allow-Origin', "{$_SERVER['HTTP_ORIGIN']}");
                $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');
                $response = $response->withHeader('Access-Control-Expose-Headers', 'X-Page, X-Per-Page, X-Total-Count');
            }

            return $response;
        }

        




        // $response->withHeader('Access-Control-Allow-Origin', '*');
        // $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, HEAD');
        // $response->withHeader('Access-Control-Allow-Headers', 'origin, content-type, accept, authorization');
        // $response->withHeader(
        //         "Access-Control-Allow-Credentials",
        //         "true"
        // );
        // $response->withHeader(
        //         "Access-Control-Expose-Headers",
        //         "Link,X-Pagination-Page-Next,X-Pagination-Page-Prev"
        // );


        // if (isset($_SERVER['HTTP_ORIGIN'])) {
        //     header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        //     header('Access-Control-Allow-Credentials: true');
        //     // header('Access-Control-Max-Age: 86400');    // cache for 1 day
        // }

        // // Access-Control headers are received during OPTIONS requests
        // if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        //         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        //         header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        //     exit;
        // }
        
        // $this->logger->debug('cors', $response->getHeaders());
        
    }
}
