<?php
namespace Catodo;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Artwork extends AbstractAction
{
    public function __invoke(RequestInterface $req, ResponseInterface $res, callable $next)
    {
        $path = $req->getUri()->getPath();
        return $this->template->render($path);
    }
}
