<?php

namespace FrequenceWeb\Bundle\ContactBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader,
    Symfony\Component\Config\FileLocator;

use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\ContactEvents;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class FrequenceWebContactExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        // Adds the config to the mail event listener
        $definition = $container->getDefinition('frequence_web_contact.email_listener');
        $definition->addArgument($config);

        // If mail listener is activated
        if (true === $config['send_mails']) {
            // "To" field is mandatory
            if (null === $config['to']) {
                throw new \InvalidArgumentException('You have to define a "frequence_web_contact.to" address to use the email contact');
            }
            // Add the mail event listener to the dispatcher
            $definition->addTag(
                'kernel.event_listener',
                array('event' => ContactEvents::onMessageSubmit, 'method' => 'onMessageSubmit')
            );
        }
    }
}
