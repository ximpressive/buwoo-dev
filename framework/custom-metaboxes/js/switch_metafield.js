window.CMB2 = (function(window, document, $, undefined){
	'use strict';
	$(".cmb2-enable").on('click', function(){
        var parent = $(this).parents('.cmb2-switch');
        $('.cmb2-disable',parent).removeClass('selected');
        $(this).addClass('selected');

    });
    $(".cmb2-disable").on('click', function(){
        var parent = $(this).parents('.cmb2-switch');
        $('.cmb2-enable',parent).removeClass('selected');
        $(this).addClass('selected');

    });


// $(".cmb2-id-boutique-header .cmb2-disable").on('click', function(){
// 	$("#boutique_headeroption").fadeOut();
// });
// $(".cmb2-id-boutique-header .cmb2-enable").on('click', function(){
// 	$("#boutique_headeroption").fadeIn();
// });
//
// $(".cmb2-id-boutique-mainnav .cmb2-disable").on('click', function(){
// 	$(".cmb2-id-boutique-select").fadeOut();
// });
// $(".cmb2-id-boutique-mainnav .cmb2-enable").on('click', function(){
// 	$(".cmb2-id-boutique-select").fadeIn();
// });


})(window, document, jQuery);
