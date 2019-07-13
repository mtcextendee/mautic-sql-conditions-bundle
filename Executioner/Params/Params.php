<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\Executioner\Params;

use MauticPlugin\MauticSqlConditionsBundle\Executioner\SqlConditionDetails;

class Params
{
    /**
     * @var SqlConditionDetails
     */
    private $sqlConditionDetails;

    /**
     * @param SqlConditionDetails $sqlConditionDetails
     *
     * @return array
     * @throws \Exception
     */
    public function parseParamsFromSqlQuery(SqlConditionDetails $sqlConditionDetails)
    {
        $this->sqlConditionDetails = $sqlConditionDetails;
        $sqlQuery                  = $this->sqlConditionDetails->getSqlQuery();
        $params                    = [];

        foreach ($this->getAllParams() as $key => $value) {
            if (strpos($sqlQuery, $key) !== false) {
                $params[$key] = $value;
            }
        }

        return $params;

    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getAllParams()
    {

        $params                = [];
        $params[':contactId']  = $this->sqlConditionDetails->getConditionEvent()->getLead()->getId();
        $params[':campaignId'] = $this->sqlConditionDetails->getConditionEvent()->getLogEntry()->getCampaign()->getId();
        $params[':eventId']    = $this->sqlConditionDetails->getConditionEvent()->getEvent()['id'];
        $params[':rotation']   = $this->sqlConditionDetails->getConditionEvent()->getLogEntry()->getRotation();

        return $params;
    }
}
