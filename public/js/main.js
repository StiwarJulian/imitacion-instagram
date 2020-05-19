window.addEventListener("load", function(){
	const url = 'http://insta_lab.ml';

	// boton like
	$('.btn-like').css('cursor', 'pointer');
	$('.btn-dislike').css('cursor', 'pointer');

	// boton like
	function like(){
		$('.btn-like').unbind('click').click(function(){
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).attr('src',url+'img/heart-red.png');

			$.ajax({
				url: url+'image/detail/like/'+$(this).data('id'),
				method: 'GET',
				success: function(response){
					if(response.like){
						console.log('like a la publicacion');
					}else{
						console.log('error al dar like');
					}
				}
			})
			dislike();

		});
	}
	like();

	// boton dislike
	function dislike(){
		$('.btn-dislike').unbind('click').click(function(){
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).attr('src',url+'img/heart-black.png');

			$.ajax({
				url: url+'image/detail/dislike/'+$(this).data('id'),
				method: 'GET',
				success: function(response){
					if(response.like){
						console.log('dislike a la publicacion');
					}else{
						console.log('error al dar dislike');
					}
				}
			})

			like();

		});
	}
	dislike();


	//BUSCADOR

	$('#buscador').submit(function(){

		$(this).attr('action', url+'/user/gente/'+$('#buscador #search').val());
	});

});


