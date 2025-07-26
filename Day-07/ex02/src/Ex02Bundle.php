<?php

namespace App;

use App\DependencyInjection\AppExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class Ex02Bundle extends Bundle
{
    public function getContainerExtension(): ExtensionInterface
    {
        return new AppExtension();
    }
}
