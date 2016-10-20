<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define('CHARGEBEE_BASE', __DIR__.DIRECTORY_SEPARATOR.'chargebee-php-master'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR);
define('DEVKEY', 'test_ZkVQAiR0kv93qwaowWWLmdHbPcux0spod');
define('PRODKEY', $value);
require_once CHARGEBEE_BASE.'ChargeBee.php';
ChargeBee_Environment::configure("getspiffi-test", DEVKEY);

$all = ChargeBee_Plan::all(array(
  "limit" => 5, 
  //"trialPeriod[lte]" => 14, 
  //"trialPeriodUnit[is]" => "day", 
  "status[is]" => "active"));

echo '<pre>';
print_r($all);
echo '</pre>';
die;

foreach($all as $entry){
  $plan = $entry->plan();
   
}