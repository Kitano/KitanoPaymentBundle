<?php

namespace Kitano\PaymentBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Initializes extension
 *
 * @author Benjamin Dulau <benjamin.dulau@anonymation.com>
 */
class KitanoPaymentExtension extends Extension
{
    /**
     * Loads configuration
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        foreach (array('service') as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }

        $this->remapParameters($config['service'], $container, array(
            'payment_system'  => 'kitano_payment.payment_system'
        ));
    }
    /**
     * Dynamically remaps parameters from the config values
     *
     * @param array            $config
     * @param ContainerBuilder $container
     * @param array            $namespaces
     * @return void
     */
    protected function remapParametersNamespaces(array $config, ContainerBuilder $container, array $namespaces)
    {
        foreach ($namespaces as $ns => $map) {
            if ($ns) {
                if (!isset($config[$ns])) {
                    continue;
                }
                $namespaceConfig = $config[$ns];
            } else {
                $namespaceConfig = $config;
            }
            if (is_array($map)) {
                $this->remapParameters($namespaceConfig, $container, $map);
            } else {
                foreach ($namespaceConfig as $name => $value) {
                    if (null !== $value) {
                        $container->setParameter(sprintf($map, $name), $value);
                    }
                }
            }
        }
    }

    /**
     *
     * @param array            $config
     * @param ContainerBuilder $container
     * @param array            $map
     * @return void
     */
    protected function remapParameters(array $config, ContainerBuilder $container, array $map)
    {
        foreach ($map as $name => $paramName) {
            if (isset($config[$name])) {
                $container->setParameter($paramName, $config[$name]);
            }
        }
    }


}