<?php

namespace Drupal\payment_button_drupal_plugin\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Database\Database;
use Razorpay\Api\Api;
use Razorpay\Api\Errors;
use Exception;

class Payment extends ControllerBase
{
    private $key;

    private $secret;
 
    public function get_razorpay_api_instance(){

            $user = \Drupal::currentUser()->id();
            $query = \Drupal::database();
            $result = $query->select('user_auth','user')
                    ->fields('user', ['user_id','key_id','key_secret'])
                    ->condition('user.user_id', 1)
                    ->execute()->fetchAll(\PDO::FETCH_OBJ);
            foreach($result as $row){
                        $this->key = $row->key_id;
                        $this->secret = $row->key_secret;
                      
                        
            }
             /**
             * Initialize razorpay api instance
            **/

            if(empty($this->key) === false && empty($this->secret) === false)
            {
                return new Api($this->key, $this->secret);
            }else{

                return  \Drupal::messenger()->addMessage(t('RAZORPAY ERROR: Payment button fetch failed , Please add Razorpay keys from Payment button setting page.'), 'error');
            } 
    } 
    /** Get payment button function from Api */
    public function get_buttons(){

            $buttons = array();

        
            try
            {
                $api = $this->get_razorpay_api_instance();
                $items = $api->paymentPage->all(['view_type' => 'button', "status" => 'active']);
            }
            catch (Exception $e)
            {
                $message = $e->getMessage();

                \Drupal::messenger()->addMessage(t('RAZORPAY ERROR: Payment button fetch failed: '. $message), 'error');
                
              
            }

            if ($items) 
            {
                foreach ($items['items'] as $item) 
                {
                    $buttons[] = array(
                        'id' => $item['id'],
                        'title' => $item['title'],
                        'status' =>$item['status'],
                        'quantity_sold'=> $item['payment_page_items'][0]['quantity_sold'],
                        'created_at' => date("d F Y H:i A", $item['created_at'])
                    );
                }
            }
         
            return $buttons;
        }
      
   /**  payment button json passing to plugin.js from Api */
    public function content(){
        
        $response = new Response(json_encode(
             $this->get_buttons()
        )
        );
        return $response;
   

       
    }
    /**  payment button action function to activate and deactivate button */
    public function btn_action(){
       
        $btn_id = \Drupal:: routeMatch()->getParameter('id');
        $btn_status = \Drupal:: routeMatch()->getParameter('status'); 
        
        
        
        try
            {
                $api = $this->get_razorpay_api_instance();
                if($btn_status == 'inactive'){
                   $action = 'activate';
                   $message =  \Drupal::messenger()->addMessage(t('Payment button activated successfully!'), 'status');
                }else{
                    $action = 'deactivate';
                    $message =  \Drupal::messenger()->addMessage(t('Payment button deactivated successfully!'), 'status');
                }
                $api->paymentPage->$action($btn_id);
            }
            catch (Exception $e)
            {
                $message = $e->getMessage();
                \Drupal::messenger()->addMessage(t('RAZORPAY ERROR: Payment button fetch failed: '. $message), 'error');  
            }
        
        $response = new RedirectResponse('../../button_view_page/'.$btn_id);
        $response->send();
        $message;

    }
    /**  payment button view page  */
    public function button_page()
    {
        \Drupal::service('page_cache_kill_switch')->trigger();
        $btn_id = \Drupal:: routeMatch()->getParameter('id');
        

            try
            {
                $api = $this->get_razorpay_api_instance();
                if($api->paymentPage == null)
                {
                   
                    return array(
                        '#theme' => 'payment_button',
                    );
                
                }
                $items = $api->paymentPage->all(['view_type' => 'button']);
            }
            catch (Exception $e)
            {
                $message = $e->getMessage();

                \Drupal::messenger()->addMessage(t('RAZORPAY ERROR: Payment button fetch failed:'.$message), 'error');
                
              
            }

            if ($items) 
            {
                
                    foreach ($items['items'] as $item) 
                    {  
                        
                        if($item['status'] == 'inactive'){
                            $btn_action = 'Activate';
                        }else{
                            $btn_action = 'Deactivate';
                        }
                       
                        if($item['id'] ==  $btn_id){
                            $buttons[] = array(
                                'id' => $item['id'],
                                'title' => $item['title'],
                                'status' =>$item['status'],
                                'quantity_sold'=> $item['payment_page_items'][0]['quantity_sold'],
                                'created_at' =>  date("d F Y", $item['created_at']),
                                'btn_act' => $btn_action,
                                'total_revenue'   => (int) round($item['total_amount_paid'] / 100),
                                'price' => (int) round(($item['payment_page_items'][0]['item']['amount'])/100),
                                'name' => $item['payment_page_items'][0]['item']['name']
                            );
                        }
                       
                    }
                    
            }
            
       return array(
           '#theme' => 'payment_button',
           '#items' => $buttons,
           '#title' => $buttons['title']
       );
    }
    /**  Razorpay payment buttons list page  */
    public function razorpay_buttons_page(){

        \Drupal::service('page_cache_kill_switch')->trigger();
        
            try
            {
                
                $api = $this->get_razorpay_api_instance();
                
                if($api->paymentPage == null)
                {
                   
                    return[
                        $build,
                        '#title' => 'Razorpay Buttons'
                    ];
                    
                
                }

                $items = $api->paymentPage->all(['view_type' => 'button']);
                
                
            }
            catch (Exception $e)
            {
                $message = $e->getMessage();
               
                \Drupal::messenger()->addMessage(t('RAZORPAY ERROR: Payment button fetch failed: '.$message), 'error');
             
              
            }

            if ($items) 
            {
                foreach ($items['items'] as $item) 
                {
                    $buttons[] = array(
                        'id' => $item['id'],
                        'title' => $item['title'],
                        'status' =>$item['status'],
                        'quantity_sold'=> $item['payment_page_items'][0]['quantity_sold'],
                        'created_at' => date("d F Y H:i A", $item['created_at'])
                    );
                }
            }
         
        if($buttons){
            foreach ($buttons as $item) 
                {
                    if($item['status'] == 'inactive'){
                        $status = 'Activate';
                    }else{
                        $status = 'Deactivate';
                    }
                    $button[] = array(
                        'title' => $item['title'],
                        'quantity_sold'=> $item['quantity_sold'],
                        'created_at' => $item['created_at'],
                        'status' => t( "<div style='width: 50px;
                        font-size: 12px;
                        border-radius: 20px;
                        background-color: #5bc0de;
                        font-weight: 500;
                        line-height: 1;
                        text-align: center;
                        padding: 5px 1.5em;
                        color: #fff;
                        text-transform: capitalize;' > <b>".$item['status']."</b> </div> "),
                        'action' =>t("<a href = 'button_view_page/".$item['id']."'> View</a>")
                    );
                }
        }

        $header = array('Title', 'Total Sales', 'Created At', 'Button Status', 'Action');
        $build['table'] = [
            '#type' => 'table',
            '#header' => $header,
            '#rows' =>  $button
        ];
        
        return[
            $build,
            '#title' => 'Razorpay Buttons'
        ];
        
    }
}

?>