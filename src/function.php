<?php

//--------------------------------------------------------------
//
// REQUIRES of services/models
//
//--------------------------------------------------------------

require_once 'services/categories_service.php';
require_once 'services/users_service.php';
require_once 'services/articles_service.php';

require_once 'models/users.php';
require_once 'models/articles.php';

/**
 * This functions check if all variables after first parameters
 * are set in the array passed in the first parameter.
 *
 * Example : is_set_in($_POST, 'email', 'password')
 *  check if in $_POST there is a key email and password.
 *
 * @param 1st param is an array ($_POST, $_GET...)
 * @param String... then list of string separate with ','
 * @return bool
 */
function is_set_in()
{
    foreach (array_slice(func_get_args(), 1) as $v) {
        if (!isset(func_get_arg(0)[$v])) return false;
    }
    return true;
}

/**
 * Check if the email in first param is a valid email.
 *
 * @param $email
 * @return bool
 */
function is_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_url($img) {
    return filter_var($img, FILTER_VALIDATE_URL);
}
/**
 * @param $element to remove
 * @param $array aray
 * @return array
 */
function array_delete($element, $arr){
    $array = $arr;
    $index = array_search($element, $array);
    if($index !== false){
        unset($array[$index]);
    }
    return array_values($array);
}
//--------------------------------------------------------------
//
// ERRORS/SUCCESS handlers
// Short methods to flash message, getter delete the msg_* after
// usage. So only one time read.
//
// Use html_message() to render message. If you use location header
// create a custom variable like $can_disp_msg and set it to true by
// default, if you use the header location set it to false. Then when
// you use html_message() check if $can_disp_msg is true.
//
//--------------------------------------------------------------

function set_error_message($msg)
{
    $_SESSION['msg_err'] = $msg;
}

function has_error_message()
{
    return isset($_SESSION['msg_err']) && strlen($_SESSION['msg_err']) > 0;
}

function get_error_message()
{
    if (has_error_message()) {
        $msg = $_SESSION['msg_err'];
        $_SESSION['msg_err'] = NULL;
        return $msg;
    }
    return "";
}

function set_success_message($msg)
{
    $_SESSION['msg_success'] = $msg;
}

function has_success_message()
{
    return isset($_SESSION['msg_success']) && strlen($_SESSION['msg_success']) > 0;
}

function get_success_message()
{
    if (has_success_message()) {
        $msg = $_SESSION['msg_success'];
        $_SESSION['msg_success'] = NULL;
        return $msg;
    }
    return "";
}

function html_message()
{
    if (!isset(getallheaders()['Location'])) {
        if (has_error_message()) { ?> <h3>Error: <?php echo get_error_message() ?></h3> <?php }
        if (has_success_message()) { ?> <h3>Success: <?php echo get_success_message() ?></h3> <?php }
    }
}