<?php

namespace Leocata\M1;

interface RequestHandlerInterface
{
    /**
     * @param string $uri
     * @param array $formFields
     *
     * @return PromiseInterface
     */
    public function post(string $uri, array $formFields): PromiseInterface;

    /**
     * @param string $uri
     *
     * @return PromiseInterface
     */
    public function get(string $uri): PromiseInterface;
}
