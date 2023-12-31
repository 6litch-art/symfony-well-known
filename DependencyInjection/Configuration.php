<?php

namespace Well\Known\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $this->treeBuilder = new TreeBuilder('well_known');

        $rootNode = $this->treeBuilder->getRootNode();
        $this->addGlobalOptionsSection($rootNode);

        return $this->treeBuilder;
    }

    private TreeBuilder $treeBuilder;

    public function getTreeBuilder(): TreeBuilder
    {
        return $this->treeBuilder;
    }

    private function addGlobalOptionsSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->booleanNode('enable')
            ->info('Enable feature')
            ->defaultValue(true)
            ->end()
            ->booleanNode('basedir_warning')
            ->info('Make sure to display warning message in case this bundle is enabled but website not at the root')
            ->defaultValue(true)
            ->end()
            ->booleanNode('alias_to_public')
            ->info('Make sure to create symbolink from files into .well_known directory to public root')
            ->defaultValue(true)
            ->end()
            ->booleanNode('override_existing')
            ->info('Override text files in case it already exists')
            ->defaultValue(true)
            ->end()
            ->scalarNode('location_uri')
            ->info('Location of the [security,robots,..].txt files')
            ->defaultValue("/.well-known")
            ->end()
            ->arrayNode('gnupg')->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('directory')
            ->info('Location of the GNUpg program')
            ->defaultValue("~/.gnupg")
            ->end()
            ->end()
            ->children()
            ->scalarNode('uid')
            ->info('Identifier of the pubring to consider')
            ->end()
            ->end()
            ->end()
            ->arrayNode('resources')->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('humans_txt')
            ->info('Location of the humans.txt file')
            ->defaultValue(null)
            ->end()
            ->arrayNode('ads_txt')
            ->arrayPrototype()
            ->scalarPrototype()->end()
            ->end()
            ->end()
            ->arrayNode('robots_txt')
            ->arrayPrototype()
            ->children()
            ->arrayNode('user_agent')
            ->scalarPrototype()->end()
            ->end()
            ->arrayNode('disallow')
            ->scalarPrototype()->end()
            ->end()
            ->arrayNode('allow')
            ->scalarPrototype()->end()
            ->end()
            ->arrayNode('sitemap')
            ->scalarPrototype()->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->scalarNode('change_password')
            ->info('Change password page')
            ->defaultValue(NULL)
            ->end()
            ->arrayNode('security_txt')->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('canonical')
            ->info('Location of the canonical security.txt (relative to HTTP base directory)')
            ->defaultValue(null)
            ->end()
            ->scalarNode('encryption')
            ->info('Location of the encryption key (relative to HTTP base directory)')
            ->defaultValue(null)
            ->end()
            ->scalarNode('expires')
            ->info('Expiration date: either a datetime using RFC3999 format or modifier (e.g. +1y)')
            ->defaultValue(null)
            ->end()
            ->arrayNode('contacts')
            ->addDefaultChildrenIfNoneSet()
            ->prototype('scalar')
            ->end()
            ->end()
            ->arrayNode('preferred_languages')
            ->addDefaultChildrenIfNoneSet()
            ->prototype('scalar')
            ->end()
            ->end()
            ->scalarNode('acknowledgements')
            ->info('Acknowledgement page ')
            ->defaultValue(NULL)
            ->end()
            ->scalarNode('policy')
            ->info('Policy page')
            ->defaultValue(NULL)
            ->end()
            ->scalarNode('hiring')
            ->info('Hiring page information')
            ->defaultValue(NULL)
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();
    }
}
