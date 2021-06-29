<?php

namespace Umbrella\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Umbrella\AdminBundle\UmbrellaAdminConfiguration;
use Umbrella\CoreBundle\Form\PasswordTogglableType;

class UserPasswordConfirmType extends AbstractType
{
    private UmbrellaAdminConfiguration $config;

    /**
     * UserPasswordConfirmType constructor.
     */
    public function __construct(UmbrellaAdminConfiguration $config)
    {
        $this->config = $config;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('plainPassword', RepeatedType::class, [
            'type' => PasswordTogglableType::class,
            'translation_domain' => 'UmbrellaAdmin',
            'first_options' => [
                'label' => 'label.newpassword'
            ],
            'second_options' => [
                'label' => 'label.password_confirm'
            ],
            'required' => true,
            'invalid_message' => 'error.password_mismatch',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->config->userClass(),
        ]);
    }
}
