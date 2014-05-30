<?php

namespace Requestor;

abstract class UseCase
{
    abstract public function execute(Request $request);
}
