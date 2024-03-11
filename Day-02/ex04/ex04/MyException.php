<?php

require_once "TemplateEngine.php";
require_once "Elem.php";

class MyException extends Exception
{
    public function errorMessage(): string
    {
        $errorMessage = "Error. The tag you used is not authorized in this exercise. Please, try only the following tags :\n" .
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
        "\t- li";
        return $errorMessage;
    }
}

?>