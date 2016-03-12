$('.autoajax').change( function() {
	var data_vals = $(this).data();
	if (
		(!(data_vals['autoajaxUrl'] === undefined))
	) {
		// We have a destination
		var dest = data_vals['autoajaxUrl'];
		var postFieldsString = data_vals['autoajaxPostFields'];
		var postFields = postFieldsString.split(',');
		var postVars = new Object();
		for (var i=0; i<postFields.length; i++) {
			var ele = $('#'+postFields[i]);
			postVars[postFields[i]] = ele.val();
		}
		$.post(dest, postVars, function(data) {
			// Process return
			var returnVars = $.parseJSON(data);
			if (returnVars['DOM'] !== undefined) {
				var domVars = returnVars['DOM'];
				for(var DOMaction in domVars) {
					switch (DOMaction) {
						case 'set_value':
							//alert(DOMaction);
							for (var ele_id in domVars[DOMaction]) {
								//alert(ele_id + ' => ' + domVars[DOMaction][ele_id]);
								$('#'+ele_id).val(domVars[DOMaction][ele_id]);
							}
							break;
						case 'set_html':
							//alert(DOMaction);
							for (var ele_id in domVars[DOMaction]) {
								$('#'+ele_id).html(domVars[DOMaction][ele_id]);
							}
							break;
						case 'set_attr':
							//alert(DOMaction);
							for (var ele_id in domVars[DOMaction]) {
								//alert(ele_id);
								for (var ele_attr in domVars[DOMaction][ele_id]) {
									//alert(ele_id+'.'+ele_attr + ' => ' + domVars[DOMaction][ele_id][ele_attr]);
									$('#'+ele_id).attr(ele_attr, domVars[DOMaction][ele_id][ele_attr]);
								}							
							}
							break;
						default:
							alert('Unknown DOMaction '+DOMaction);
							break;
					}
				}
			}			
			//alert(data);
			
		});
	}
});