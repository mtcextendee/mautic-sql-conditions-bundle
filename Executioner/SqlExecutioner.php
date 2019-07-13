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

class SqlExecutioner
{
    /**
     * @var SqlConditionDetails
     */
    private $sqlConditionDetails;

    /**
     * SqlExecutioner constructor.
     *
     * @param SqlConditionDetails $sqlConditionDetails
     */
    public function __construct(SqlConditionDetails $sqlConditionDetails)
    {
        $this->sqlConditionDetails = $sqlConditionDetails;
    }

    public function runQuery()
    {

    }

}
