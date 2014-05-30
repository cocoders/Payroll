<?php
/**
 * Created by PhpStorm.
 * User: skowi
 * Date: 14.04.14
 * Time: 19:45
 */

namespace Requestor;


class RequestBuilder {

    private $requests = array();

    public function addRequest($name, callable $call)
    {
        $this->requests[$name] = $call;
    }

    public function build($name, array $parameters)
    {
        return $this->requests[$name]($parameters);
    }
}
