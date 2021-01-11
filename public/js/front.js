$(document).ready(function(){
	$('.js-open-search').on('click', function() {
        $('.js-search-form').addClass('active');
    });


    $('.js-close-search').on('click', function() {
        $('.js-search-form').removeClass('active');
    });

	$('.js-select2').select2();

	$('.js-song-already').on('change', function(){
		console.log($(this).val());
		if($(this).val()) {
			$(this).parents('.position-single').find('.js-newsong').addClass('inactive');
			$(this).parents('.position-single').find('.js-newsong').removeAttr('required');
			$(this).parents('.position-single').find('.js-newsong select').removeAttr('required');
		} else {
			$(this).parents('.position-single').find('.js-newsong').removeClass('inactive');
			$(this).parents('.position-single').find('.js-newsong').addAttr('required');
			$(this).parents('.position-single').find('.js-newsong select').addAttr('required');
		}
	});

	/*$('.js-btn-feat').on('click', function(e) {
		e.preventDefault();
	});*/
});