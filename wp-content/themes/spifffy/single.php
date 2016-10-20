<?php get_header(); ?>

<div id="content-area">	
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<?php
				if(have_posts()) :
				while(have_posts()) : the_post();
				?>
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>
				<div class="article-meta-data">
					<span class="meta-date"><i>Posted:</i> <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></a></span>
					<span class="meta_author"> <?php _e('<i>By:</i>'); ?> <?php the_author_posts_link(); ?> </span>
					<span class="meta-category"><i>Posted in:</i> <?php aht_list_cats(5); ?></span>
					<span class="meta-comment"><?php comments_popup_link('No Comments ', '1 Comment ', '% Comments: ') ; ?></span>									
					<span class="edit_post_link"><?php edit_post_link('Edit','','') ; ?></span>
				</div>

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
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
				endwhile;
				?>

				<div class="single-article-navv clearfix">
					<div class="next-article-link pull-left">
						<?php previous_post('&larr; %', 'Previous', 'no'); ?>
					</div>
					<div class="prev-article-link pull-right">
						<?php next_post('% &rarr;', 'Next', 'no'); ?>
					</div>
				</div>

				<?php
				else :
					echo wpautop( 'Sorry, no posts were found.' );
				endif;
				?>
			</div>

			<div class="col-sm-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>