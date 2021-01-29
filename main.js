$(function(){
	$(window).on('load scroll',function (){
		$('.main-box,.comment-box').each(function(){
			var target = $(this).offset().top;
			var scroll = $(window).scrollTop();
			var height = $(window).height();
			if (scroll > target - height){
				$(this).addClass('active');
			}
		});
	});
});