<?php


//this will load the mustache template library
require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// this will create a new mustache template engine
$mustache = new Mustache_Engine;

// these lines load your header, footer, and body template into strings
$header = file_get_contents('templates/header.html');
$body = file_get_contents('templates/contact.html');
$footer = file_get_contents('templates/footer.html');


// this will be used to send the page title into the page
// you can add more things to send if you like
$header_data = ["pagetitle" => "Contact"];

// notice this holds mixed numeric and string data,
// you can do this in a loosly typed language like PHP
// you can add more things to send if you like
$contact_data = [
    "formName" => "contact",
    "processFile" => "email.php",
    "formInputs" => [["name" => "main-name", "holder" => "Your Name"],
                     ["name" => "return-email", "holder" => "Return Email"],
                     ["name" => "reenter-email", "holder" => "Re-Enter Email"],
                     ["name" => "subject", "holder" => "Subject"]],
    "textarea" => "message"];

                                      


//this is being used to send a footer title and local time to the footer
// you can add more things to send if you like
$footer_data = [
    "localtime" => date('l jS \of F Y h:i:s A'),
    "footertitle" => "Incredible Sentence",
    "scripts" => [["pageScript" => "js/main.js"],
                  ["pageScript" => "js/contact.js"]]];



// Renders the templates
echo $mustache->render($header, $header_data) . PHP_EOL;
echo $mustache->render($body, $contact_data) . PHP_EOL;
echo $mustache->render($footer, $footer_data) . PHP_EOL;

?>