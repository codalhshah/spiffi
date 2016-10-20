<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if(empty($_POST)){
    die('invalid request.');
}
define('CHARGEBEE_BASE', __DIR__.DIRECTORY_SEPARATOR.'chargebee-php-master'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR);
define('ENVIRONMENT', 'DEVELOPMENT');
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
echo '<pre>';
print_r($configuration);
echo '</pre>';die;

try {
    $result = ChargeBee_Subscription::create($configuration);
    $subscription = $result->subscription(); 
    //$customer = $result->customer();
    //$card = $result->card();
    //$invoice = $result->invoice();
    
    if($subscription->id){
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
