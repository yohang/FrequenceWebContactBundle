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
        );
    }

    /**
     * @{inheritDoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {

    }
}
