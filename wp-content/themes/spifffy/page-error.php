<?php
/**
 * Template Name: Error
 *
 * @package WordPress
 * @subpackage Spiffi
 * @since Spiffi 1.0
 */
get_header();
session_start();
?>

<div id="content-area">	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php
				if(have_posts()) :
				while(have_posts()) : the_post();
				?>
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>

				<div class="articles-wrapper article-loop-post">
					<div class="row article clearfix">
						<?php 
						if(has_post_thumbnail()){
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
							echo '<div class="article-feature-img col-sm-12">';
							echo '<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" title="'.get_the_title().'">';
							echo '</div>';
						}
						?>

						<div class="article-content col-sm-12">
							<div class="article-excerpt">
								<?php
                                                                $original_content = get_the_content();
                                                                $finds = array('{{error_message}}');
                                                                $relace = array($_SESSION['error_msg']);
                                                                $contemnt = str_replace($finds, $relace, $original_content);
                                                                echo $contemnt;
                                                                
                                                                ?>
							</div>
						</div>
					</div>
				</div>
				<?php
				endwhile;

				else :
					echo wpautop( 'Sorry, no posts were found.' );
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>