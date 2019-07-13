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

class SqlExecutioner
{
    /**
     * @var SqlConditionDetails
     */
    private $sqlConditionDetails;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * SqlExecutioner constructor.
     *
     * @param SqlConditionDetails $sqlConditionDetails
     * @param QueryBuilder        $queryBuilder
     */
    public function __construct(SqlConditionDetails $sqlConditionDetails, QueryBuilder $queryBuilder)
    {
        $this->sqlConditionDetails = $sqlConditionDetails;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @param ConditionEvent $conditionEvent
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute(ConditionEvent $conditionEvent)
    {
        $this->sqlConditionDetails->setConditionEvent($conditionEvent);
        return $this->queryBuilder->runQuery($this->sqlConditionDetails);

    }

}
