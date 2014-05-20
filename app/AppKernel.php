<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Samson\Bundle\AddressBookBundle\SamsonAddressBookBundle(),
            new Samson\Bundle\AutocompleteBundle\SamsonAutocompleteBundle(),
            new Samson\Bundle\CoreBundle\SamsonCoreBundle(),
            new Samson\Bundle\DataGridBundle\SamsonDataGridBundle(),
            new Samson\Bundle\FilterBundle\SamsonFilterBundle(),
            new Samson\Bundle\FrameworkBundle\SamsonFrameworkBundle(),
            new Samson\Bundle\FrameworkExtraBundle\SamsonFrameworkExtraBundle(),
            new Samson\Bundle\ReleaseBundle\SamsonReleaseBundle(),
            new Samson\Bundle\SecurityBundle\SamsonSecurityBundle(),
            new Samson\Bundle\StatisticsBundle\SamsonStatisticsBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new \FOS\RestBundle\FOSRestBundle,
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Example\ExampleBundle\ExampleExampleBundle(),
            new Plu\RerBundle\PluRerBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
