<?php

require_once 'inc/MCAPI.class.php';
require_once 'inc/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);



// Your List Unique ID: http://admin.mailchimp.com/lists/ (Click "settings")
$list_id = "YourListIDHere";
$email = $_POST['newsletter-email'];

if(isset($_POST['newsletter-firstname']) || isset($_POST['newsletter-lastname'])){

$firstname = (isset($_POST['newsletter-firstname']))?$_POST['newsletter-firstname']:'';
$lastename = (isset($_POST['newsletter-lastname']))?$_POST['newsletter-lastname']:'';

$merge_vars = array(
    'FNAME'=>$firstname, 
    'LNAME'=>$lastename
);

}else{
    $merge_vars = array();
}
// By default this sends a confirmation email - you will not see new members
// until the link contained in it is clicked!
$retval = $api->listSubscribe( $listId, $email, $merge_vars );

if ($api->errorCode){
    echo '<div class="alert alert-error">';
    echo '<a class="close" data-dismiss="alert" href="#">&times;</a>';
    //echo "Unable to load listSubscribe()!\n";
    //echo "\tCode=".$api->errorCode."\n";
    //echo "\tMsg=".$api->errorMessage."\n";
    echo "\t".$api->errorMessage."\n"; 
    echo '</div>';

} else {
    echo '<div class="alert alert-success">';
    echo '<a class="close" data-dismiss="alert" href="#">&times;</a>';
    echo "Success! Check your email to confirm sign up.";
    echo '</div>';
}

?>
