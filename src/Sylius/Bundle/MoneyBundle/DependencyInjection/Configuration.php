<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\MoneyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sylius_money');

        $rootNode
            ->children()
                ->scalarNode('driver')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('locale')->defaultValue('en')->cannotBeEmpty()->end()
                ->scalarNode('currency')->defaultValue('EUR')->cannotBeEmpty()->end()
            ->end()
        ;

        $this->addClassesSection($rootNode);

        return $treeBuilder;
    }

    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('exchange_rate')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Sylius\Bundle\MoneyBundle\Model\ExchangeRate')->end()
                                ->scalarNode('controller')->defaultValue('Sylius\Bundle\ResourceBundle\Controller\ResourceController')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Sylius\Bundle\MoneyBundle\Form\Type\ExchangeRateType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('currency')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('controller')->defaultValue('Sylius\Bundle\MoneyBundle\Controller\CurrencyController')->end()
                            ->end()
                        ->end()
                        ->arrayNode('http_client')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('exchange_rate')->defaultValue('Guzzle\Http\Client')->end()
                            ->end()
                        ->end()
                        ->arrayNode('google_provider')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('exchange_rate')->defaultValue('Sylius\Bundle\MoneyBundle\ExchangeRate\Provider\GoogleProvider')->end()
                            ->end()
                        ->end()
                        ->arrayNode('factory')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('exchange_rate')->defaultValue('Sylius\Bundle\MoneyBundle\ExchangeRate\Provider\Factory')->end()
                            ->end()
                        ->end()
                        ->arrayNode('updater')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('exchange_rate')->defaultValue('Sylius\Bundle\MoneyBundle\ExchangeRate\Updater\DatabaseUpdater')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
