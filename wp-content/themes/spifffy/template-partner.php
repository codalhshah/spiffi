<?php get_header(); 
/*
Template name: Partner Template
*/
?>

<section id="referral-partner" class="referral-partner">
	<div class="container">
		<div class="section-header text-center">
			<h2>Spiffi Referral Partners</h2>
		</div>
	</div>
	<div class="container" id="partner-box-section">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-xl-6 text-center r-partner">
				<div class="partner-box">
					<h3><?php echo get_post_field('post_title', 200); ?></h3>
					<p><?php echo get_post_field('post_content', 200); ?></p>
				</div>
				<div class="partner-box">
					<h3><?php echo get_post_field('post_title', 202); ?></h3>
					<p><?php echo get_post_field('post_content', 202); ?></p>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-xl-6 r-partner">
				<?php //echo get_post_field('post_content', 224); ?>
				<?php echo do_shortcode('[contact-form-7 id="51" title="Contact Us"]'); ?>
			</div>
		</div>
	</div>
</section>

<section id="pget-started" class="pget-started">
	<div class="container">
		<div class="pget-started-section">
			<div class="pget-started-left">
				<p><span><?php echo get_post_field('post_title', 216); ?></span><?php echo get_post_field('post_content', 216); ?></p>	
			</div>			
			<div class="pget-started-right">
				<a class="sign-up-right" href="#">Sign Up right Now!</a>	
			</div>
		</div>
	</div>
</section>

<section id="partner-service" class="partner-service">
	<div class="container">
		<div class="section-header text-center">
			<h2>Properties We Service</h2>			
		</div>
	</div>
	<div class="container" id="service-box-section">
		<div class="row">
			<div class="col-sm-4 col-md-4 col-xl-4 service-box text-center">
				<?php echo get_the_post_thumbnail( 179, 'full' ); ?>
				<h4><?php echo get_post_field('post_title', 179); ?></h4>
				<p><?php echo get_post_field('post_content', 179); ?></p>				
			</div>
			<div class="col-sm-4 col-md-4 col-xl-4 service-box text-center">
				<?php echo get_the_post_thumbnail( 182, 'full' ); ?>
				<h4><?php echo get_post_field('post_title', 182); ?></h4>
				<p><?php echo get_post_field('post_content', 182); ?></p>
			</div>
			<div class="col-sm-4 col-md-4 col-xl-4 service-box signupnow text-center">
				<h2><?php echo get_post_field('post_title', 216); ?></h2>
				<p><?php echo get_post_field('post_content', 216); ?></p>
				<a class="sign-up-right" href="#">Sign Up right Now!</a>	
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>