<?php

namespace Graze;

use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class PhpLayoutRenderer extends PhpRenderer
{
    /**
     * @var string
     */
    private $layoutPath;

    /**
     * @param string $layoutPath
     * @param string $templatePath
     * @param array $attributes
     */
    public function __construct($layoutPath, $templatePath = "", array $attributes = [])
    {
        parent::__construct($templatePath, $attributes);
        $this->layoutPath = $layoutPath;
    }

    /**
     * @param ResponseInterface $response
     * @param string $template
     * @param array $data
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, $template, array $data = [])
    {
        $output = $this->fetch($template, $data);
        
        return parent::render($response, $this->layoutPath, ['content' => $output, 'summary' => $data['summary']]);
    }
}
