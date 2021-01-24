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

	if ($('[data-list-id]').length > 0) {
		$('[data-list-id]').on('click', function(e){
			e.preventDefault();

			$('tab-single').removeClass('active');
			$(this).addClass('active');
			$('[data-show-id]').removeClass('show');
			$('[data-show-id=' + $(this).attr('data-list-id')+ ']').addClass('show');
		});

		$('[data-list-id]').trigger('click');
	}

	/*$('.js-btn-feat').on('click', function(e) {
		e.preventDefault();
	});*/
});