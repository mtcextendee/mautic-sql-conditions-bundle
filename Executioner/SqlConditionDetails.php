<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\SqlExecutioner;

use Mautic\CampaignBundle\Event\ConditionEvent;
use MauticPlugin\MauticSqlConditionsBundle\Model\SqlConditionsModel;

class SqlConditionDetails
{
    /**
     * @var SqlConditionsModel
     */
    private $sqlConditionsModel;

    /**
     * @var ConditionEvent
     */
    private $conditionEvent;

    /**
     * SqlCondition constructor.
     *
     * @param SqlConditionsModel $sqlConditionsModel
     */
    public function __construct(SqlConditionsModel $sqlConditionsModel)
    {
        $this->sqlConditionsModel = $sqlConditionsModel;
    }

    /**
     * @param ConditionEvent $conditionEvent
     */
    public function setConditionEvent(ConditionEvent $conditionEvent)
    {
        $this->conditionEvent = $conditionEvent;
    }


    /**
     * @return ConditionEvent
     * @throws \Exception
     */
    public function getConditionEvent()
    {
        if (!$this->conditionEvent) {
            throw new \Exception('Condition event not exist');
        }

        return $this->conditionEvent;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getSqlQuery()
    {
        $sqlConditionId = $this->getConditionEvent()->getEventConfig()['sql'];
        $entity =  $this->sqlConditionsModel->getEntity($sqlConditionId);

        if ($entity) {
            return $entity->getSqlQuery();
        }

    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getContactId()
    {
        return $this->getConditionEvent()->getLead()->getId();
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getCampaignId()
    {
        return $this->getConditionEvent()->getLogEntry()->getCampaign()->getId();
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getEventId()
    {
        return $this->getConditionEvent()->getEvent()['id'];
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getRotation()
    {
        return $this->getConditionEvent()->getLogEntry()->getRotation();
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return MAUTIC_TABLE_PREFIX;
    }

}
