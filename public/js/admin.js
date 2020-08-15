$(document).ready(function(){
	setTimeout(function(){
        var body = document.body,
            html = document.documentElement;

        var height = document.getElementsByClassName('admin-content-wrapper')[0].offsetHeight;

        document.getElementsByClassName('admin-sidebar')[0].style.height = (height) + 'px';
    },500);

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

	$('.js-btn-feat').on('click', function(e) {
		e.preventDefault();

	});
});