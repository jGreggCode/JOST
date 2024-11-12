<?php 

function redirectToLoginWithError($errorMessage) {
    // URL encode the message to make it safe for use in a URL parameter
    $encodedMessage = urlencode($errorMessage);
    header("Location: ../../index.php?error=$encodedMessage");
    exit();
}

function category($category) {
    // URL encode the message to make it safe for use in a URL parameter
    $encodedMessage = urlencode($category);
    $current_url = $_SERVER['PHP_SELF'];
    $redirect_url = $current_url . "?category=$encodedMessage";
    header("Location: $redirect_url");
    exit();
}