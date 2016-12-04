<?php

namespace Ntq\Contract;

/**
 * Http Request Interface.
 *
 * @package Ntq\Contract
 */
interface RequestInterface
{
    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getQuery($name = null, $default = null);

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getPost($name = null, $default = null);
}