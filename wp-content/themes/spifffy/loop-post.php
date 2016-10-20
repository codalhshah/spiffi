<div id="content-area">	
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<!-- Page Title -->
					<?php if(is_category()) { ?>
					<h1 class="page-title">
						<?php printf( __( 'Category Archives: %s', 'spiffy' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
					</h1>
					<?php } elseif(is_author()) { ?>
					<?php  $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
					<h1 class="page-title author">
						<?php echo "Author Archives: "; echo $curauth->display_name;  ?>
					</h1>
					<?php } elseif(is_archive()) { ?>
					<h1 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: <span>%s</span>', 'spiffy' ), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: <span>%s</span>', 'spiffy' ), get_the_date('F Y') ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: <span>%s</span>', 'spiffy' ), get_the_date('Y') ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'spiffy' ); ?>
						<?php endif; ?>
					</h1>
					<?php } elseif(is_tag()) { ?>
					<h1 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: <span>%s</span>', 'spiffy' ), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: <span>%s</span>', 'spiffy' ), get_the_date('F Y') ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: <span>%s</span>', 'spiffy' ), get_the_date('Y') ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'spiffy' ); ?>
						<?php endif; ?>
					</h1>
					<?php } elseif(is_search()) { ?>
					<h1 class="page-title">
						<?php printf( __( 'Search Results for: %s', 'spiffy' ), '<span>' . get_search_query() . '</span>' ); ?>
					</h1>
					<?php } ?>
					<!-- /Page Title -->

					<div class="articles-wrapper article-loop-post">
						<?php
						if(have_posts()) :
						while(have_posts()) : the_post();
						?>
						<div class="row article clearfix">
							<div class="col-sm-8">
								<?php
								$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
								if( !empty($thumbnail) ){// check if post have a post thumbnails!				
									echo '<a href="'.get_permalink().'" title="'.get_the_title().'">
										<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" title="'.get_the_title().'">
									</a>';
								}
								?>
							</div>
							<div class="col-sm-8">
								<h2 class="article-title">
				  					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				  						<?php the_title(); ?>
				  					</a>
								</h2>
								<div class="article-meta-data">

									<span class="meta-date"><i>Posted:</i> <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></a></span>
									<span class="meta_author"> <?php _e('<i>By:</i>'); ?> <?php the_author_posts_link(); ?> </span>
									<span class="meta-category"><i>Posted in:</i> <?php aht_list_cats(5); ?></span>
									<span class="meta-comment"><?php comments_popup_link('No Comments ', '1 Comment ', '% Comments: ') ; ?></span>									
									<span class="edit_post_link"><?php edit_post_link('Edit','','') ; ?></span>
								</div>
								<div class="article-excerpt">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>

						<?php
						endwhile;
						?>

						<div class="single-article-navv clearfix">
							<div class="next-article-link pull-left">
								<?php previous_posts_link('&larr; Previous'); ?>
							</div>
							<div class="prev-article-link pull-right">
								<?php next_posts_link('Next &rarr;'); ?>
							</div>
						</div>

						<?php
						else :
							echo wpautop( 'Sorry, no posts were found.' );
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
</div>