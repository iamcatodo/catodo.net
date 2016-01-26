<?php
namespace Catodo;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ActionInterface
{
    public function __invoke(RequestInterface $req, ResponseInterface $res, callable $next);
}
