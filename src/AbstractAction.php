<?php
namespace Catodo;

use League\Plates\Engine as Template;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractAction implements ActionInterface
{
    protected $template;

    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    public function __invoke(RequestInterface $req, ResponseInterface $res, callable $next)
    {
        return $this->template->render($this->getShortClassName(get_called_class()));
    }

    protected function getShortClassName($class)
    {
        return strtolower(substr($class, strrpos($class, '\\') + 1));
    }
}
