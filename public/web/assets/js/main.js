$.noConflict();

jQuery(window).on('scroll', function (){
    "use strict";

    if (jQuery(window).scrollTop() > 50) {
        jQuery('header').addClass('is-sticky');
    }
    else {
        jQuery('header').removeClass('is-sticky');
    }

    // Scroll to top
    if (jQuery(this).scrollTop() > 100) {
        jQuery('#scroll-to-top').fadeIn('slow');
    } else {
        jQuery('#scroll-to-top').fadeOut('slow');
    }

    // Single page Nav
    if (jQuery(this).scrollTop() > 400) {
        jQuery('.single-page .pagination').fadeIn('slow');
    } else {
        jQuery('.single-page .pagination').fadeOut('slow');
    }
});


jQuery(document).ready(function($) {

	"use strict";


	$( '.page_item_has_children, .menu-item-has-children' ).each(function() {  
		$(this).mouseover( 
			function(){ $(this).children("ul.children, .sub-menu").slideDown('fast'); }
			);
		$(this).mouseleave( 
			function(){ $(this).children("ul.children, .sub-menu").slideUp('fast'); }
			);
	});


	$('#main-banner, #error-banner').css({height: $(window).height() - 140});

    /*------------- Scroll to Top -----------------*/
    $('#scroll-to-top').click(function(){
        $("html,body").animate({ scrollTop: 0 }, 1000);
        return false;
    });

    // Portfolio Gallery

    var $galleryItems = $('#gallery-items'),
    colWidth = function () {
    	var w = $galleryItems.width(), 
    	columnNum = 1,
    	columnWidth = 0;
    	if (w > 1170) {
    		columnNum  = 4;
    	} 
    	else if (w > 960) {
    		columnNum  = 4;
    	} 
    	else if (w > 640) {
    		columnNum  = 3;
    	} 
    	else if (w > 480) {
    		columnNum  = 2;
    	}  
    	else if (w > 360) {
    		columnNum  = 1;
    	} 
    	columnWidth = Math.floor(w/columnNum);
    	$galleryItems.find('.item').each(function() {
    		var $item = $(this),
    		multiplier_w = $item.attr('class').match(/item-w(\d)/),
    		multiplier_h = $item.attr('class').match(/item-h(\d)/),
    		width = multiplier_w ? columnWidth*multiplier_w[1] : columnWidth,
    		height = multiplier_h ? columnWidth*multiplier_h[1]*0.75-10 : columnWidth*0.825-10;
    		$item.css({
    			width: width,
    			height: height
    		});
    	});
    	return columnWidth;
    },
    isotope = function () {
    	$galleryItems.isotope({
    		resizable: true,
    		itemSelector: '.item',
    		masonry: {
    			columnWidth: colWidth(),
    			gutterWidth: 10
    		}
    	});
    };
    isotope();
    $(window).smartresize(isotope);


    $('.itemFilter a').on("click", function(){
    	$('.itemFilter .current').removeClass('current');
    	$(this).addClass('current');

    	var selector = $(this).attr('data-filter');
    	$galleryItems.isotope({
    		filter: selector,
    		animationOptions: {
    			duration: 750,
    			easing: 'linear',
    			queue: false
    		}
    	});
    	return false;
    }); 
}); 


/*----------- Scroll to About Section ----------*/ 
jQuery('#go-to-next').click(function() {
    jQuery('html,body').animate({scrollTop:jQuery('#about').offset().top }, 1000);
});


  /*---------------- Subscribe ---------------*/
  
  jQuery("#mc4wp-form").ajaxChimp({
    callback: mailchimpResponse,
        url: "http://jeweltheme.us10.list-manage.com/subscribe/post?u=a3e1b6603a9caac983abe3892&amp;id=257cf1a459" // Replace your mailchimp post url inside double quote "".  
      });

  function mailchimpResponse(resp) {
   if(resp.result === 'success') {
     
    jQuery('.alert-success').html(resp.msg).fadeIn().delay(3000).fadeOut();
    
  } else if(resp.result === 'error') {
    jQuery('.alert-warning').html(resp.msg).fadeIn().delay(3000).fadeOut();
  }  
};



	/* Contact
	-------------------------------------------------------------------*/
    // Email from Validation
    jQuery('#submit').click(function(e){ 

    //Stop form submission & check the validation
    e.preventDefault();


    jQuery('.name-error, .email-error, .subject-error, .message-error').hide();

    // Variable declaration
    var error = false;
    var k_name = jQuery('#name').val();
    var k_email = jQuery('#email').val(); 
    var k_subject = jQuery('#subject').val(); 
    var k_message = jQuery('#message').val();

    // Form field validation
    if(k_name.length == 0){
      var error = true; 
      jQuery('.name-error').html('<i class="fa fa-exclamation"></i> Name is required.').fadeIn();
    }  

    if(k_email.length == 0){
      var error = true; 
      jQuery('.email-error').html('<i class="fa fa-exclamation"></i> Please enter a valid email address.').fadeIn();
    }

    if(k_subject.length == 0){
      var error = true;
      jQuery('.subject-error').html('<i class="fa fa-exclamation"></i> Subject is required.').fadeIn();
    } 

    if(k_message.length == 0){
      var error = true;
      jQuery('.message-error').html('<i class="fa fa-exclamation"></i> Please provide a message.').fadeIn();
    }  

    // If there is no validation error, next to process the mail function
    if(error == false){

      // $('#contact-submit').hide();
      // $('#contact-loading').fadeIn();
      // $('.contact-error-field').fadeOut();


      // Disable submit button just after the form processed 1st time successfully.
      jQuery('#submit').attr({'disabled' : 'true', 'value' : 'Sending' });

      /* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to email.php*/
      jQuery.post("email.php", jQuery(".wpcf7-form").serialize(),function(result){
        //Check the result set from email.php file.
        if(result == 'sent'){



          //If the email is sent successfully, remove the submit button
          jQuery('#name').remove();
          jQuery('#email').remove();
          jQuery('#subject').remove(); 
          jQuery('#message').remove();
          jQuery('#contact-submit').remove(); 

          // jQuery('.contact-box-hide').slideUp();
          jQuery('.wpcf7-response-output').html('<i class="fa fa-check contact-success"></i><div>Your message has been sent.</div>').fadeIn();
        } else {
          // jQuery('.btn-contact-container').hide();
          jQuery('.wpcf7-response-output').html('<i class="fa fa-exclamation contact-error"></i><div>Something went wrong, please try again later.</div>').fadeIn();
          
        }
      });
    }
  });  
