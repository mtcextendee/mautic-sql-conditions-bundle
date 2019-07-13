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

use MauticPlugin\MauticSqlConditionsBundle\Entity\SqlConditions;
use MauticPlugin\MauticSqlConditionsBundle\Model\SqlConditionsModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class  SqlListType extends AbstractType
{
    /**
     * @var SqlConditionsModel
     */
    private $sqlConditionsModel;

    /**
     * SqlListType constructor.
     *
     * @param SqlConditionsModel $sqlConditionsModel
     */
    public function __construct(SqlConditionsModel $sqlConditionsModel)
    {
        $this->sqlConditionsModel = $sqlConditionsModel;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => function (Options $options) {
                $entities  = $this->sqlConditionsModel->getRepository()->getEntities([
                    'filter'           => [
                        'force' => [
                            [
                                'column' => 'e.isPublished',
                                'expr'   => 'eq',
                                'value'  => true,
                            ],
                        ],
                    ],
                    'ignore_paginator' => true,
                ]);
                $choices = [];
                /** @var SqlConditions $entity */
                foreach ($entities as $entity) {
                    $choices[$entity->getId()] = $entity->getName();
                }
                return $choices;
            },
            'attr'        => [
                'class' => 'form-control',

            ],
            'label'       => '',
            'expanded'    => false,
            'multiple'    => false,
            'required'    => false,
            'empty_value' => '',
        ]);
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
