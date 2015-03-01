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
        'login' => '',
        'password' => '',
        'host' => '',
        'token' => '',
        'place' => '',
        'seller_name' => '',
        'seller_tax_no' => '',
        'seller_post_code' => '',
        'seller_city' => '',
        'seller_street' => '',
        'seller_country' => '',
        'lang' => '',
    ),
);