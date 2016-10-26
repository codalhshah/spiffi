<?php get_header(); ?>
<!-- Slider Area -->
<section id="slider" class="slider">
    <div class="container">
        <div id="inner_slider">
            <h1 class="slider-title"><?php echo get_post_field('post_excerpt', 50); ?></h1>
        </div>
    </div>
    <div id="wearestiffy-title">
        <div class="container wearestiffy-title">			
            <h2><?php echo get_post_field('post_title', 69); ?></h2>
        </div>
    </div>
</section>
<!-- #Slider Area -->

<!-- We Are stiffy Area -->
<section id="wearestiffy" class="wearestiffy">	
    <div class="container">
        <div class="wearestiffy_desc text-center">
            <p><?php echo get_post_field('post_content', 69); ?></p>	
        </div>
    </div>
</section>
<!-- We Are stiffy Area -->

<!-- Cleaning Section Area -->
<section id="Cleaning" class="cleaning">
    <div class="container">
        <div class="row">
            <div class="cleaning-inner text-center">
                <?php
                query_posts(array('post_type' => 'Cleaning', 'posts_per_page' => 2, 'order' => 'DESC'));
                while (have_posts()) : the_post();
                    ?>
                    <div class="col-md-6 text-center cleaning-box">
                        <div class="clinical-simpton">
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                            <div class="clinical-simpton-btn">
                                <a class="view-plan-btn linkedto" href="#view-paln"><?php _e('View plan', 'stiffi'); ?></a>
                                <a class="book-now-btn linkedto" href="#view-paln"><?php _e('Book Now', 'stiffi'); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                // Reset Query
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>	
</section>
<!-- Cleaning Section Area -->


<!-- How It Works Section -->
<section id="how-it-works" class="how-it-works">
    <div class="container text-center">
        <div class="section-header">
            <h2><?php _e('How it Works ?', 'stiffi'); ?></h2>			
        </div>

        <div class="row center" id="how_works">
            <?php
            query_posts(array('post_type' => 'Works', 'posts_per_page' => 4, 'order' => 'DESC'));
            while (have_posts()) : the_post();
                ?>
                <div class="col-lg-3 col-sm-3 works-box">				
                    <h5><?php the_title(); ?></h5>
                    <span><?php the_excerpt(); ?></span>				
                </div>
                <?php
            endwhile;
            wp_reset_query();
            ?>			
        </div>
    </div>
</section>
<!-- How It Works Section -->

<!-- Monday To Friday Section -->
<section id="customizeplans" class="customizeplans">
    <div class="container">
        <div class="col-md-6 customize-box">
            <?php
            $post_title = get_post(92);
            $post_content = get_post(92);
            ?>
            <p class="customizetheplan"><?php echo $post_content->post_content; ?></p>
            <a href="#customize-plan-steps" class="customizetheplan-btn linkedto"><?php echo $post_title->post_title; ?></a>
        </div>
        <div class="col-md-6 customize-box">
            <?php echo get_the_post_thumbnail(92, 'full'); ?>
        </div>
    </div>
</section>
<!-- Monday To Friday Section -->

<div id="all-plan-section" class="clearfix">
    <!-- View Plan Section -->
    <section id="view-paln" class="view-plan">
        <div class="container">
            <div class="view-plan-header text-center">
                <h3 class="view-plan-title">
                    <?php echo get_post_field('post_title', 97); ?>
                </h3>			
            </div>		
            <div class="row">			
                <div class="house-cleaning House clearfix">		  	
                    <?php echo get_post_field('post_content', 97); ?>  			    
                </div>
                <div class="cleaning-or-button text-center hide">
                    <p>or</p>
                    <a href="#customize-plan-steps" class="book-now-btn">Customize Your Plan</a>
                </div>
            </div>
        </div>
    </section>
    <!--View Plan Section -->

    <!-- Monday To Friday Section -->
    <section id="laundry-cleaning" class="laundry-cleaning text-center">
        <div class="container">
            <div class="laundry-cleaning-title">
                <h3 class="view-plan-title"><?php echo get_post_field('post_title', 206); ?></h3>
            </div>
            <div class="laundry-cleaning-desc">
                <?php echo get_post_field('post_content', 206); ?></p>			
            </div>
    </section>
    <!-- Monday To Friday Section -->

    <!-- Customize Section Area -->
    <section id="customize-plan-steps" class="customize-plan-steps hide">
        <div class="container">
            <div class="customize-plan-inner">
                <div class="view-plan-header text-center">
                    <h3 class="view-plan-title"><?php echo get_post_field('post_title', 92); ?></h3>
                </div>			
                <div class="row">
                    <div class="customize-plan">			  	 	
                        <div class="col-lg-6 col-md-6 customize-plan-box">
                            <p><?php _e('How many beds ?', 'spiffi'); ?></p>
                            <div class="customize-plan-range">
                                <?php
                                $count = 7;
                                for ($i = 1; $i < $count; $i++) {
                                    ?>
                                    <div class="range-div1 <?php echo "l" . $i; ?>" step-tag1="<?php echo $i; ?>"><span class="circle1"></span></div>
                                    <?php
                                }
                                ?>
                                <ul>
                                    <?php
                                    $count = 7;
                                    for ($i = 1; $i < $count; $i++) {
                                        ?>
                                        <li><a hre="#" class="all-no1 <?php echo "Nb" . ($i - 1); ?>"><?php echo ($i - 1); ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>	    	
                        </div>
                        <div class="col-lg-6 col-md-6 customize-plan-box">
                            <p><?php _e('How many baths ?', 'spiffi'); ?></p>
                            <div class="customize-plan-range">
                                <?php
                                $count = 7;
                                for ($i = 1; $i < $count; $i++) {
                                    ?>
                                    <div class="range-div <?php echo "s" . $i; ?>" step-tag="<?php echo $i; ?>"><span class="circle"></span></div>
                                    <?php
                                }
                                ?>
                                <ul>
                                    <?php
                                    $count = 7;
                                    for ($i = 1; $i < $count; $i++) {
                                        ?>
                                        <li><a hre="#" class="all-no <?php echo "N" . ($i - 1); ?>"><?php echo ($i - 1); ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>    
                </div>
                <form action="<?php echo get_site_url(); ?>/checkout" method="GET" class="wpcf7-form" id="checkout-form">
                <div class="row">
                    <div class="like-us-section clearfix">
                        <p class="like-us-title"><?php _e('When would you like us ?', 'spiffi'); ?></p>
                        <div id="extra_customize" class="cleaning-or-button">
                            <p id="addon-note">Note: Select your plan first and then customize it by addons.</p>
                            <a href="#view-paln" class="book-now-btn text-center">View Plan</a>
                        </div>
                        <div class="col-md-6">
                            <div class="like-us-calender">
                                <div id="datepicker">
                                </div>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="like-us-timer">
                                <div id="#datetimepicker9"></div>
                                <div class="like-us-recuring clearfix">								
                                    <?php //echo do_shortcode('[contact-form-7 id="212" title="customize plan"]'); ?>								
                                    <!--manual code for form-->
                                    <div role="form" class="" id="" lang="en-US" dir="ltr">

                                        

                                            <div style="display:none;">
                                                <input type="hidden" id="hmbaths" name="hmbaths" value="0" class="">
                                                <input type="hidden" id="hmbeds" name="hmbeds" value="0" class="">
                                                <input type="hidden" name="plan" value="" class="">
                                                <input type="hidden" name="start_date" id="start_date" value="<?php echo time(); ?>" class="">
                                            </div>

                                            <!--         End CF7 Modules -->
                                            <p><span class="block">Recurring Options:</span>
                                                <span class="wpcf7-form-control-wrap weekly">
                                                    <span class="wpcf7-form-control wpcf7-radio regular-radio">
                                                        <span class="wpcf7-list-item first">
                                                            <input type="radio" name="subscription_period" value="week" checked="checked" id="recurring_week"> &nbsp;
                                                            <label for="recurring_week" class="wpcf7-list-item-label">Weekly</label>

                                                        </span>
                                                        <span class="wpcf7-list-item">
                                                            <input id="recurring_month" type="radio" name="subscription_period" value="month">&nbsp;
                                                            <label for="recurring_month" class="wpcf7-list-item-label">Monthly</label>

                                                        </span>
                                                        <span class="wpcf7-list-item last">
                                                            <input id="recurring_year" type="radio" name="subscription_period" value="year">&nbsp;
                                                            <label for="recurring_year" class="wpcf7-list-item-label">Yearly</label>
                                                        </span>
                                                    </span>
                                                </span>
                                            </p>
                                    </div>
                                    <!--form end-->


                                </div>							
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <label class="label-notes" for="comment">Additional Notes:</label>
                            <textarea class="form-control" name="notes" rows="3" id="notes"></textarea>
                            <p><input type="submit" disabled value="Next" class="wpcf7-form-control wpcf7-submit book-now-btn disabled" id="like-us-submit"></p>
                        </div>
                        
                    </div>
                </div>	
                </form>
            </div>
        </div>
    </section>
    <!-- Customize Section Area -->
</div>

<!-- Testimonials Area -->
<section id="testimonial-area" class="testimonial">
    <div class="container">
        <div class="testimonial-inner text-center">
            <?php
            $post_title = get_post(72);
            $post_content = get_post(72);
            ?>
            <h2><?php echo $post_title->post_title; ?></h2>
            <p><?php echo $post_content->post_content; ?></p>
        </div>		
        <div class="testimonial-desc clearfix">
            <?php
            $args = array('post_type' => 'testimonials', 'posts_per_page' => '-1', 'order' => 'DESC');
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
                ?>
                <div class="item">					
                    <div class="testimonal">
                        <span class="testimoial-img"><?php the_post_thumbnail(); ?></span>
                        <div class="testimonials-item">
                            <?php the_content(); ?>
                            <span class="testimoial-client"><?php //the_excerpt();  ?></span>
                        </div>						
                    </div>
                </div>
            <?php endwhile; ?>
        </div>		
    </div>
</section>
<!-- Testimonials Area -->

<section id="client-logo" class="client-logo">
    <div class="container">		
        <div id="clients-images">
            <?php
            query_posts(array('post_type' => 'Logos', 'posts_per_page' => -1, 'order' => 'DESC'));
            while (have_posts()) : the_post();
                ?>
                <div class="item">
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail();
                    }
                    ?>
                </div>
                <?php
            endwhile;
            wp_reset_query();
            ?>
        </div>
    </div>
</section>





<?php get_footer(); ?>

<div class="modal fade" id="addonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Want something extra?</h4>
            </div>
            <div class="modal-body">
                Hey! along with this plan you can also have some addons. Do you want to customize plan to avail more beds or baths?
            </div>
            <div class="modal-footer">
                <a id="btn-no" class="btn btn-default" href="" target="_blank">Not now.</a>
                <button type="button" id="btn-yes" class="btn btn-primary">Yeah I am interested.</button>
            </div>
        </div>
    </div>
</div>