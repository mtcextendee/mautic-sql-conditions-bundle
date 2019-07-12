<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

/** @var \MauticPlugin\MauticSqlConditionsBundle\Entity\SqlConditions $entity */
$isEmbedded = false;
if (!$isEmbedded) {
    $view->extend('MauticCoreBundle:Default:content.html.php');
}
$view['slots']->set(
    'headerTitle',
    $entity->getName()
);

$customButtons = [];
if (!$isEmbedded) {
    $view['slots']->set(
        'actions',
        $view->render(
            'MauticCoreBundle:Helper:page_actions.html.php',
            [
                'item'            => $entity,
                'customButtons'   => (isset($customButtons)) ? $customButtons : [],
                'templateButtons' => [
                    'edit'   => false,
                    'clone'  => false,
                    'delete' => $view['security']->hasEntityAccess(
                        $permissions['sqlConditions:sqlConditions:deleteown'],
                        $permissions['sqlConditions:sqlConditions:deleteother'],
                        $entity->getCreatedBy()
                    ),
                    'close'  => $view['security']->hasEntityAccess(
                        $permissions['sqlConditions:sqlConditions:viewown'],
                        $permissions['sqlConditions:sqlConditions:viewother'],
                        $entity->getCreatedBy()
                    ),
                ],
                'routeBase'       => 'sqlConditions',
            ]
        )
    );
}
?>

<!-- start: box layout -->
<div class="box-layout">
    <!-- left section -->
    <div class="col-md-9 bg-white height-auto">
        <div class="bg-auto">
            <!-- page detail header -->
            <div class="pr-md pl-md pt-lg pb-lg">
                <div class="box-layout">
                    <div class="col-xs-10">
                    </div>
                </div>
            </div>
            <!--/ page detail header -->

            <!--/ page detail collapseable -->
        </div>

        <!--/ end: box layout -->
