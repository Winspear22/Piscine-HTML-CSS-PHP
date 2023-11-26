<?php
define("COLOR_RED", "\033[31m");
define("COLOR_GREEN", "\033[32m");
define("COLOR_YELLOW", "\033[33m");
define("COLOR_BLUE", "\033[34m");
define("COLOR_MAGENTA", "\033[35m");
define("COLOR_CYAN", "\033[36m");
define("COLOR_RESET", "\033[0m");

require_once 'Elem.php';

class TemplateEngine
{

    private $elem;

    function __construct(
        Elem $elem
    )
    {
        $this->elem = $elem;
        print(COLOR_GREEN . 'Constructor TemplateEngine called' . COLOR_RESET . PHP_EOL);
    }

    function __destruct()
    {
        print(COLOR_BLUE . 'Destructor TemplateEngine called' . COLOR_RESET . PHP_EOL);
    }

    public function createFile(string $fileName)
    {
        file_put_contents($fileName, $this->elem->getHTML());
    }
}
