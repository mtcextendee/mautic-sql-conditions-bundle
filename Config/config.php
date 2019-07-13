<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

return [
    'name'        => 'SqlConditions',
    'description' => 'SQL conditions for Mautic',
    'author'      => 'mtcextendee.com',
    'version'     => '1.0.0',
    'services'    => [
        'events'  => [

        ],
        'forms'   => [
        ],
        'command' => [

        ],
        'other'   => [

        ],

        'helpers'      => [],
        'models'       => [
            'mautic.sqlConditions.model.sqlConditions' => [
                'class' => \MauticPlugin\MauticSqlConditionsBundle\Model\SqlConditionsModel::class,
            ],
        ],
        'integrations' => [
            'mautic.integration.sqlConditions' => [
                'class' => \MauticPlugin\MauticSqlConditionsBundle\Integration\SqlConditionsIntegration::class,
            ],
        ],
    ],
    'routes'      => [
        'main' => [
            'mautic_sqlConditions_index'  => [
                'path'       => '/sqlConditions/{page}',
                'controller' => 'MauticSqlConditionsBundle:SqlConditions:index',
            ],
            'mautic_sqlConditions_action' => [
                'path'       => '/sqlConditions/{objectAction}/{objectId}',
                'controller' => 'MauticSqlConditionsBundle:SqlConditions:execute',
            ],
        ],
    ],
    'menu'        => [
        'main' => [
            'items' => [
                'mautic.sqlConditions' => [
                    'route'    => 'mautic_sqlConditions_index',
                    'parent'   => 'mautic.campaign.menu.index',
                    'priority' => 70,
                    'checks'   => [
                        'integration' => [
                            'SqlConditions' => [
                                'enabled' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
