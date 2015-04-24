<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Invoices;

use Invoices\Model\Invoices;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;

class Module
{
    public function init(ModuleManager $manager)
    {
        $events = $manager->getEventManager();
        $events->attach(ModuleEvent::EVENT_MERGE_CONFIG, [$this, 'checkConfig']);
    }

    public function checkConfig(ModuleEvent $event)
    {
        $configListener = $event->getConfigListener();
        $config = $configListener->getMergedConfig(false);

        $keys = ['login', 'password', 'host', 'token', 'lang'];

        foreach ($keys as $k) {
            if (empty($config['fakturownia'][$k])) {
                throw new \Exception(sprintf("Invoices configuration error: '%s' is empty", $k));
            }
        }
    }

    public function getConfig()
    {
        $config = array();
        $configFiles = array(
            include __DIR__ . '/config/module.config.php',
        );
        foreach ($configFiles as $file) {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, $file);
        }

        return $config;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'invoices.procesor' => function ($sm) {
                    return new Invoices($sm);
                },
            ],
        ];
    }
}
