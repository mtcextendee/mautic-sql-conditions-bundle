<?php


/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;

/**
 * Class SqlConditionsIntegration.
 */
class SqlConditionsIntegration extends AbstractIntegration
{

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'SqlConditions';
    }

    public function getIcon()
    {
        return 'plugins/MauticSqlConditionsBundle/Assets/img/icon.png';
    }

    public function getSecretKeys()
    {
        return ['password'];
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getRequiredKeyFields()
    {
        return [
        ];
    }

    /**
     * @return array
     */
    public function getFormSettings()
    {
        return [
            'requires_callback'      => false,
            'requires_authorization' => false,
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getAuthenticationType()
    {
        return 'none';
    }

    /**
     * @return bool
     */
    public function isEnabledIntegration()
    {
        if (strpos($this->pathsHelper->getSystemPath('local_config'), 'local.php') !== false) {
            return true;
        }

        return false;
    }

    /**
     * @return \Mautic\PluginBundle\Entity\Integration
     */
    public function getIntegrationSettings()
    {
        $integrationSettings = parent::getIntegrationSettings();
        if (!$this->isEnabledIntegration()) {
            $integrationSettings->setIsPublished(false);
        }

        return $integrationSettings;
    }

    /**
     * @param \Mautic\PluginBundle\Integration\Form|\Symfony\Component\Form\FormBuilder $builder
     * @param array                                                                     $data
     * @param string                                                                    $formArea
     */
    public function appendToForm(&$builder, $data, $formArea)
    {
        if ($formArea == 'features') {
        }
    }

}
