<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" type="image/vnd.microsoft.icon"/>
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" type="image/x-ico"/>

	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php wp_head(); ?>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-34602741-2', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body <?php body_class(); ?>>

<!-- #header-area -->
<div id="header-area">	
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div id="logo">
					<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
						<?php  
							function twentysixteen_the_custom_logo() {
							   if ( function_exists( 'the_custom_logo' ) ) {
							     the_custom_logo();
							   }
							}
						?>
						<?php 
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$image = wp_get_attachment_image_src( $custom_logo_id , 'small' );
						?>						
						<img alt="Spiffi" id="slide-img-1" src="<?php echo $image[0]?>" class="slide" alt="" />
					</a>
				</div>  
			</div>

			<div class="col-sm-9">
				<?php
				if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' ) ){
					wp_nav_menu(
						array(
							'sort_column' => 'menu_order',
							'container_class' => 'menu-container clearfix',
							'container_id' => 'primary-menu',
							'menu_class' => 'menu clearfix',
							'theme_location'  => 'primary'
						)
					);
				} else {
				?>
				<div id="primary-menu" class="menu-container clearfix">								
					<ul id="menu-main-navigation" class="menu clearfix">
						<?php wp_list_pages('title_li=&depth=0'); ?>
					</ul>
				</div>
				<?php } ?> 
			</div>
		</div>
	</div>
</div><!-- /#header-area -->
<div class="blanket">
  <div id="subscribe_popup" class="clearfix"><?php echo do_shortcode('[contact-form-7 id="51" title="Contact Us"]'); ?></div>
</div> 
<script>
	jQuery(document).ready(function(){
		jQuery( "#menu-primary-menu li#menu-item-147, .sign-up-right, #askus" ).click(function() {
		    jQuery('.blanket').fadeOut(slow);
		});
		
		jQuery(document.body).on("click","#subscribe_popup #close",function(){
	        jQuery('.blanket').fadeOut();
		});

		jQuery(document.body).on("click","#menu-primary-menu li#menu-item-147, .sign-up-right, #askus",function(){
            jQuery('#subscribe_popup').attr('class','');
            jQuery('#subscribe_popup').show();
            jQuery('#subscribe_popup').addClass('bounceInDown animated');
            jQuery('.blanket').fadeIn();
        
	});

});
</script>