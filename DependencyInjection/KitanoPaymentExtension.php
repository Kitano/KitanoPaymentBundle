<?php

namespace Kitano\Bundle\PaymentBundle\DependencyInjection;

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

        foreach (array('controller', 'repository') as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }

        $paymentSystemServiceId = $config['service']['payment_system'];
        $notificationControllerDef = $container->getDefinition('kitano_payment.controller.payment_notification');
        $notificationControllerDef->replaceArgument(0, new Reference($paymentSystemServiceId));

        if ($container->getParameter('kernel.debug')) {
            $notificationControllerDef->addMethodCall('setLogger', array(
                new Reference('logger'),
            ));
        }
    }

}