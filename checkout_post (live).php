<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'PHPMailer-master/PHPMailerAutoload.php';
if(empty($_POST)){
    die('invalid request.');
}
define('CHARGEBEE_BASE', __DIR__.DIRECTORY_SEPARATOR.'chargebee-php-master'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR);
define('ENVIRONMENT', 'PRODUCTION');
if(ENVIRONMENT == 'DEVELOPMENT'){
    define('KEY', 'test_ZkVQAiR0kv93qwaowWWLmdHbPcux0spod');
    define('SITE', 'getspiffi-test');
}else{
    define('KEY', 'live_B2kS2xmFuwUii0dFWrbwKwL7WicdBccuVu');
    define('SITE', 'getspiffi');
}
session_start();
/*gather all post data*/
$email = (isset($_POST['email']) && $_POST['email']!='')?$_POST['email']:'';
$first_name = (isset($_POST['first_name']) && $_POST['first_name']!='')?$_POST['first_name']:'';
$last_name = (isset($_POST['last_name']) && $_POST['last_name']!='')?$_POST['last_name']:'';
$phone = (isset($_POST['phone']) && $_POST['phone']!='')?$_POST['phone']:'';
$line1 = (isset($_POST['address_1']) && $_POST['address_1']!='')?$_POST['address_1']:'';
$city = (isset($_POST['city']) && $_POST['city']!='')?$_POST['city']:'';
$state = (isset($_POST['state']) && $_POST['state']!='')?$_POST['state']:'';
$zip = (isset($_POST['zip']) && $_POST['zip']!='')?$_POST['zip']:'';
$country = (isset($_POST['country']) && $_POST['country']!='')?$_POST['country']:'';
$cardNumber = (isset($_POST['cardNumber']) && $_POST['cardNumber']!='')?str_replace(' ', '', $_POST['cardNumber']):'';
list($cardMonth, $cardYear) = explode('/', $_POST['cardExpiry']);
$cardCVC = $_POST['cardCVC'];

require_once CHARGEBEE_BASE.'ChargeBee.php';
ChargeBee_Environment::configure(SITE, KEY);
$configuration = array(
  "planId" => $_SESSION['planId'], 
  "sartDate"=>(isset($_SESSION['start_date']) && $_SESSION['start_date']!='')?strtotime($_SESSION['start_date']):time(),
  "metaData"=> json_encode(array('customer_notes'=>$_SESSION['notes'])),
  "customer" => array(
    "email" => $email, 
    "firstName" => $first_name, 
    "lastName" => $last_name, 
    "phone" => $phone
  ), 
  "billingAddress" => array(
    "firstName" => $first_name, 
    "lastName" => $last_name, 
    "line1" => $line1, 
    "city" => $city, 
    "state" => $state, 
    "zip" => $zip, 
    "country" => $country
  ), 
  "card"=>array(
      'firstName'=>$first_name,
      'lastName'=>$last_name,
      'number'=>$cardNumber,
      'expiryMonth'=>$cardMonth,
      'expiryYear'=>$cardYear,
      'cvv'=>$cardCVC,
      'billingAddr1'=>$line1,
      'billingCity'=>$city,
//      'billingStateCode'=>'',
//      'billingState'=>'',
//      'billingZip'=>'',
      'billingCountry'=>$country,
      
  ),
    'paymentmethod'=>array(
        'type'=>'card'
    ),
//  "addons" => array(array(
//    "id" => "dresses", 
//    "quantity" => 2
//  ))
 );

if(!empty($_SESSION['addons_checkout'])){
    $configuration['addons'] = $_SESSION['addons_checkout'];
}

try {
    $result = ChargeBee_Subscription::create($configuration);
    $subscription = $result->subscription(); 
    //$customer = $result->customer();
    //$card = $result->card();
    //$invoice = $result->invoice();
    
    if($subscription->id){

      $subscription_id = $subscription->id;
      $html = "<h3>You have got new order.</h3>
        <span style='text-decoration: underline;'><strong>Details are as below:</strong></span>
        <br><br>
        <p>Order Place Time: ".date('m/d/Y H:i')."</p>
        <p>Subscription ID: <strong>".$subscription_id."</strong></p>
        <p>Email: <strong>".$email."</strong></p>
        <p>First name: <strong>".$first_name."</strong></p>
        <p>Last Name: <strong>".$last_name."</strong></p>
        <p>Phone: <strong>".$phone."</strong></p>
        <p>Plan ID: <strong>".$_SESSION['planId']."</strong></p>
        <p>Start Date: <strong>".date('m/d/Y',$configuration['sartDate'])."</strong></p>
        <p>Plan Amount: $<strong>".$_SESSION['amount']."</strong></p>
        <p>Addons:</p> 
        <table>".$_SESSION['addons_html']."</table>
        ";

      $html_customer = "<h3>Congratulations! Your order placed successfully.</h3>
        <span style='text-decoration: underline;'><strong>Details are as below:</strong></span>
        <br><br>
        <p>Plan ID: <strong>".$_SESSION['planId']."</strong></p>
        <p>Start Date: <strong>".date('m/d/Y',$configuration['sartDate'])."</strong></p>
        <p>Plan Amount: $<strong>".$_SESSION['amount']."</strong></p>
        <p>Addons:</p> 
        <table>".$_SESSION['addons_html']."</table>
        ";
          
          $mail = new PHPMailer;
          $mail->setFrom('info@spiffi.biz', 'Spiffi');
          $mail->addAddress('mkothari@ecodirectcleaners.com', 'M Kothari');     // Add a recipient
          $mail->addAddress('info@spiffi.biz');
          $mail->isHTML(true); // Set email format to HTML
          $mail->Subject = 'New order Spiffi';
          $mail->Body    = $html;
          $mail->AltBody = $html;
          if(!$mail->send()) {

           
            echo 'Message could not be sent.<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
              
          } else {
            $mail_c = new PHPMailer;
            $mail_c->setFrom('info@spiffi.biz', 'Spiffi');
            $mail_c->addAddress($email);
            $mail_c->isHTML(true); // Set email format to HTML
            $mail_c->Subject = 'Spiffi Order Summary';
            $mail_c->Body    = $html_customer;
            $mail_c->AltBody = $html_customer;
            $mail_c->send();
              echo 'Message has been sent';
          }
                
           header("Location: /thanks");
          exit;
    }
} catch (Exception $exc) {
    $_SESSION['error_msg'] = $exc->getMessage();
    header("Location: /spiffi/error");
    exit;
//    echo $exc->getMessage();
//    echo '<br>----------';
//    echo $exc->getTraceAsString();
} finally {

}
?>