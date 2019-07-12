<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\Event;

use Mautic\CoreBundle\Event\CommonEvent;
use MauticPlugin\MauticSqlConditionsBundle\Entity\SqlConditions;

class SqlConditionsEvent extends CommonEvent
{
    /**
     * SqlConditionsEvent constructor.
     *
     * @param SqlConditions $entity
     * @param bool                $isNew
     */
    public function __construct(SqlConditions $entity, $isNew = false)
    {
        $this->entity = $entity;
        $this->isNew  = $isNew;
    }

    /**
     * @return SqlConditions
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param SqlConditions $entity
     */
    public function setEntity(SqlConditions $entity)
    {
        $this->entity = $entity;
    }
}
