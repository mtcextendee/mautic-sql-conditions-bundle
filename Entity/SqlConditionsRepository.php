<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\Entity;

use Mautic\CoreBundle\Entity\CommonRepository;

/**
 * Class SqlConditionsRepository
 * @package MauticPlugin\MauticSqlConditionsBundle\Entity
 */
class SqlConditionsRepository extends CommonRepository
{
    /**
     * @param $alias
     *
     * @return object|null
     */
    public function findOneByAlias($alias)
    {
        return parent::findOneBy(['alias'=>$alias], null);
    }

    /**
     * Get a list of entities.
     *
     * @param array $args
     *
     * @return Paginator
     */
    public function getEntities(array $args = [])
    {
        $alias = $this->getTableAlias();

        $q = $this->_em
            ->createQueryBuilder()
            ->select($alias)
            ->from('MauticSqlConditionsBundle:SqlConditions', $alias, $alias.'.id');

        if (empty($args['iterator_mode'])) {
            $q->leftJoin($alias.'.category', 'c');
        }

        $args['qb'] = $q;

        return parent::getEntities($args);
    }

}
