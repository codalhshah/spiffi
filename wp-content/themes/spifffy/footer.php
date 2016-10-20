<!-- #footer-area -->
<div id="footer-area">
	<div id="top-footer">
		<div class="container">			
			<div id="subscribe-now" class="subscribe-now">
				<?php if ( is_active_sidebar( 'Left Footer' ) ) : ?>
					<?php dynamic_sidebar( 'Left Footer' ); ?>
					<?php endif; ?>
			</div>
			<div id="social-section" class="social-section">
				<div id="footer-social-links" class="social-links">
					<?php if ( is_active_sidebar( 'Right Footer' ) ) : ?>
					<?php dynamic_sidebar( 'Right Footer' ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div id="bottom-footer">
		<div class="container">
			<div class="row">			
				<div class="col-sm-6 col-md-6 col-xs-6">					
					<div class="call-us">
						<p>Call us with any questions <span><a href="tel:(857) 888-5560">312-735-6215</a></span></p>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-6">
					<?php
					if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'footer' ) ){
						wp_nav_menu(
							array(
								'sort_column' => 'menu_order',
								'container_class' => 'menu-container clearfix',
								'container_id' => 'footer-menu',
								'menu_class' => 'menu clearfix',
								'theme_location'  => 'footer'
							)
						);
					} else {
					?>
					<div id="footer-menu" class="menu-container clearfix">
						<ul id="menu-footer-navigation" class="menu clearfix">
							<?php wp_list_pages('title_li=&depth=0'); ?>
						</ul>
					</div>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>
</div> <!-- /#footer-area -->
<?php wp_footer(); ?>

<a id="scroll2top" href="javascript:void(0);" title="Scroll to top">Scroll to top</a>
<script type="text/javascript">
	jQuery(document).ready(function() {	

	  //jQuery( "#datepicker" ).datepicker();
	});

</script>
<script type="text/javascript">
  $(function () {  	
    $('#datepicker').datepicker({
       viewMode: 'years',
       dateFormat: 'yy-mm-dd',
       onSelect: function(dateText){
            $('#start_date').val(dateText);
        },
       minDate: 0
    });   
  });
 </script>
 <script type="text/javascript">
  $(function () {
    $('#datetimepicker9').datepicker({
      datepicker:false,
	  format:'H:i'
    });
  });
 </script>
</body>
</html>