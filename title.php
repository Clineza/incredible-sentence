<?php


//this will load the mustache template library
require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// this will create a new mustache template engine
$mustache = new Mustache_Engine;

// these lines load your header, footer, and body template into strings
$header = file_get_contents('templates/header.html');
$body = file_get_contents('templates/form.html');
$footer = file_get_contents('templates/footer.html');

/*
 * the following three lines of code set up your PAGE SPECIFIC variables
 * these will be different page to page. page specific data is loaded into
 * an associative array where the key is used by Mustache as a {{variable}}
 * and the value is inserted into the page (see the template examples).
 */

// this will be used to send the page title into the page
// you can add more things to send if you like
$header_data = ["pagetitle" => "Generate Sentence"];

// notice this holds mixed numeric and string data,
// you can do this in a loosly typed language like PHP
// you can add more things to send if you like
$form_data = [
    "formName" => "title",
    "processFile" => "process.php",
    "formInputs" => [["name" => "title", "holder" => "Title"],
                     ["name" => "drink", "holder" => "Favorite Drink"],
                     ["name" => "pet", "holder" => "Pet's Name"],
                     ["name" => "fictional", "holder" => "Favorite Fictional Place"],
                     ["name" => "real", "holder" => "Favorite Real Place"],
                     ["name" => "email", "holder" => "Email Address"]]];

                                      


//this is being used to send a footer title and local time to the footer
// you can add more things to send if you like
$footer_data = [
    "localtime" => date('l jS \of F Y h:i:s A'),
    "footertitle" => "Incredible Sentence",
    "scripts" => [["pageScript" => "js/main.js"],
                  ["pageScript" => "js/title.js"]]];

/*
 * this combines the variables with the templates and creates a complete web page.
 * each page can now have the same header and footer style with different variables
 * such as page title. in this way we can use a sigle header and footer template
 * for all pages, and only worry about changing the body from page to page.
 */
echo $mustache->render($header, $header_data) . PHP_EOL;
echo $mustache->render($body, $form_data) . PHP_EOL;
echo $mustache->render($footer, $footer_data) . PHP_EOL;
?>