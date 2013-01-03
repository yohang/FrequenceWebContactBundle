<?php

namespace FrequenceWeb\Bundle\ContactBundle\Tests\Functional;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * A test application kernel
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class AppKernel extends Kernel
{
    /**
     * @{inheritDoc}
     */
    public function registerBundles()
    {
        return array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \FrequenceWeb\Bundle\ContactBundle\FrequenceWebContactBundle(),
        );
    }

    /**
     * @{inheritDoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }
}
