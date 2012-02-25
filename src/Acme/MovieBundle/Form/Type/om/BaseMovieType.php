<?php // autogenerated on DATE by SurvosCrudBundle:Generator:BaseFormType.php.twig
# /usr/sites/sf/survos-standard/src/Acme/MovieBundle/Form/Type/om/BaseMovieType.php


namespace Acme\MovieBundle\Form\Type\om;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BaseMovieType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
                $builder->add('Id'); // INTEGER 
                $builder->add('Title'); // VARCHAR .255 
                $builder->add('IsPublished'); // BOOLEAN .1 
                $builder->add('ReleaseDate', 'text'); // DATE 
                $builder->add('ProducerId'); // INTEGER 
            }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Acme\MovieBundle\Model\Movie',
        );
    }

    public function getName()
    {
        return 'Movie'; // right name??
    }
}


