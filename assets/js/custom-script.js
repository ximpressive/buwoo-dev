jQuery(document).ready(function ($) {
 "use strict";

 // Fakes the loading setting a timeout
setTimeout(function() {
   $('body').addClass('loaded');
}, 3500);

// Retina logo
//----------------------------------
//window.retinajs()

jQuery('#accordion >.panel').css("display","block");

//wow js active
//----------------------------------
 new WOW().init();

/* WPML Language Menu */
	var $langBtn = $('#lang-list.lang-dropdown.translated');

		if($langBtn.length > 0){

			$langBtn.mouseover(function(){
				var $langDropdown = $(this).find('.lang-dropdown-inner');
				$langDropdown.stop().slideDown();
			}).mouseout(function(){
				var $langDropdown = $(this).find('.lang-dropdown-inner');
				$langDropdown.stop().slideUp();
			});

	}


// Header sticky scroll
//----------------------------------

	var c, currentScrollTop = 0,
	navbar = $('.header_sticky');

	$(window).scroll(function () {
		var a = $(window).scrollTop();
		var b = navbar.height();


		if( b > 100 ){
			navbar.addClass("sticky_bg");
		}else{
			navbar.removeClass("sticky_bg");
		}

		currentScrollTop = a;

		if ( c < currentScrollTop && a > b + b ) {
			navbar.addClass("scrollUp");
			navbar.removeClass("sticky_bg");
		} else if ( c > currentScrollTop && !(a <= b) ) {
			navbar.removeClass("scrollUp");
			navbar.addClass("sticky_bg");
		}
		c = currentScrollTop;
	});


//js scrollup
//----------------------------------
$.scrollUp({
	scrollText: '<i class="fa fa-angle-double-up"></i> TOP',
	easingType: 'linear',
	scrollSpeed: 900,
	animation: 'fade'
});
// Data images
//----------------------------------
$('.background-image').each(function () {
	var src = $(this).attr('data-src');
	$(this).css({
		'background-image': 'url(' + src + ')'
	});
});

//google map activation
//-----------------------------------
	if ($('#gmap').length > 0) {
		new GMaps({
			div: '#gmap',
			lat: 31.6175419, // //31.6175419,74.2811501
			lng:74.2811501,
			scrollwheel: false,
			styles: [
				{
					"featureType": "landscape",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#dddddd"
						},
						{
							"lightness": 20
						}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"color": "#ffffff"
						},
						{
							"lightness": 17
						}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "geometry.stroke",
					"stylers": [
						{
							"color": "#ffffff"
						},
						{
							"lightness": 29
						},
						{
							"weight": 0.2
						}
					]
				},
				{
					"featureType": "road.arterial",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#ffffff"
						},
						{
							"lightness": 18
						}
					]
				},
				{
					"featureType": "road.local",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#dddddd"
						},
						{
							"lightness": 16
						}
					]
				},
				{
					"featureType": "poi",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#ffffff"
						},
						{
							"lightness": 21
						}
					]
				},
				{
					"featureType": "poi.park",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#ffffff"
						},
						{
							"lightness": 21
						}
					]
				},
				{
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"visibility": "on"
						},
						{
							"color": "#ffffff"
						},
						{
							"lightness": 16
						}
					]
				},
				{
					"elementType": "labels.icon",
					"stylers": [
						{
							"visibility": "on"
						}
					]
				}
			]
		}).addMarker({
			lat: 23.792930, //23.792930, 90.403798
			lng: 90.403798,
			infoWindow: {
				content: '<p>Innwit Themes</p>'
			}
			});

	}


	$('.loop_cat_products').slick({
		centerMode: true,
		centerPadding: '250px',
		arrows : false,
		slidesToShow: 1,
		dots: true,
		responsive: [
			{
		      breakpoint: 2500,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '500px',
		        slidesToShow: 1
		      }
		    },
			{
		      breakpoint: 1920,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '400px',
		        slidesToShow: 1
		      }
		    },
			{
		      breakpoint: 1440,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '300px',
		        slidesToShow: 1
		      }
		    },
		    {
		      breakpoint: 1000,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '150px',
		        slidesToShow: 1
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '100px',
		        slidesToShow: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: false,
		        centerMode: false,
		        centerPadding: '0',
		        slidesToShow: 1
		      }
		    },
		    {
		      breakpoint: 0,
		      settings: {
		        arrows: false,
		        centerMode: false,
		        centerPadding: '0',
		        slidesToShow: 1
		      }
		    }
		]
	});

	

	$('.fproduct_slider').owlCarousel({
		autoplay: false,
	    nav: true,
	    dots: true,
	    loop: true,
	    margin: 0,
	    responsive: {
	      	0 : {
		        items:1,
		    },
	        480 : {
		        items:1,
		    },
		    768 : {
		        items:2,
		    },
		    1000 : {
		        items:4,
		    },
	    }
	});

	//  plus/ minus addto card button

	$('.num-increment').click(function() {
	    var $input = $(this).parent().find('input');
	    $input.val(parseInt($input.val()) + 1);
	    $input.change();
	    $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
	    return false;
	});

	$('.num-decrement').click(function() {
		var $input = $(this).parents('.quantity').find('.qty');
		var count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		$( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
		return false;
	});


	//search box focus effect
	//----------------------------------
	$('#search-form .form-control').on('focusin', function () {
		$('#search-form').addClass('active');
	});

	$('#search-form .form-control').on('focusout', function () {
		$('#search-form').removeClass('active');
	});


	//js popup search box effect
	//----------------------------------
	$('.btn-search-form-toggle').on('click', function () {
		$("#popup-search-box-area").toggleClass('search-form-show');
	});
	//minicart activation jquery
	//====================
	$('#minicart').on('click', function () {
		$('.minicart-page-area').toggleClass('active');
	});

	/*-------------------------------------
	Single services
	---------------------------------------*/
	$(".preview a").on("click", function(){
		$(".selected").removeClass("selected");
		$(this).addClass("selected");
			var picture = $(this).data();
			event.preventDefault(); //prevents page from reloading every time you click a thumbnail
		$(".full img").fadeOut( 100, function() {
			$(".full img").attr("src", picture.full);
			$(".full").attr("href", picture.full);
			$(".full").attr("title", picture.title);
		}).fadeIn();
	});// end on click

	$(".full").fancybox({
		helpers : {
			title: {
				type: 'inside'
			}
		},
		closeBtn : true,
	});


	//isotops

	var $container = $('#isotop_sec').isotope({
		itemSelector: '.item',
		masonry: {
			columnWidth: '.grid-sizer',
			isFitWidth: false
		}
	});


	$("#seemore").on("click", function(){
		$(".quick_cat").show("slide", {direction:"left"}, 500);
		$("#closeseemore").css("display","block");
		$("#seemore").css("display","none");
	});
	$("#closeseemore").on("click", function(){
		$(".quick_cat").hide("slide", {direction:"left"}, 500);
		$("#seemore").css("display","block");
		$("#closeseemore").css("display","none");
	});

	$('#nav-icon1').on("click", function(){
		$(this).toggleClass('open');
		$(".quick_cat").toggle("slide", {direction:"left"}, 500);
	});


	$(".incr-btn").on("click", function (e) {
        var $button = $(this);
        var oldValue = $button.parent().find('.quantity').val();
        $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
        if ($button.data('action') == "increase") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
                $button.addClass('inactive');
            }
        }
        $button.parent().find('.quantity').val(newVal);
        e.preventDefault();
    });

    $('.dpdn_menu').on("click", function(){
      $( this ).next().stop( true, true ).slideToggle();
    });

	$('.dropdown').on('show.bs.dropdown', function() {
		$(this).find('.dropdown-menu').first().stop(true, true).slideDown();
	});

	$('.dropdown').on('hide.bs.dropdown', function() {
		$(this).find('.dropdown-menu').first().stop(true, true).slideUp();
	});

	$.post(
		woocommerce_params.ajax_url,
		{'action': 'mode_theme_update_mini_cart'},
		function(response) {
			$('#mode-mini-cart').html(response);
		}
	);


	var $container = jQuery('#isotope-list'); //The ID for the list with all the blog posts
	$container.isotope({ //Isotope options, 'item' matches the class in the PHP
		itemSelector : '.item',
		layoutMode : 'masonry'
	});

	//Add the class selected to the item that is clicked, and remove from the others
	var $optionSets = $('#filters'),
	$optionLinks = $optionSets.find('a');

	$optionLinks.click(function(){
		var $this = $(this);
		// don't proceed if already selected
		if ( $this.hasClass('selected') ) {
			return false;
		}
		var $optionSet = $this.parents('#filters');
		$optionSets.find('.selected').removeClass('selected');
		$this.addClass('selected');

		//When an item is clicked, sort the items.
		var selector = $(this).attr('data-filter');
		$container.isotope({ filter: selector });

		return false;
	});

	$(".collapse.in").each(function(){
        $(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
    	$(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    }).on('hide.bs.collapse', function(){
    	$(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    });

    // remove parentheses
    jQuery('.woocommerce-widget-layered-nav-list li span.count').each( function() {
		jQuery(this).html( /(\d+)/g.exec( jQuery(this).html() )[0] );
	});


});

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}

function sidebarScroll(){
	var tmpWindow 	=	jQuery(window),
		wrapper 	=	jQuery('.product_top_sec').height(),
		header 		=	jQuery('.head_dyna').height(),
		sidebar 	=	jQuery('.pd_sidebar'),
		offsetTop 	=	sidebar.offset().top,
		offsetBottom;

		tmpWindow.scroll(function(){
	    offsetBottom = (wrapper + header) - sidebar.height();

	    if (tmpWindow.scrollTop() < offsetTop) {
	    	sidebar.removeClass('fixed bottom');
	    } else if (tmpWindow.scrollTop() > offsetBottom) {
	    	sidebar.removeClass('fixed').addClass('bottom');
	    } else if (tmpWindow.scrollTop() < offsetBottom) {
	    	sidebar.removeClass('bottom').addClass('fixed');
	    }
	});
}


jQuery(window).on('load', function ($) {
    var $container = jQuery('#isotope-list'); //The ID for the list with all the blog posts
	$container.isotope({ //Isotope options, 'item' matches the class in the PHP
		itemSelector : '.item',
		layoutMode : 'masonry'
	});

	jQuery('#accordion >.panel').css("display","block");
	//console.log('All assets are loaded');

    jQuery(".catproducts").owlCarousel({
		autoplay : false,
		nav: true,
		margin:10,
		navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>","<i class='fa fa-angle-right' aria-hidden='true'></i>"],
		navElement: 'span',
		dots: false,
		loop: true,
		items: 1,
		mouseDrag: false,
		touchDrag: false,
	});

	// product single page sidebar fixed scroll
    sidebarScroll();

});

// window.setTimeout(function () {
//     if (jQuery("html").hasClass("wf-active")) {
//       	jQuery("html").removeClass("wf-active");
//     }
//   }, 5000);
