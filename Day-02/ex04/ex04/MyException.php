<?php

require_once "TemplateEngine.php";
require_once "Elem.php";

class MyException extends Exception
{
    private $element;
    private $content;

    public function __construct($element, $content)
    {
        $errorMessage = COLOR_RED . "Error. The element " . COLOR_RESET . "'$this->element'" . COLOR_RED . " with the content " . COLOR_RESET . "'$this->content'" 
        . COLOR_RED . " you used is not authorized in this exercise. Please, try only the following elements :\n" . COLOR_RESET .
        "\t- meta\n" .
        "\t- img\n" .
        "\t- hr\n" .
        "\t- br\n" .
        "\t- html\n" .
        "\t- head\n" .
        "\t- body\n" .
        "\t- title\n" .
        "\t- h1\n" .
        "\t- h2\n" .
        "\t- h3\n" .
        "\t- h4\n" .
        "\t- h5\n" .
        "\t- h6\n" .
        "\t- p\n" .
        "\t- span\n" .
        "\t- div\n" .
        "\t- table\n" .
        "\t- tr\n" .
        "\t- th\n" .
        "\t- td\n" .
        "\t- ul\n" .
        "\t- ol\n" .
        "\t- li\n" . COLOR_RESET;
        parent::__construct($errorMessage);
        $this->element = $element;
        $this->content = $content;
    }

    public function __destruct()
    {

    }
}

?>