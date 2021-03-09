<?php
/**
 * @file
 * Contains Drupal\alter\Form\AlterForm
 */

namespace Drupal\alter\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Cmponent\HttpFoundation\Request;
use Drupal\Core\Form\FormStateInterface;

class AlterForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    public function getformID(){
        return 'alter_form';
    }
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames(){
        return[
            'alter.config'
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL){
        $types = node_type_get_names();
        $config = $this->config('alter.config');
        //var_dump($config->getRawData());
        //die;

        $form['plan'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Plan'),
            '#default_value' => $config->get('plan'),
        ];
        $form['subscription'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Subscription'),
            '#default_value' => $config->get('subscription'),
        ];
        $form['price'] = [
            '#type' => 'number',
            '#title' => $this->t('Price'),
            '#default_value' => $config->get('price'),
        ];
        $form['email_id'] = [
            '#type' => 'email',
            '#title' => $this->t('Email ID'),
            '#default_value' => $config->get('email_id'),
        ];
        return parent::buildForm($form, $form_state);
    }
    /**
    * {@inheritdoc}
    */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $this->configFactory->getEditable('alter.config')
        ->set('plan', $form_state->getValue('plan'))
        ->set('subscription', $form_state->getValue('subscription'))
        ->set('price', $form_state->getValue('price'))
        ->set('email_id', $form_state->getValue('email_id'))
        ->save();
    }

}