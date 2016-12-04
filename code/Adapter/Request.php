<?php

namespace Ntq\Adapter;

use Illuminate\Http\Request as IlluminateRequest;
use Ntq\Contract\RequestInterface;

/**
 * Http Request Adapter.
 *
 * @package Ntq\Adapter
 */
class Request implements RequestInterface
{
    /**
     * @var IlluminateRequest
     */
    private $request;

    /**
     * @param IlluminateRequest $request
     */
    public function __construct(IlluminateRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function getQuery($name = null, $default = null)
    {
        return $this->request->query->get($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function getPost($name = null, $default = null)
    {
        return $this->request->get($name, $default);
    }
}