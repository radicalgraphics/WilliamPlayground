/*-----------------------------------------------------------------------------------*/
/*	Custom Footer JS
/*-----------------------------------------------------------------------------------*/

(function($) {
	
	// Capture page elements
	var $pageContent = $('.main-content');
	var $portfolioContainer = $('#isotope-trigger');
	var $dropdownContainer = $('.dropdown-container');
	var $dropdownContent = $('.dropdown-content');
	var $tagline = $('.tagline');
	var $mobileMenu = $('.mobile-menu');
	var isIE9 = $('html').hasClass('ie9');	
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Header Buttons
	/*-----------------------------------------------------------------------------------*/
	
	$('.tagline-button, .menu-button').click(function(e) {
	
		var clicked = e.target;
		var wrapperHeight = $dropdownContainer.height();	
		var pageHeight = $dropdownContent.outerHeight(); 
		
		// Execute if the drop-down content is opened			
		if(wrapperHeight) {
			
			// Close the drop-down content, if the clicked header button corresponds to the content already opened in the drop-down, or else open the drop-down with new content. 
			if((clicked.className == 'tagline-button' && $tagline.css('display') == 'block') || (clicked.className == 'menu-button' && $mobileMenu.css('display') == 'block')) {
				if(Modernizr.csstransitions) {
					$dropdownContainer.transition({ height: 0 }, 300, 'ease', function() {
						$tagline.css('display', 'none'); 
						$mobileMenu.css('display', 'none'); 
					});	
				}
				else {
					$dropdownContainer.animate({ height: 0 }, 300, 'easeOutCubic', function() {
						$tagline.css('display', 'none'); 
						$mobileMenu.css('display', 'none'); 
					});	
				}
			}
			else {
				if(Modernizr.csstransitions) {
					$dropdownContainer.transition({ height: 0 }, 300, 'ease', function() {
						if(clicked.className == 'tagline-button') {
					   		$tagline.css('display', 'block'); 
					   		$mobileMenu.css('display', 'none'); 
				        }
				        else {
					   		$tagline.css('display', 'none'); 
					        $mobileMenu.css('display', 'block'); 
				        }
				        
				        pageHeight = $dropdownContent.outerHeight(); 
						
						$dropdownContainer.transition({ height: pageHeight }, 300, 'ease');
					});	
				}
				else {
					$dropdownContainer.animate({ height: 0 }, 300, 'easeOutCubic', function() {
						if(clicked.className == 'tagline-button') {
					   		$tagline.css('display', 'block'); 
					   		$mobileMenu.css('display', 'none'); 
				        }
				        else {
					   		$tagline.css('display', 'none'); 
					        $mobileMenu.css('display', 'block'); 
				        }
				        
				        pageHeight = $dropdownContent.outerHeight(); 
						
						$dropdownContainer.animate({ height: pageHeight }, 300, 'easeOutCubic', function() {
							$(this).css('height', 'auto');	
						});
					});	
				}
			}
			
		}
		// The drop-down is closed. Open it.
		else {
			if(clicked.className == 'tagline-button') {
				$tagline.css('display', 'block'); 
			   	$mobileMenu.css('display', 'none'); 
		    }
		    else {
				$tagline.css('display', 'none'); 
			    $mobileMenu.css('display', 'block'); 
		    }
		        
		        pageHeight = $dropdownContent.outerHeight(); 
				
				if(Modernizr.csstransitions) {
					$dropdownContainer.transition({ height: pageHeight }, 300, 'ease');
				}
				else {
					$dropdownContainer.animate({ height: pageHeight }, 300, 'easeOutCubic', function() {
						$(this).css('height', 'auto');	
					});	
				}
		}
				
		$('body, html').animate({ scrollTop: 0 }, 200, 'easeOutCubic' );
				
	});
	
	$('.close-button').click(function() {
		if(Modernizr.csstransitions) {
			$dropdownContainer.transition({ height: 0 }, 300, 'ease', function() {
				$tagline.css('display', 'none'); 
				$mobileMenu.css('display', 'none'); 
			});	
		}
		else {
			$dropdownContainer.animate({ height: 0 }, 300, 'easeOutCubic', function() {
				$tagline.css('display', 'none'); 
				$mobileMenu.css('display', 'none'); 
			});	
		}
	});
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Isotope
	/*-----------------------------------------------------------------------------------*/
	
	/* filter items with an isotope filter animation, when one of the filter links is clicked */
	if($('body').hasClass('single-portfolio') || $('body').hasClass('page-template-template-portfolio-php')) {
		$('.portfolio-filter a').click(function(e) {	
			e.preventDefault();
			
			var selector = $(this).attr('data-filter');
		 	$portfolioContainer.isotope({ filter: selector });
			
			if($('body').hasClass('single-portfolio') || Modernizr.mq('only screen and (max-width: 1220px)')) { 
				$('html, body').animate({
				    scrollTop: $portfolioContainer.offset().top - 20
				}, 800);
			}		  	
		});
	}
	
	/* Reset the active class on all the buttons and assign it to the currently active category */
	$('.portfolio-filter li a').click(function() { 				
		$('.portfolio-filter li').removeClass('active'); 
		$(this).parent().addClass('active'); 
	});
	
	/* initialize isotope for the portfolio */
	$portfolioContainer.imagesLoaded(function() {
			
		// bind isotope to window resize
	    $(window).smartresize(function() {
	    
	    	var colWidth = 230;
	    
	    	if(Modernizr.mq('only screen and (min-width: 680px)') && Modernizr.mq('only screen and (max-width: 780px)')) {
		    	colWidth = 200;
	    	}
	    											  	        	     	      	      	      	      	
		    $portfolioContainer.isotope({
		    	resizable: false,
		        masonry: {
		        	columnWidth: colWidth
		        },
		        animationOptions: {
			    	duration: 650
				}
		    });
		// trigger resize so isotope layout is triggered
		}).smartresize();
			
	});


	/*-----------------------------------------------------------------------------------*/
	/*	Responsive Videos
	/*-----------------------------------------------------------------------------------*/
	
	$pageContent.fitVids(); 
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Comment Form Placeholders for IE9
	/*-----------------------------------------------------------------------------------*/
	
	if (isIE9) {
		
		var authorPlaceholder = $('#commentform #author').attr('placeholder');
		var emailPlaceholder = $('#commentform #email').attr('placeholder');
		var urlPlaceholder = $('#commentform #url').attr('placeholder');
		var commentPlaceholder = $('#commentform #comment').attr('placeholder');		
				
		$('#commentform #author').val(authorPlaceholder);
		$('#commentform #email').val(emailPlaceholder);
		$('#commentform #url').val(urlPlaceholder);
		$('#commentform #comment').val(commentPlaceholder);
		
		$('#commentform input, #commentform textarea').focus(function() {
			if($(this).attr('id') == 'author') {
				if ($(this).val() == authorPlaceholder) { $(this).val(''); }
			}
			else if($(this).attr('id') == 'email') {
				if ($(this).val() == emailPlaceholder) { $(this).val(''); }
			}
			else if($(this).attr('id') == 'url') {
				if ($(this).val() == urlPlaceholder) { $(this).val(''); }
			}
			else if($(this).attr('id') == 'comment') {
				if ($(this).val() == commentPlaceholder) { $(this).val(''); }
			}
		});
		
		$('#commentform input, #commentform textarea').blur(function() {
			if($(this).attr('id') == 'author') {
				if ($(this).val() == '') { $(this).val(authorPlaceholder); }
			}		
			else if($(this).attr('id') == 'email') {
				if ($(this).val() == '') { $(this).val(emailPlaceholder); }
			}
			else if($(this).attr('id') == 'url') {
				if ($(this).val() == '') { $(this).val(urlPlaceholder); }
			}
			else if($(this).attr('id') == 'comment') {
				if ($(this).val() == '') { $(this).val(commentPlaceholder); }
			}
		});
	
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Responsive Tables
	/*-----------------------------------------------------------------------------------*/
	
	$('.the-content table').addClass('responsive');
	
	var switched = false;
  	var updateTables = function() {
	    if (($(window).width() < 767) && !switched ){
	    	switched = true;
	      	$("table.responsive").each(function(i, element) {
	        	splitTable($(element));
	      	});
	      	return true;
	    }
	    else if (switched && ($(window).width() > 767)) {
	      	switched = false;
	      	$("table.responsive").each(function(i, element) {
	        	unsplitTable($(element));
	      	});
	    }
  	};
   
  	$(window).load(updateTables);
  	$(window).bind("resize", updateTables);
   
	function splitTable(original) {
		original.wrap("<div class='table-wrap' />");
		
		var copy = original.clone();
		copy.find("td:not(:first-child), th:not(:first-child)").css("display", "none");
		copy.removeClass("responsive");
		
		original.closest(".table-wrap").append(copy);
		copy.wrap("<div class='pinned' />");
		original.wrap("<div class='scrollable' />");
	}
	
	function unsplitTable(original) {
    	original.closest(".table-wrap").find(".pinned").remove();
    	original.unwrap();
   	 	original.unwrap();
	}
	
	
})( jQuery );