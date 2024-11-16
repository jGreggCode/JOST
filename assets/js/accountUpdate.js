$(document).ready(function() {

    $('#deleteBtn').on('click', function() {
        // Call submitDelete function
        var accountID = $('#userID').text();
        if (accountID == 'No user') {
            bootbox.alert("There is no user selected!");
            exit();
        }

        bootbox.confirm('Are you sure you want to delete ' + '(UID: ' + accountID + ')', function(result){
			if(result){
				submitDelete();
			}
		});
    });

    $('#activateBtn').on('click', function() {
        // Call submitDelete function
        var accountID = $('#userID').text();
        if (accountID == 'No user') {
            bootbox.alert("There is no user selected!");
            exit();
        }

        bootbox.confirm('Are you sure you want to activate ' + '(UID: ' + accountID + ')', function(result){
			if(result){
				submitActivate();
			}
		});
    });

});

// Delete the account
function submitDelete() {
    var deleteAccountID = $('#userID').text();

    $.ajax({
        url: '../../model/accounts/AccountManagerController.php',
        method: 'POST',
        data: {
            deleteUsingAccountID: deleteAccountID
        },
        success: function(data) {
            console.log('AJAX Response: ', data);
            var result = JSON.parse(data);

            $('#userDetailsUserStatus').empty();
			$('#userDetailsUserPosition').empty();
			$('#userID').text('No user');
			$('#userDetailsUserFullName').val('');
			$('#userDetailsUserUsername').val('');
			$('#userDetailsUserEmail').val('');
			$('#userDetailsUserMobile').val('');
			$('#userDetailsUserLocation').val('');

            $('#message').html(result.message).fadeIn();
			setTimeout(function() {
                $('#message').fadeOut();
            }, 3000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('AJAX Error: ', textStatus, errorThrown);
        }
    });
}

// Activate the account and sending Activation Email
function submitActivate() {
    var activateAccountEmail = $('#userDetailsUserEmail').val();
    var activateAccountType = $('#userDetailsUserPosition').val();
    var activateAccountStatus = $('#userDetailsUserStatus').val();

    $.ajax({
        url: '../../model/accounts/AccountManagerController.php',
        method: 'POST',
        data: {
            activateAccountEmail: activateAccountEmail,
            activateAccountType: activateAccountType,
            activateAccountStatus: activateAccountStatus,
        },
        success: function(data) {
            console.log('AJAX Response: ', data);
            var result = JSON.parse(data);

            $('#message').html(result.message).fadeIn();
			setTimeout(function() {
                $('#message').fadeOut();
            }, 3000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('AJAX Error: ', textStatus, errorThrown);
        }
    });
}

