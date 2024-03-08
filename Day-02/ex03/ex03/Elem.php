<?php

require_once 'TemplateEngine.php';

class Elem
{
    private $element;
    private $content = [];

    public function __construct(string $element, array $content)
    {
        $this->element = $element;
        $this->content = $content;
        print(COLOR_YELLOW . 'Constructor Elem called' . COLOR_RESET . PHP_EOL);
        echo $this->element;
        foreach ($this->content as $string)
        {
            echo $string;
        }
    }

    public function __destruct()
    {
        print(COLOR_YELLOW . 'Constructor Elem called' . COLOR_RESET . PHP_EOL);
    }

    public function pushElement(string $newElement)
    {
        
    }
}

?>