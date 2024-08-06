jQuery("#register_submit").click(function(e){

	e.preventDefault(e);
	alert('Pressed');

	let formData = jQuery('#register').serializeArray();

	console.log(formData);

	// Ok Register pressed. Lets get all the data attached to the form;
	jQuery.ajax({
		url: "/signup",
		data: formData,
		dataType : "json",		
		
		success: function(result){
			// Check result, If within result is a failure then show errors on the front end with the error message.
			// Otherwise we'll redirect the user to the signup success page, logging the user 
			// var objData = JSON.parse(result)
			if(result.errors) {
				jQuery.each(result.errors, function(key, message) {
					// Find the input element by ID
					const inputElement = jQuery('#' + key);
					if (inputElement.length) {
						// Create a new span element to hold the error message
						const errorMessage = jQuery('<span></span>').text(message).css('color', 'red'); // Optional: style the error message
						
						// Insert the error message before the input element
						inputElement.after(errorMessage);
					}
				});
			} else {
				let strClubName = jQuery('#clubname').val();
				let currentUrl = window.location.href;
				let url = new URL(currentUrl);
				let hostnameParts = url.hostname.split('.');

				// Construct the new hostname
				if (hostnameParts.length > 2) {
					hostnameParts[0] = strClubName;
				} else {
					hostnameParts.unshift(strClubName);
				}

				url.hostname = hostnameParts.join('.');
				url.pathname = '/admin';

				// Convert the URL object back to a string
				let newUrl = url.toString();

				// Redirect to the new URL
				window.location.href = newUrl;
			}
	  		console.log(result);

		},
		error: function(result){
			console.log(result);
		}	
	});
});