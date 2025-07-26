<?php

namespace App\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('d07');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->integerNode('number')
                    ->isRequired()
                    ->info('The number setting (required)')
                ->end()
                ->booleanNode('enable')
                    ->defaultTrue()
                    ->info('Optional enable flag (default true)')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
