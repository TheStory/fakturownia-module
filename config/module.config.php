<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Invoices;

return array(
    'service_manager' => array(
        'invokables' => array(
            'invoices.procesor' => 'Invoices\Repository\Invoices',
            'repo.invoices' => 'Invoices\Entity\Invoices',
        ),
    ),
    // Doctrine entities configuration
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    'fakturownia' => array(
        'login' => 'przemyslaw-kublin',
        'password' => '',
        'host' => 'przemyslaw-kublin.fakturownia.pl',
        'token' => 'fb8dhvPYfgMaroU7otV/przemyslaw-kublin',
    ),
    'invoices_entity' => 'Application\Entity\Test'
);