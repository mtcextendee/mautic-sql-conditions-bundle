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
            'mautic.sqlConditions.campaign.condition.subscriber' => [
                'class'     => \MauticPlugin\MauticSqlConditionsBundle\EventListener\CampaignConditionSubscriber::class,
                'arguments' => [
                    'mautic.sqlConditions.executioner',
                ],
            ],
        ],
        'forms'   => [
            'mautic.sqlConditions.form.campaign.type' => [
                'class'     => \MauticPlugin\MauticSqlConditionsBundle\Form\Type\SqlListType::class,
                'arguments' => [
                ],
            ],
            'mautic.sqlConditions.form.list.type' => [
                'class'     => \MauticPlugin\MauticSqlConditionsBundle\Form\Type\SqlConditionsCampaignType::class,
                'arguments' => 'router',
                'alias'     => 'sqlconditions_list',
            ],
        ],
        'command' => [

        ],
        'other'   => [
            'mautic.sqlConditions.executioner' => [
                'class' => \MauticPlugin\MauticSqlConditionsBundle\Executioner\SqlExecutioner::class,
                'arguments' => [
                    'mautic.sqlConditions.executioner.condition.details',
                    'mautic.sqlConditions.executioner.query.builder',
                ],
            ],
            'mautic.sqlConditions.executioner.condition.details' => [
                'class' => \MauticPlugin\MauticSqlConditionsBundle\Executioner\SqlConditionDetails::class,
                'arguments'=>[
                    'mautic.sqlConditions.model.sqlConditions'
                ]
            ],
            'mautic.sqlConditions.executioner.params' => [
                'class' => \MauticPlugin\MauticSqlConditionsBundle\Executioner\Params\Params::class,
            ],
            'mautic.sqlConditions.executioner.query.builder' => [
                'class' => \MauticPlugin\MauticSqlConditionsBundle\Executioner\QueryBuilder::class,
                'arguments'=>[
                    'doctrine.orm.entity_manager',
                    'mautic.sqlConditions.executioner.params'
                ]
            ],
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
                    'priority' => 49,
                    'iconClass' => 'fa fa-database',
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
