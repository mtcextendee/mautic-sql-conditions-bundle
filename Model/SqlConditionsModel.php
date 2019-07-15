<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\Model;

use Mautic\CoreBundle\Model\AjaxLookupModelInterface;
use Mautic\CoreBundle\Model\FormModel;
use MauticPlugin\MauticRecommenderBundle\Entity\RecommenderTemplateRepository;
use MauticPlugin\MauticSqlConditionsBundle\Entity\SqlConditions;
use MauticPlugin\MauticSqlConditionsBundle\Entity\SqlConditionsRepository;
use MauticPlugin\MauticSqlConditionsBundle\Event\SqlConditionsEvent;
use MauticPlugin\MauticSqlConditionsBundle\Form\Type\SqlConditionsType;
use MauticPlugin\MauticSqlConditionsBundle\SqlConditionsEvents;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class SqlConditionsModel extends FormModel implements AjaxLookupModelInterface
{

    /**
     * Retrieve the permissions base.
     *
     * @return string
     */
    public function getPermissionBase()
    {
        return 'sqlConditions:sqlConditions';
    }

    /**
     * {@inheritdoc}
     *
     * @return SqlConditionsRepository
     */
    public function getRepository()
    {
        /** @var RecommenderTemplateRepository $repo */
        $repo = $this->em->getRepository('MauticSqlConditionsBundle:SqlConditions');

        $repo->setTranslator($this->translator);

        return $repo;
    }

    /**
     * Here just so PHPStorm calms down about type hinting.
     *
     * @param null $id
     *
     * @return null|SqlConditions
     */
    public function getEntity($id = null)
    {
        if ($id === null) {
            return new SqlConditions();
        }

        return parent::getEntity($id);
    }

    /**
     * {@inheritdoc}
     *
     * @param       $entity
     * @param       $formFactory
     * @param null  $action
     * @param array $options
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function createForm($entity, $formFactory, $action = null, $options = [])
    {
        if (!$entity instanceof SqlConditions) {
            throw new \InvalidArgumentException('Entity must be of class Event');
        }

        if (!empty($action)) {
            $options['action'] = $action;
        }

        return $formFactory->create(SqlConditionsType::class, $entity, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param $action
     * @param $entity
     * @param $isNew
     * @param $event
     *
     * @throws \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     */
    protected function dispatchEvent($action, &$entity, $isNew = false, \Symfony\Component\EventDispatcher\Event $event = null)
    {
        if (!$entity instanceof SqlConditions) {
            throw new MethodNotAllowedHttpException(['SqlConditions']);
        }

        switch ($action) {
            case 'pre_save':
                $name = SqlConditionsEvents::PRE_SAVE;
                break;
            case 'post_save':
                $name = SqlConditionsEvents::POST_SAVE;
                break;
            case 'pre_delete':
                $name = SqlConditionsEvents::PRE_DELETE;
                break;
            case 'post_delete':
                $name = SqlConditionsEvents::POST_DELETE;
                break;
            default:
                return null;
        }

        if ($this->dispatcher->hasListeners($name)) {
            if (empty($event)) {
                $event = new SqlConditionsEvent($entity, $isNew);
                $event->setEntityManager($this->em);
            }

            $this->dispatcher->dispatch($name, $event);

            return $event;
        } else {
            return null;
        }
    }

    /**
     * @param        $type
     * @param string $filter
     * @param int    $limit
     * @param int    $start
     * @param array  $options
     *
     * @return array|mixed
     */
    public function getLookupResults($type, $filter = '', $limit = 10, $start = 0, $options = [])
    {
        $results = [];
        switch ($type) {
            case 'sqlConditions':
                $entities = $this->getRepository()->getSimpleList();

                foreach ($entities as $entity) {
                    $results[$entity['value']] = $entity['label'];
                }

                //sort by language
                ksort($results);

                break;
        }

        return $results;
    }

}
