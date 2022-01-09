<?php
declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\AtLeastOneOf;
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

final class EntryDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'initialSpeed',
                NumberType::class,
                [
                    'required' => true,
                    'constraints' => [
                        new PositiveOrZero(),
                    ],
                ]
            )
            ->add(
                'throwAngle',
                NumberType::class,
                [
                    'required' => true,
                    'constraints' => [
                        new PositiveOrZero(),
                    ],
                ]
            )
            ->add(
                'time',
                NumberType::class,
                [
                    'required' => true,
                    'constraints' => [
                        new AtLeastOneOf([new Blank(), new PositiveOrZero()]),
                    ],
                ]
            )
            ->add('submit', SubmitType::class)
        ;
    }
}
