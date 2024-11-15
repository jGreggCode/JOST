$(document).ready(function(){
	
	// Listen to register button
	$('#register').on('click', function(){
		register();
	});
	
	// Listen to reset password button
	$('#resetPasswordButton').on('click', function(){
		resetPassword();
	});
	
	// Listen to login button
	$('#login').on('click', function(){
		login();
	});

	// Listen to Forgotpass button
	$('#forgotpass').on('click', function(){
		forgotPass();
	});

	$('#changePassBtn').on('click', function(){
		changePass();
	});
});

function changePass() {
	var userDetailsUserPassword1 = $('#userDetailsUserPassword1').val();
	var userDetailsUserPassword2 = $('#userDetailsUserPassword2').val();
	var userDetailsUserID = $('#userID').text();

	console.log(userDetailsUserPassword1);
	console.log(userDetailsUserPassword2);
	console.log(userDetailsUserID);

	$.ajax({
		url: '../model/login/resetPassword.php',
		method: 'POST',
		data: {
			changePassword1: userDetailsUserPassword1,
			changePassword2: userDetailsUserPassword2,
			changePassUserDetailsUserID: userDetailsUserID
		},
		success: function(data) {
			console.log('AJAX Response:', data); // Log the response
			// Check for a success message from the server
            if (data.includes("Password reset complete")) {
                // Replace form with a success message
                $('form').html(`
                    <div class="alert alert-success">
                        Password Changed Successfully! You can now Sign In using your new password.
                    </div>
					<br>
					<div class="text-center">
						<a style="padding: .5rem 2rem; text-transform: uppercase" href="../index.php" class="btn btn-theme">Sign In</a>
					</div>
                `);
            } else {
                // Display error messages
                $('#changePass').html(data).fadeIn();
                setTimeout(function() {
                    $('#changePass').fadeOut();
                }, 2000);
            }
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.error('AJAX Error: ', textStatus, errorThrown); // Log any errors
		}
	});
}

// Function to register a new user
function register(){
	var registerFullName = $('#registerFullName').val();
	var registerUsername = $('#registerUsername').val();
	var registerUserType = $('#registerUserType').val();
	var registerEmail = $('#registerEmail').val();
	var registerPhoneNo = $('#registerPhoneNo').val();
	var registerPassword1 = $('#registerPassword1').val();
	var registerPassword2 = $('#registerPassword2').val();
	
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
			$('#registerMessage').html(data).fadeIn();
			setTimeout(function() {
                $('#registerMessage').fadeOut();
            }, 2000);
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
			$('#loginMessage').html(data).fadeIn();
			setTimeout(function() {
                $('#loginMessage').fadeOut();
            }, 2000);
			if(data.indexOf('Login Success') >= 0){
				window.location = 'dashboard.php';
			}
		}
	});
}

function forgotPass(){
	var loginUsername = $('#loginUsername').val();
	
	$.ajax({
		url: 'model/login/forgotPass.php',
		method: 'POST',
		data: {
			forgotPass:loginUsername,
		},
		success: function(data){
			$('#loginMessage').html(data).fadeIn();
			setTimeout(function() {
                $('#loginMessage').fadeOut();
            }, 3000);
		}
	});
}