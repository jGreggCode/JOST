$(document).ready(function(){
	
	// Listen to register button
	$('#activate').on('click', function(){
		activateAccount();
	});
	
});

function activateAccount() {
	var userDetailsUserEmail = $('#userDetailsUserEmail').val();
    var userDetailsUserPosition = $('#userDetailsUserPosition').val();
    var userDetailsUserStatus = $('#userDetailsUserStatus').val();


    $.ajax({
		url: '../../send.php',
		method: 'POST',
		data: {
			userDetailsUserEmail: userDetailsUserEmail, 
            userDetailsUserPosition: userDetailsUserPosition,
            userDetailsUserStatus: userDetailsUserStatus
		},
		success: function(data) {
			console.log('AJAX Response:', data); // Log the response
			$('#loginMessage').html(data);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.error('AJAX Error: ', textStatus, errorThrown); // Log any errors
		}
	});
}