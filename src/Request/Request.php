<?php
namespace Superbull\Super\Request;

use Psr\Http\Message\ServerRequestInterface;

class Request implements RequestInterface
{
    /**
     * @var \Psr\Http\Message\ServerRequestInterface
     */
    protected $serverRequest;

    /** 
     * @param \Psr\Http\Message\ServerRequestInterface $request 
     */
    public function __construct(ServerRequestInterface $request)
    { 
        $this->serverRequest = $request;
    }

    /**
     * Implement PSR interfaces
     */
    public function getServerParams(){
        
    }

    public function getCookieParams(){
        
    }

    public function withCookieParams(array $cookies){
        
    }

    public function getQueryParams(){
        
    }

    public function withQueryParams(array $query){
        
    }

    public function getUploadedFiles(){
        
    }

    public function withUploadedFiles(array $uploadedFiles){
        
    }

    public function getParsedBody(){
        
    }

    public function withParsedBody($data){
        
    }

    public function getAttributes(){
        
    }

    public function getAttribute($name, $default = null){
        
    }

    public function withAttribute($name, $value){
        
    }

    public function withoutAttribute($name){
        
    }
} 