jQuery(document).ready(function() {
	//Jquery for Goto 
	jQuery("#primary-menu ul li a").click(function(){
	    jQuery('html, body').animate({
	      scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top
	    }, 800);
	    return false; 
	});

	jQuery("a.linkedto").click(function(){
	    jQuery('html, body').animate({
	      scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top
	    }, 800);
	    return false; 
	});

	

//	$("#datepicker").datepicker({
//	    onSelect: function()
//	    { 
//	        var dateObject = $(this).datepicker('getDate'); 
//
//	        alert(dateObject);
//	    }
//	});

});



jQuery(document).ready(function() {
	(function ($){
		var window_width = $(window).width();
		var window_height = $(window).height();

		/*= Scroll to top */
		$(window).scroll(function(){
			if ($(this).scrollTop() > 150) {
				$('#scroll2top').fadeIn();
			} else {
				$('#scroll2top').fadeOut();
			}
		});

		$('#scroll2top').click(function(){
			$('html, body').animate( {scrollTop : 0}, 500 );
			return false;
		});

		if(window_width < 1030){
			$('#primary-menu').meanmenu({
				'meanScreenWidth': '1029',
				meanRemoveAttrs: true
			});

			$('#random-articles').owlCarousel();

			$('.section-articles').owlCarousel({
				margin: 15
			});
		}

		$(".testimonial-desc").owlCarousel({ 
	      navigation : true, // Show next and prev buttons
	      slideSpeed : 300,	    
	      autoPlay: 6000,
	      stopOnHover : true, 
	      paginationSpeed : 400,
	      singleItem:true
	  });

		$("#mobile-slider").owlCarousel({	 
	      navigation : true, // Show next and prev buttons
	      slideSpeed : 300,
	      autoPlay: 6000,
	      stopOnHover : true,
	      paginationSpeed : 400,
	      singleItem:true
	  });
	}(jQuery));
	jQuery("#like-us-submit").click(function(){
            
//            jQuery(".ui-datepicker-calendar > tbody > tr").each(function(){
//                    var text_click_date = (jQuery(this).find(".ui-datepicker-current-day").children("a").text());
//                    jQuery(".caldate").val(text_click_date);
//            })
	});

		jQuery(".circle").css("display","none");
		jQuery(".s1 .circle").css("display","block").text(1);
		jQuery(".hmbaths").val(1);
		jQuery(".s1 .circle").addClass("active");
		jQuery(".all-no").css("display","block");
        jQuery(".all-no:first").css("display","none");
//		jQuery(".range-div").click(function(){
//                    var incr=Number(steps)+1;
//			jQuery(".all-no").css("display","block");
//			jQuery(".circle").css("display","none");
//			var steps = jQuery(this).attr("step-tag");			
//			jQuery(".N"+incr).css("display","none");
//			jQuery(".circle").removeClass("active");
//			jQuery(this).children(".circle").css("display","block").text(steps);
//			jQuery(this).children(".circle").addClass("active");
//			jQuery(".hmbaths").val(steps);
//
//			
//		});

		jQuery(".circle1").css("display","none");
		jQuery(".l1 .circle1").css("display","block").text(1);
		jQuery(".hmbeds").val(1);
		jQuery(".l1 .circle1").addClass("active");
		jQuery(".all-no1").css("display","block");
                jQuery(".all-no1:first").css("display","none");
//		jQuery(".range-div1").click(function(){
//			jQuery(".all-no1").css("display","block");
//			jQuery(".circle1").css("display","none");
//			var steps = jQuery(this).attr("step-tag1");
//			
//			jQuery(".Nb"+steps).css("display","none");
//			jQuery(".circle1").removeClass("active");
//			jQuery(this).children(".circle1").css("display","block").text(steps);
//			jQuery(this).children(".circle1").addClass("active");
//			jQuery(".hmbeds").val(steps);
//			
//		});
		jQuery(".all-no").click(function(){			
			var no = jQuery(this).text();
            var incr = Number(no);
			jQuery(".all-no").css("display","block");
			jQuery(".circle").css("display","none");
			jQuery(".N"+no).css("display","none");
			jQuery(".s"+incr).children(".circle").css("display","block").text(no);
			jQuery(".hmbaths").val(no);
			
		});

		jQuery(".all-no1").click(function(){
			var no = jQuery(this).text();
                        var incr = Number(no);
			jQuery(".all-no1").css("display","block");
			jQuery(".circle1").css("display","none");
			jQuery(".Nb"+no).css("display","none");
			jQuery(".l"+incr).children(".circle1").css("display","block").text(no);		
			jQuery(".hmbeds").val(no);	
			
		});	

});