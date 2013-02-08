<?php

namespace Nanaweb\MyFormBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class NanawebMyFormExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        //TODO: check if templating engine is twig or not
        $loader->load('twig.yml');
        $formResources = $container->getParameter('twig.form.resources');
        $additionalFormResources = $container->getParameter('nanaweb_myform.form_resources');
        foreach ($additionalFormResources as $resource)
        {
            $formResources[] = $resource;
        }
        $container->setParameter('twig.form.resources', $formResources);
    }
}
