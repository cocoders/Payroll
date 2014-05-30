<?php
/**
 * Created by PhpStorm.
 * User: skowi
 * Date: 14.04.14
 * Time: 19:45
 */

namespace Requestor;


class UseCaseFactory {

    private $useCases;

    public function addUseCase($string, $className)
    {
        $this->useCases[$string] = $className;
    }

    /**
     * @param $name
     * @return UseCase
     */
    public function create($name)
    {
        return $this->useCases[$name];
    }
}
