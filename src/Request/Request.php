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