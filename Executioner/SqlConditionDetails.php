<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\Executioner;

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
        $sqlConditionId = $this->getConditionEvent()->getConfig()['sql'];
        $entity =  $this->sqlConditionsModel->getEntity($sqlConditionId);

        if ($entity && $entity->isPublished()) {
            return $entity->getSqlQuery();
        }

    }

}
