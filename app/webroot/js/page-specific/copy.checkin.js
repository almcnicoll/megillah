/*$(document).ready( function() {
	$('.check-number').keyup( function() {
		var check = $(this);
		var book = $(this).closest('.row').find('.book-number');
		if ( ((''+book.val()).length > 2) && ((''+check.val()).length > 2) ) {
			$.get('/megillah/copies/lookup?legacy_book_number='+book.val()+'&legacy_check_number='+check.val(), function(response) {
				//alert('Success:' + success.toString());
				var data = JSON.parse(response);
				if ((data.length > 0) && (data[0].Book !== undefined)) {
					alert(data[0].Book.title);
				}
			})
		}
	} );
});*/