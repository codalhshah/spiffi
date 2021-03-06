<?php
/*
 * To carry out checkout process, redirect url should be configured at Chargebee settings page.
 */
try { 
 $cboptions = get_option("chargebee");
 if( is_user_logged_in() ) {
   $url = null;
   $user = wp_get_current_user();
   $cb_customer = apply_filters("cb_get_customer", $user->ID);
   $cb_subscription = apply_filters("cb_get_subscription", $user->ID);
   $checkout_existing = False;
   $checkout_new = False;
   if( $cb_customer != null && isset($cb_customer->cardStatus) ) {
      // Chargebee customer is present and found that no_card or expired_card then taking to checkout existing hosted page.
      if ($cb_customer->cardStatus == "no_card" || $cb_customer->cardStatus == "expired") {
         $checkout_existing = True;
      }
    } else {
      // if Chargebee object not found then taking customer to checkout new hosted page.
      $checkout_new = True;
   }
   if( $checkout_existing ) {
       $result = ChargeBee_HostedPage::checkoutExisting(array("subscription" => array( "id" => $user->ID, "planId" => $cb_plan_id ),
                                                              "customer" => array("email" => $user->user_email), "embed" => "false"));
       $url = $result->hostedPage()->url;
       redirect_to_url($url);
   } else {
       if( $checkout_new ) {
           // customer will be taken to Chargebee checkout new hosted page if no Chargebee customer details found in wp_usermeta.
           $result = ChargeBee_HostedPage::checkoutNew(array("subscription" => array("id" => $user->ID, "planId" => $cb_plan_id),
                                                             "customer" => array("email" => $user->user_email), "embed" => "false") );
           $url = $result->hostedPage()->url;
           redirect_to_url($url); 
       } else {
          // Chargebee Update Subscription call is called if card is valid in Chargebee customer object.
          $cb_subscription = apply_filters("cb_get_subscription",$user->ID);
          $result = ChargeBee_Subscription::update($cb_subscription->id, array("planId" => $cb_plan_id));
          do_action('cb_update_result', $result);
          $url = generate_page_link(get_permalink($cboptions['plan_page']), "chargebee_checkout_state=checkout_success");
          redirect_to_url($url); 
       }
   }
 } else {
   // if customer not logged in then redirecting him to login page.
   $login_url = wp_login_url();
   if( isset($cboptions["login_page"]) && !empty($cboptions["login_page"])) {
     $login_url = get_permalink($cboptions["login_page"]);
   }
   $referer = $_SERVER['HTTP_REFERER'];
   if(is_null($referer) || strpos($referer,get_site_url()) === false ){
	   $login_url .= "?redirect_to=" . get_site_url();
   } else {
	   $login_url .= "?redirect_to=" . $_SERVER['HTTP_REFERER'];
   }
   redirect_to_url($login_url);
 }
} catch(ChargeBee_APIError $e) {
  echo  "<div class='cb-flash'><span class='cb-text-failure'>Couldn't change your subscription. Please contact site owner.</span></div>";
} ?>
