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

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;
use Mautic\ApiBundle\Serializer\Driver\ApiMetadataDriver;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Entity\FormEntity;

/**
 * Class SqlConditions
 *
 * @package MauticPlugin\MauticSqlConditionsBundle\Entity
 */
class SqlConditions extends FormEntity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $dateAdded;

    /**
     * @var string
     */
    protected $name;

    /*
     * @vart string
     */
    protected $sqlQuery;


    public function __construct()
    {
        $this->setDateAdded(new \DateTime());
    }

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata(ORM\ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);
        $builder->setTable('sql_conditions')
            ->setCustomRepositoryClass(SqlConditionsRepository::class);
        $builder->addIdColumns('name', '');
        $builder->addNamedField('sqlQuery', Type::TEXT, 'sql_query');
    }


    /**
     * Prepares the metadata for API usage.
     *
     * @param $metadata
     */
    public static function loadApiMetadata(ApiMetadataDriver $metadata)
    {
        $metadata->setGroupPrefix('sqlConditions')
            ->addListProperties(
                [
                    'id',
                    'name',
                    'sqlQuery',
                    'dateAdded',
                ]
            )
            ->build();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * Set dateAdded.
     *
     * @param \DateTime $dateAdded
     *
     * @return LeadEventLog
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded.
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }


    public function getCreatedBy()
    {

    }

    public function getHeader()
    {

    }

    public function getPublishStatus()
    {

    }

    /**
     * @param string $name
     *
     * @return SqlConditions
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
}

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $sqlQuery
     *
     * @return SqlConditions
     */
    public function setSqlQuery($sqlQuery)
    {
        $this->sqlQuery = $sqlQuery;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSqlQuery()
    {
        return $this->sqlQuery;
    }

}
