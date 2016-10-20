<?php
/**
 * Template Name: Checkout Page
 *
 * @package WordPress
 * @subpackage Spiffi
 * @since Spiffi 1.0
 */
get_header();
require_once CHARGEBEE_BASE . 'ChargeBee.php';
ChargeBee_Environment::configure(SITE, KEY);
$total_addon_bath = 0;
$total_addon_beds = 0;
$additional_notes = $subscription_period = '';
/* for normal plan subscription only url fired */
/* for plan with addons we need to take input of addons and plan that we will get from hidden fields */
$plan_id = (isset($_GET['plan']) && is_numeric($_GET['plan'])) ? $_GET['plan'] : '';
        
if(!in_array($plan_id, range(1,4))){
  global $wp_query;
  $wp_query->set_404();
  status_header( 404 );
  get_template_part( 404 ); exit();
}
if (isset($_GET['hmbaths'])) {
    $total_addon_bath = $_GET['hmbaths'];
    $total_addon_beds = $_GET['hmbeds'];
    $subscription_period = $_GET['subscription_period'];
    $additional_notes = $_GET['notes'];
}


$amount = 0;
if (isset($plan_id) && $plan_id != '') {
    switch ($plan_id) {
        case '1':
            $product = 'Full Clean';
            $amount = 79;
            $id = 'full-clean';
            break;
        case '2':
            $product = 'Daily (M-F)';
            $amount = 125;
            $id = 'daily-(5-days)';
            break;
        case '3':
            $product = 'Mon, Wed, Fri (3X A WEEK)';
            $amount = 90;
            $id = 'daily-(MWF)';
            break;
        case '4':
            $product = 'Tues, Thurs (2X A WEEK)';
            $amount = 70;
            $id = 'daily-(trth)';
            break;
        default:
            break;
    }
    if (!session_id()) {
        session_start();
    }
    
    unset($_SESSION['addons_checkout']);
    unset($_SESSION['amount']);
    unset($_SESSION['planId']);
    unset($_SESSION['addons']);
    unset($_SESSION['start_date']);
    unset($_SESSION['notes']);
    $_SESSION['amount'] = $amount;
    $_SESSION['planId'] = $id;
    $_SESSION['addons'] = array(
        'total_addon_bath' => $total_addon_bath,
        'total_addon_beds' => $total_addon_beds,
        'subscription_period' => $subscription_period
    );
    $_SESSION['start_date'] = $_GET['start_date'];
    $_SESSION['notes'] = $additional_notes;
    
}

$addon_price = getAddonsdata($plan_id, $subscription_period, $total_addon_bath, $total_addon_beds);
$total_amount=$amount + $addon_price;   
/*
 * *  plan ids **
  Currently 4 plans available so we will fetch data accordingly
  additional-bath-(daily-deal)
  additional-bedFC
  additonal-bed-(daily-deal)
  additional-bathFC
 */

function getAddonsdata($plan_id, $subscription_period, $total_addon_bath, $total_addon_beds, $detail='') {
    //"chargeType[is]" => "recurring"
//    $config=  array(
//        "limit" => 100, 
//        //"type[is]" => "on_off", 
//        "status[is]" => "active"
//    );
//    
//    if($subscription_period == 'non_recurring'){
//        $config["chargeType[is]"] = "non_recurring";
//    }else{
//        $config["periodUnit[is]"] = $subscription_period;
//    }
//    
//    $all = ChargeBee_Addon::all($config);
//    foreach($all as $entry){
//        $addon = $entry->addon();
//    }
    switch ($plan_id) {
        case '1'://full-clean
            $addon_id_bed = 'additional-bedFC';
            $addon_id_bath = 'additional-bathFC';
            break;
        case '2'://daily-(5-days) Daily (M-F)
            $addon_id_bed = 'additonal-bed-(daily-deal)';
            $addon_id_bath = 'additional-bath-(daily-deal)';
            break;
        case '3'://daily-(MWF) Mon, Wed, Fri 3x a week
            $addon_id_bed = 'additonal-bed-(3x-week)'; //change ID when 3x a week is added in live site.
            $addon_id_bath = 'additional-bath-(3x-week)';
            break;
        case '4'://daily-(trth) name:Daily (T/TH) 2x a week
            $addon_id_bed = 'additonal-bed-(2x-week)';
            $addon_id_bath = 'additional-bath-(2x-week)';
            break;
        default:
            break;
    }
    
    
    try{
        /*calculation of bed price*/
        $result_bed = ChargeBee_Addon::retrieve($addon_id_bed);
        $price_bed = $result_bed->addon()->price/100;
        $addon_bed_price = $price_bed*$total_addon_beds;
    }catch(Exception $e){
        echo '<div class="alert alert-danger" style="margin:25px;">
                <strong>Oops! </strong>'.$e->getMessage().' '.$addon_id_bed.' Addon.
                <p>May be Addon you are looking for no longer exists.</p>
              </div>';
        die;
    }
    
    
    try{
        /*calculation of bath price*/
        $result_bath = ChargeBee_Addon::retrieve($addon_id_bath);
        $price_bath = $result_bath->addon()->price/100;
        $addon_bath_price = $price_bath*$total_addon_bath;
    }catch(Exception $e){
        echo '<div class="alert alert-danger" style="margin:25px;">
                <strong>Oops! </strong>'.$e->getMessage().' '.$addon_id_bath.' Addon.
                <p>May be Addon you are looking for no longer exists.</p>
              </div>';
        die;
    }
    
    
    
    
    /*saving session data for checkout page retrieval*/
    if (!session_id()) {
        session_start();
    }
    
    $final_addons = array();
    if($total_addon_bath!=0){
        $bath = array(
                "id" => $addon_id_bath, 
                "quantity" =>$total_addon_bath
        );
        array_push($final_addons, $bath);
    }
    if($total_addon_beds!=0){
        $beds = array(
                "id" => $addon_id_bed,     
                "quantity" =>$total_addon_beds
            );
        array_push($final_addons, $beds);
    }
    if(!empty($final_addons)){
        $_SESSION['addons_checkout'] = $final_addons;
    }
    
    $total_price = $addon_bed_price+ $addon_bath_price;
    if($detail == 'y'){
        return array(
            array(
                'name'=>'Extra beds',
                'price'=>$price_bed,
                'quantity'=>$total_addon_beds,
            ),
            array(
                'name'=>'Extra baths',
                'price'=>$price_bath,
                'quantity'=>$total_addon_bath,
            ),
        );
    }
//    return array(
//        'addon_bed_price'=>$addon_bed_price,
//        'addon_bath_price'=>$addon_bath_price,
//    );
    return $total_price;
}

function prepareAddonHtml($addons_data){
  
    $addons_html = '';
    if(!empty($addons_data)){
        foreach ($addons_data as $v) {
            $addons_html.='<tr>';
            $addons_html.='<td>'.$v['name'].' ('.$v["quantity"].' * $'.$v["price"].')</td>';
            $addons_html.='<td>$'.$v["quantity"]*$v["price"].'</td>';
            $addons_html.='</tr>';
        }
    }
    return $addons_html;
                                            
}
?>
<div id="content-area">	
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        ?>
                        <h1 class="page-title">
                            <?php the_title(); ?>
                        </h1>

                        <div class="articles-wrapper article-loop-post">
                            <div class="row article clearfix">
                                <?php
                                if (has_post_thumbnail()) {
                                    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                    echo '<div class="article-feature-img col-sm-12">';
                                    echo '<img src="' . $thumbnail[0] . '" alt="' . get_the_title() . '" title="' . get_the_title() . '">';
                                    echo '</div>';
                                }
                                ?>

                                <div class="article-content col-sm-12">
                                    <div class="article-excerpt">
                                        <form id="payment-form" action="<?php echo get_site_url() . DIRECTORY_SEPARATOR; ?>checkout_post.php" method="POST">
                                            <?php
                                            
                                                $addons_data = getAddonsdata($plan_id, $subscription_period, $total_addon_bath, $total_addon_beds, 'y');
                                                $addons_html = prepareAddonHtml($addons_data);
                                            
        
                                            $original_content = get_the_content();
                                            $finds = array('{{item_name}}', '{{item_price}}', '{{addons}}', '{{item_price_total}}');
                                            $replacement = array();
                                            $relace = array($product, $amount, $addons_html, $total_amount);
                                            $contemnt = str_replace($finds, $relace, $original_content);
                                            echo $contemnt;
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;

                else :
                    echo wpautop('Sorry, no posts were found.');
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>