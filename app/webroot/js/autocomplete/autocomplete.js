/* stripHTML function to tidy item HTML before inserting into input box */
function stripHTML(dirtyString) {
  return $("<div/>").html(dirtyString).text();
}

/* Manages auto-completes */
$(document).ready( function() {
	$('.autocomplete').each( function() {
		// Retrieve all data-autocomplete- values to pass to the function
		var data_vals = $(this).data();
		var options = new Object();
		for (var k in data_vals) {
			if (k.slice(0,12) == 'autocomplete') {
				var new_k = k.slice(12).toLowerCase();
				var val = data_vals[k];
				if ((typeof val == 'string') && (val.trim().slice(0,9) == 'function ')) {
					eval("options."+new_k+" = " + val.trim());
				} else {
					options[new_k] = val;
				}
			}
		}
		$(this).autocomplete( options ).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( "<a>"+ item.label + "</a>" ) 
                .appendTo( ul );
        };;
	} );
});