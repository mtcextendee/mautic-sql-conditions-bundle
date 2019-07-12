<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticSqlConditionsBundle\Form\Type;

use MauticPlugin\MauticSqlConditionsBundle\Validator\Constraint\UrlDnsConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class SqlConditionsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add(
            'name',
            'text',
            [
                'label'       => 'mautic.core.name',
                'label_attr'  => ['class' => 'control-label'],
                'attr'        => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(),
                ],
            ]
        );

        $builder->add(
            'sqlQuery',
            TextareaType::class,
            [
                'label'       => 'mautic.sqlConditions.sql',
                'label_attr'  => ['class' => 'control-label'],
                'attr'        => [
                    'class' => 'form-control',
                    'rows' => 5,
                ],
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ]
        );

        $builder->add('isPublished', 'yesno_button_group');

        $builder->add(
            'buttons',
            'form_buttons',
            [
                'save_text'=>'mautic.core.permissions.create',
                'save_icon'=>'fa fa-plus'
            ]
        );

    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'sqlConditions';
    }
}