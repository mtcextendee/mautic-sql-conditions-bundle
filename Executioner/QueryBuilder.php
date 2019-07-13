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

use Doctrine\DBAL\Connections\MasterSlaveConnection;
use Doctrine\ORM\EntityManager;
use MauticPlugin\MauticSqlConditionsBundle\Executioner\Params\Params;

class QueryBuilder
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    /**
     * @var Params
     */
    private $params;

    /**
     * SqlExecutioner constructor.
     *
     * @param EntityManager $entityManager
     * @param Params        $params
     */
    public function __construct(EntityManager $entityManager, Params $params)
    {
        $this->entityManager = $entityManager;
        $this->params = $params;

        /** @var Connection $connection */
        $this->connection = $this->entityManager->getConnection();
        if ($this->connection instanceof MasterSlaveConnection) {
            $this->connection->connect('slave');
        }
    }

    /**
     * @param SqlConditionDetails $sqlConditionDetails
     *
     * @return \Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public function runQuery(SqlConditionDetails $sqlConditionDetails)
    {
        $sqlQuery = $sqlConditionDetails->getSqlQuery();
        if (!$sqlQuery) {
            return false;
        }

        $params = $this->params->parseParamsFromSqlQuery($sqlConditionDetails);
        return $this->connection->executeQuery($sqlQuery, $params)->fetchAll();
    }


};
