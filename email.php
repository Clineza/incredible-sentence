<?php


//this will load the mustache template library
/*require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();*/

function main() {
    /* This will test to make sure we have a non-empty $_POST from
     * the form submission. */
    if (!empty($_POST['name']) && !empty($_POST['firEmail']) && !empty($_POST['secEmail']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
    
        //Checks for valid email
        $from = "";
        if($_POST['firEmail'] === $_POST['secEmail']){
            if(filter_var($_POST['firEmail'], FILTER_VALIDATE_EMAIL)){
                $from = $_POST['secEmail'];
            }
        }
        
        // Cleaning the variables
        $name = trim($_POST['name']); 
        $subject = trim($_POST['subject']);
        $message = trim($_POST['message']);
        
        // Sub string
        if(strlen($name) > 64){
            $name = substr($name, 0, 64);
        }
        if(strlen($subject) > 64){
            $subject = substr($subject, 0, 64);
        }
        if(strlen($message) > 1000){
            $message = substr($message, 0, 1000);
        }
        
        // Strip tags
        $name = strip_tags($name);
        $subject = strip_tags($subject);
        $message = strip_tags($message);

        /* The cleaning routines above may leave any variable empty. If we
         * find an empty variable, we stop processing because that means
         * someone tried to send us something malicious and/or incorrect. */
        if (!empty($name) && !empty($from) && !empty($subject) && !empty($message)) {

            /* this forms the correct email headers to send an email */
            $headers = "From: $from\r\n";
            $headers .= "Reply-To: $from\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

            /* Now attempt to send the email. This uses a REAL email function
             * and will send an email. Make sure you only sned it to yourself.
             * server, you would use just "mail" instead of "mymail" and
             * it will be sent normally. Read about the PHP mail() function
             * https://www.php.net/manual/en/function.mail.php
             * then it's up to you to fill out the paramters correctly.
             */
            if (mail('christof.cline@g.austincc.edu', $subject, $message, $headers)) {
                echo "okay";
            } else {
                echo "error";
            }
        } else {
            // this will be sent back to the calling function on the client
            echo "error";
        }
    }
}


main();
//successpage();


// this kicks off the script

?>
