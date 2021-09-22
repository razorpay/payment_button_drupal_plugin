<?php

namespace Drupal\payment_button_drupal_plugin\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Database\Database;

/**
 * Provide settings for Payment Button plugin.
 */
class Settings extends FormBase {

  /**
   * {@inheritdoc}
   */
  
  public function getFormId() {
    return 'payment_plugin_setting_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $user = \Drupal::currentUser()->id();
    $query = \Drupal::database();
    $result = $query->select('user_auth','user')
                    ->fields('user', ['user_id','key_id','key_secret'])
                    ->condition('user.user_id', $user)
                    ->execute()->fetchAll(\PDO::FETCH_OBJ);
    

    foreach($result as $row){
      $userid  = $row->user_id;
      $userkey  = $row->key_id;
      $userkey_secret  = $row->key_secret;
    
      
    }

    $form['key_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter the Key Id'),
      '#default_value' => $userkey,
    ];
    $form['key_secret'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Enter the key_secret'),
        '#default_value' => $userkey_secret,
      );
      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => $this
          ->t('Save Changes'),
      );
    return $form;
  }
 /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $user = \Drupal::currentUser()->id();
    $values['user_id']=$user;
    unset($values['form_build_id'],$values['form_token'],$values['form_id'],$values['submit'],$values['op']);
    
    $query = \Drupal::database();
    $result = $query->select('user_auth','user')
                    ->fields('user', ['user_id',])
                    ->condition('user.user_id', $user)
                    ->execute()->fetchAll(\PDO::FETCH_OBJ);
    $data = '';

    foreach($result as $row){
      $data = $row->user_id;
    
      
    }
   
    if($data == $user && $data !=null){
      
          \Drupal::database()->update('user_auth')
            ->fields(array('key_id' => $values['key_id'], 'key_secret' => $values['key_secret']))
            ->condition('user_id', $user)
            ->execute();
          \Drupal::messenger()->addMessage(t('Payment buttton settings are updated successfully'), 'status');
    }else{

          $query->insert('user_auth')->fields($values)->execute();
          
          \Drupal::messenger()->addMessage(t('Payment buttton settings are saved successfully!'), 'status');
    }
    
  }


}
