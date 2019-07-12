<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle;

final class SqlConditionsEvents
{

    /**
     * The mautic.sqlConditions_pre_save event is thrown right before a asset is persisted.
     *
     * The event listener receives a
     * MauticPlugin\MauticSqlConditionsBundle\Event\SqlConditionsEvent instance.
     *
     * @var string
     */
    const PRE_SAVE = 'mautic.sqlConditions_pre_save';

    /**
     * The mautic.sqlConditions_post_save event is thrown right after a asset is persisted.
     *
     * The event listener receives a
     * MauticPlugin\MauticSqlConditionsBundle\Event\SqlConditionsEvent instance.
     *
     * @var string
     */
    const POST_SAVE = 'mautic.sqlConditions_post_save';

    /**
     * The mautic.sqlConditions_pre_delete event is thrown prior to when a asset is deleted.
     *
     * The event listener receives a
     * MauticPlugin\MauticSqlConditionsBundle\Event\SqlConditionsEvent instance.
     *
     * @var string
     */
    const PRE_DELETE = 'mautic.sqlConditions_pre_delete';

    /**
     * The mautic.sqlConditions_post_delete event is thrown after a asset is deleted.
     *
     * The event listener receives a
     * MauticPlugin\MauticSqlConditionsBundle\Event\SqlConditionsEvent instance.
     *
     * @var string
     */
    const POST_DELETE = 'mautic.sqlConditions_post_delete';

}
