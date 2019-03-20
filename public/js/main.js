var url = 'http://proyecto-laravel.com.devel/';
window.addEventListener("load", function () {

	$('.btn-like,.btn-dislike').css('cursor', 'pointer');

	// Boton de like
	function like() {
		$('.btn-like').unbind('click');
		$('.btn-like').click(function () {
			$(this).removeClass('btn-like');
			$(this).addClass('btn-dislike');
			$(this).attr('src', url + 'img/redheart.png');

			$.ajax({
				url: url + '/like/' + $(this).data('id'),
				type: 'GET',
				success: function (response) {
					if (response.like) {
						console.log('has dado like a la publicacion');
					} else {
						console.log('Error al dar like');
					}
					console.log(response);
				}
			});

			dislike();
		});
	}
	like();

	// Boton de dislike
	function dislike() {
		$('.btn-dislike').unbind('click');
		$('.btn-dislike').click(function () {
			$(this).removeClass('btn-dislike');
			$(this).addClass('btn-like');
			$(this).attr('src', url + 'img/blackheart.png');

			$.ajax({
				url: url + '/dislike/' + $(this).data('id'),
				type: 'GET',
				success: function (response) {
					if (response.like) {
						console.log('has dado dislike a la publicacion');
					} else {
						console.log('Error al dar dislike');
					}
					console.log(response);
				}
			});

			like();
		});
	}
	dislike();

// Para el buscador
	$('#buscador').submit(function (e) {
		$(this).attr('action', url + 'gente/' + $('#buscador #search').val());
	});


});