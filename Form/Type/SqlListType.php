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

use Mautic\CoreBundle\Form\Type\EntityLookupType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class  SqlListType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'modal_route'         => 'mautic_sqlConditions_action',
                'modal_header'        => 'mautic.core.new',
                'model'               => 'sqlConditions',
                'model_lookup_method' => 'getLookupResults',
                'lookup_arguments'    => function (Options $options) {
                    return [
                        'type'    => 'sqlConditions',
                        'filter'  => '$data',
                        'limit'   => 0,
                        'start'   => 0,
                        'options' => [
                            'sqlConditions_type' => $options['sqlConditions_type'],
                        ],
                    ];
                },
                'ajax_lookup_action' => function (Options $options) {
                    $query = [
                        'sqlConditions_type' => $options['sqlConditions_type'],
                    ];

                    return 'sqlConditions:getLookupChoiceList&'.http_build_query($query);
                },
                'multiple' => true,
                'required' => false,
                'sqlConditions_type' => 'template',
            ]
        );
    }
    /**
     * @return string
     */
    public function getParent()
    {
        return EntityLookupType::class;
    }
}
