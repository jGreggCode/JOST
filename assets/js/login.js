$(document).ready(function(){
	
	// Listen to register button
	$('#register').on('click', function(){
		register();
		sendRegisterEmail();
	});
	
	// Listen to reset password button
	$('#resetPasswordButton').on('click', function(){
		resetPassword();
	});
	
	// Listen to login button
	$('#login').on('click', function(){
		login();
	});
});


// Function to register a new user
function register(){
	var registerFullName = $('#registerFullName').val();
	var registerUsername = $('#registerUsername').val();
	var registerUserType = $('#registerUserType').val();
	var registerEmail = $('#registerEmail').val();
	var registerPhoneNo = $('#registerPhoneNo').val();
	var registerPassword1 = $('#registerPassword1').val();
	var registerPassword2 = $('#registerPassword2').val();

	console.log('User Type:', registerUserType);
	
	$.ajax({
		url: 'model/login/register.php',
		method: 'POST',
		data: {
			registerFullName: registerFullName,
			registerUsername: registerUsername,
			registerUserType: registerUserType, 
			registerEmail: registerEmail, 
			registerPhoneNo: registerPhoneNo,
			registerPassword1: registerPassword1,
			registerPassword2: registerPassword2,
		},
		success: function(data) {
			console.log('AJAX Response:', data); // Log the response
			$('#registerMessage').html(data);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.error('AJAX Error: ', textStatus, errorThrown); // Log any errors
		}
	});
}

function sendRegisterEmail() {
	var registerUserType = $('#registerUserType').val();
	var registerEmail = $('#registerEmail').val();

	$.ajax({
		url: 'send.php',
		method: 'POST',
		data: {
			registerUserType: registerUserType, 
			registerEmail: registerEmail, 
		},
		success: function(data) {
			console.log('AJAX Response:', data); // Log the response
			$('#registerMessage').html(data);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.error('AJAX Error: ', textStatus, errorThrown); // Log any errors
		}
	});
}


// Function to reset password
function resetPassword(){
	var resetPasswordUsername = $('#resetPasswordUsername').val();
	var resetPasswordPassword1 = $('#resetPasswordPassword1').val();
	var resetPasswordPassword2 = $('#resetPasswordPassword2').val();
	
	$.ajax({
		url: 'model/login/resetPassword.php',
		method: 'POST',
		data: {
			resetPasswordUsername:resetPasswordUsername,
			resetPasswordPassword1:resetPasswordPassword1,
			resetPasswordPassword2:resetPasswordPassword2,
		},
		success: function(data){
			$('#resetPasswordMessage').html(data);
		}
	});
}


// Function to login a user
function login(){
	var loginUsername = $('#loginUsername').val();
	var loginPassword = $('#loginPassword').val();
	
	$.ajax({
		url: 'model/login/checkLogin.php',
		method: 'POST',
		data: {
			loginUsername:loginUsername,
			loginPassword:loginPassword,
		},
		success: function(data){
			$('#loginMessage').html(data);
			
		}
	});
}