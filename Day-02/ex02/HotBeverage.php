<?php
/*define("COLOR_RED", "\033[31m");
define("COLOR_GREEN", "\033[32m");
define("COLOR_YELLOW", "\033[33m");
define("COLOR_BLUE", "\033[34m");
define("COLOR_MAGENTA", "\033[35m");
define("COLOR_CYAN", "\033[36m");
define("COLOR_RESET", "\033[0m");*/


require_once 'Tea.php';
require_once 'Coffee.php';

class HotBeverage
{
    function __construct(
        protected string $nom,
        protected float $price,
        protected int $resistance
    ) 
    {
        print(COLOR_CYAN . 'Constructor HotBeverage called' . COLOR_RESET . PHP_EOL);
        $this->nom = $nom;
        $this->price = $price;
        $this->resistance = $resistance;
    }

    function __destruct()
    {
        print(COLOR_CYAN . 'Destructor HotBeverage called' . COLOR_RESET . PHP_EOL);
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getResistance(): int {
        return $this->resistance;
    }
}

?>