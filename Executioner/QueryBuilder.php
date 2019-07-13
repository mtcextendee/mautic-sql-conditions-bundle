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

use Doctrine\DBAL\Connections\MasterSlaveConnection;
use Doctrine\ORM\EntityManager;

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
     * SqlExecutioner constructor.
     *
     * @param SqlConditionDetails $sqlConditionDetails
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        /** @var Connection $connection */
        $this->connection = $this->entityManager->getConnection();
        if ($this->connection instanceof MasterSlaveConnection) {
            $this->connection->connect('slave');
        }
    }

    public function getQuery()
    {
        //getdetail
        // getParams
        $this->connection->executeQuery($query, $params);
        $queryBuilder = new QueryBuilder($this->connection);
    }


}
