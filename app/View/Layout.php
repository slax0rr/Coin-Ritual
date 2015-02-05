<?php
namespace View;

use \SlaxWeb\View\View;

class Layout extends View
{
    public function __construct(array $data = [], array $options = ["cache" => TWIGCACHE])
    {
        parent::__construct($data, $options);

        $this->viewData = ["content" => $this->view, "contentData" => $this->viewData];
        $this->view = "Layout.html";
    }
}
