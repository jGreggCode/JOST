$(document).ready(function() {

    $('#itemDeleteBtn').on('click', function() {
        var itemID = $('#productID').text();
        if (itemID == 'No Item') {
            bootbox.alert("There is no Item selected!");
            exit();
        }

        bootbox.confirm('Are you sure you want to delete ' + '(IID: ' + itemID + ')', function(result){
			if(result){
				itemDelete();
			}
		});
    });

    $('#itemUpdateBtn').on('click', function() {
        var itemID = $('#productID').text();
        if (itemID == 'No Item') {
            bootbox.alert("There is no Item selected!");
            exit();
        }

        bootbox.confirm('Are you sure you want to update ' + '(IID: ' + itemID + ')', function(result){
			if(result){
				itemUpdate();
			}
		});
    });
});

function itemUpdate() {
    var itemDetailsItemProductID = $('#productID').text();
    var itemDetailsItemNumber = $('#itemDetailsItemNumber').val();
    var itemDetailsItemName = $('#itemDetailsItemName').val();
    var itemDetailsItemCategory = $('#itemDetailsItemCategory').val();
    var itemDetailsItemDescription = $('#itemDetailsItemDescription').val();
    var itemDetailsItemStock = $('#itemDetailsItemStock').val();
    var itemDetailsItemCosting = $('#itemDetailsItemCosting').val();
    var itemDetailsItemUnitPrice = $('#itemDetailsItemUnitPrice').val();

    $('#loadingMessage').fadeIn();

    $.ajax({
        url: '../../model/management/ManagementController.php',
        method: 'POST',
        data: {
            updateUsingProductID: itemDetailsItemProductID,
            updateUsingItemNumber: itemDetailsItemNumber,
            updateUsingItemName: itemDetailsItemName,
            updateUsingItemCategory: itemDetailsItemCategory,
            updateUsingItemDescription: itemDetailsItemDescription,
            updateUsingItemStock: itemDetailsItemStock,
            updateUsingItemCosting: itemDetailsItemCosting,
            updateUsingItemUnitPrice: itemDetailsItemUnitPrice
        },
        success: function(data) {
            console.log('AJAX Response: ', data);
            var result = JSON.parse(data);
            var message = result.message;
            var messageLog = $('#message');

            if (result.status === 'success') {
                messageLog.html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '</div>').fadeIn();
            } else if (result.status === 'warning') {
                messageLog.html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '</div>').fadeIn();
            } else if (result.status === 'error') {
                messageLog.html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '</div>').fadeIn();
            }

			setTimeout(function() {
                messageLog.fadeOut();
            }, 3000);
        },
        complete: function() {
            $('#loadingMessage').fadeOut();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('AJAX Error: ', textStatus, errorThrown);
        }
    });
}

function itemDelete() {
    var deleteUsingItemID = $('#productID').text();

    $('#loadingMessage').fadeIn();
    $.ajax({
        url: '../../model/management/ManagementController.php',
        method: 'POST',
        data: {
            deleteUsingItemID: deleteUsingItemID
        },
        success: function(data) {
            console.log('AJAX Response: ', data);
            var result = JSON.parse(data);
            var message = result.message;
            var messageLog = $('#message');

            if (result.status === 'success') {
                messageLog.html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '</div>').fadeIn();
            } else if (result.status === 'warning') {
                messageLog.html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '</div>').fadeIn();
            } else if (result.status === 'error') {
                messageLog.html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '</div>').fadeIn();
            }

			setTimeout(function() {
                messageLog.fadeOut();
            }, 3000);
        },
        complete: function() {
            $('#loadingMessage').fadeOut();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('AJAX Error: ', textStatus, errorThrown);
        }
    });
}