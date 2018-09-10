<?php

namespace FrequenceWeb\Bundle\ContactBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('frequence_web_contact');

        $rootNode
            ->children()
                ->scalarNode('send_mails')->defaultTrue()->end()
                ->scalarNode('to')->defaultNull()->end()
                ->scalarNode('from')->defaultValue('no-reply@example.com')->end()
                ->scalarNode('subject')->defaultNull()->end()
                ->arrayNode('fixed_to_and_subject')
                ->arrayPrototype()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('title')->end()
                        ->scalarNode('email')->end()
                        ->end()
                    ->end()
                ->end()
        ;

        return $treeBuilder;
    }
}
