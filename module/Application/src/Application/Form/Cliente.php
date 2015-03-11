<?php
namespace Application\Form;

use Zend\Form\Form;
use Application\Entity\Cliente as ClienteEntity;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\InputFilter\InputFilter;

class Cliente extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $objectManager = $options['om'];
        $this->setObject(new ClienteEntity())
            ->setHydrator(new DoctrineObject($objectManager))
            ->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ))
            ->add(array(
            'name' => 'nome',
            'options' => array(
                'label' => 'Nome'
            ),
            'attributes' => array(
                'class' => 'form-control input-sm'
            )
        ))
            ->add(array(
            'name' => 'plano',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Plano',
                'object_manager' => $objectManager,
                'target_class' => 'Application\Entity\Plano',
                'property' => 'nome'
            ),
            'attributes' => array(
                'class' => 'form-control input-sm'
            )
        ));
            
            $filter = new InputFilter();
            $filter->add(array(
                'name' => 'nome',
                'required' => true
            ));
            $this->setInputFilter($filter);
    }
}