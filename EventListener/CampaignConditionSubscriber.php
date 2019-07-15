<?php

/*
 * @copyright   2016 Mautic Contributors. All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\EventListener;

use Mautic\CampaignBundle\CampaignEvents;
use Mautic\CampaignBundle\Event\CampaignBuilderEvent;
use Mautic\CampaignBundle\Event\ConditionEvent;
use MauticPlugin\MauticSqlConditionsBundle\Executioner\SqlExecutioner;
use MauticPlugin\MauticSqlConditionsBundle\SqlConditionsEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class CampaignConditionSubscriber.
 */
class CampaignConditionSubscriber implements EventSubscriberInterface
{

    /**
     * @var SqlExecutioner
     */
    private $sqlExecutioner;

    /**
     * CampaignConditionSubscriber constructor.
     *
     * @param SqlExecutioner $sqlExecutioner
     */
    public function __construct(SqlExecutioner $sqlExecutioner)
    {
        $this->sqlExecutioner = $sqlExecutioner;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            CampaignEvents::CAMPAIGN_ON_BUILD                  => ['onCampaignBuild', 0],
            SqlConditionsEvents::ON_CAMPAIGN_CONDITION_TRIGGER => ['onCampaignTriggerCondition', 0],
        ];
    }

    /**
     * @param CampaignBuilderEvent $event
     */
    public function onCampaignBuild(CampaignBuilderEvent $event)
    {
        $event->addCondition(
            'sql.condition',
            [
                'label'           => 'mautic.sqlConditions',
                'eventName'       => SqlConditionsEvents::ON_CAMPAIGN_CONDITION_TRIGGER,
                'formType'        => 'sqlconditions_list',
                'formTheme'       => 'MauticSqlConditionsBundle:FormTheme\SqlConditionsList',
                'formTypeOptions' => ['update_select' => 'campaignevent_properties_sql'],

            ]
        );
    }

    /**
     * @param ConditionEvent $event
     */
    public function onCampaignTriggerCondition(ConditionEvent $event)
    {
        if ($this->sqlExecutioner->execute($event)) {
            $event->pass();
        } else {
            $event->fail();
        }
    }
}
