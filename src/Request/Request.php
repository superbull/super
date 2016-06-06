<?php
namespace Superbull\Super\Request;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements RequestInterface
{
    /**
     * @var \Psr\Http\Message\ServerRequestInterface
     */
    protected $serverRequest;

    /**
     * @var array|null
     */
    protected $pagination;

    /** 
     * @param \Psr\Http\Message\ServerRequestInterface $request 
     */
    public function __construct(ServerRequestInterface $request)
    { 
        $this->serverRequest = $request;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return array|string|null
     */
    public function getQueryParam($name, $default = null)
    {
        $queryParams = $this->serverRequest->getQueryParams();
        return isset($queryParams[$name]) ? $queryParams[$name] : $default;
    }

    /**
     * @return array
     */
    public function getPagination()
    {
        if ($this->pagination === null) {
            $this->setPagination();
        }
        return $this->pagination;
    }

    protected function setPagination()
    {
        $page    = $this->getQueryParam('page', 1);
        $perPage = $this->getQueryParam('per_page', 30);

        $this->pagination = [
            'page'    => $page,
            'perPage' => $perPage,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->serverRequest->getProtocolVersion();
    }
    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withProtocolVersion($version);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->serverRequest->getHeaders();
    }
    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        return $this->serverRequest->hasHeader($name);
    }
    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        return $this->serverRequest->getHeader($name);
    }
    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        return $this->serverRequest->getHeaderLine($name);
    }
    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withHeader($name, $value);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withAddedHeader($name, $value);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withoutHeader($name);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->serverRequest->getBody();
    }
    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withBody($body);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getRequestTarget()
    {
        return $this->serverRequest->getRequestTarget();
    }
    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withRequestTarget($requestTarget);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return $this->serverRequest->getMethod();
    }
    /**
     * @inheritDoc
     */
    public function withMethod($method)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withMethod($method);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return $this->serverRequest->getUri();
    }
    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withUri($uri, $preserveHost);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getServerParams()
    {
        return $this->serverRequest->getServerParams();
    }
    /**
     * @inheritDoc
     */
    public function getCookieParams()
    {
        return $this->serverRequest->getCookieParams();
    }
    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withCookieParams($cookies);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getQueryParams()
    {
        return $this->serverRequest->getQueryParams();
    }
    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withQueryParams($query);
        $self->initializeParsedQueryParams();
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getUploadedFiles()
    {
        return $this->serverRequest->getUploadedFiles();
    }
    /**
     * @inheritDoc
     */
    public function withUploadedFiles(array $uploadedFiles)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withUploadedFiles($uploadedFiles);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getParsedBody()
    {
        $content = $this->serverRequest->getBody()->getContents();
        if ($content && empty($this->serverRequest->getParsedBody())) {
            $this->serverRequest = $this->serverRequest->withParsedBody(
                json_decode($content, true)
            );
        }
        return $this->serverRequest->getParsedBody();
    }
    /**
     * @inheritDoc
     */
    public function withParsedBody($data)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withParsedBody($data);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function getAttributes()
    {
        return $this->serverRequest->getAttributes();
    }
    /**
     * @inheritDoc
     */
    public function getAttribute($name, $default = null)
    {
        return $this->serverRequest->getAttribute($name, $default);
    }
    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withAttribute($name, $value);
        return $self;
    }
    /**
     * @inheritDoc
     */
    public function withoutAttribute($name)
    {
        $self = clone $this;
        $self->serverRequest = $this->serverRequest->withoutAttribute($name);
        return $self;
    }
} 