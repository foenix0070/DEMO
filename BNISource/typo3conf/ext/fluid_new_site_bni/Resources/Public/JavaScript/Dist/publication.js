

$('document').ready(function(){

	/****************** Publication Show and Download *******************/
	

		$('.bni_publication-card').click(function(e) {
			e.preventDefault();
			var imageTo = $(this).data("imglink");
			var fileTo = $(this).attr("href");
			var nameFileTo = $(this).attr("alt");


			var downloadLink = '';
			if (fileTo) {
				downloadLink = '<a href="' + fileTo + '" class="download position-absolute" target="_blank" download="'+nameFileTo+'"><div class="mfp-content-download position-absolute right-0 d-flex justify-content-end py-3 px-4"><span class="mfp-content-icon position-relative p-3 rounded shadow"><i class="fa-solid fa-file-arrow-down fa-2x text-white"></i></span></div></a>';
			}
			$.magnificPopup.open({
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				fixedContentPos: true,
				mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300
				},
				items: {
					src: '<img src="' + imageTo + '"/>'+ downloadLink ,
					type: 'inline'
				}
			});
		});

	

});