

"use strict";

function clearForm() {
    /*
     * this function replaces the text in text boxes with empty strings
     * and replaces the message area with an html <br>
     */
    $('.form-inputs').val('');
    $('#msg').html(''); // minor violation of concerns, but okay for now
}


function sendData(name, firEmail, secEmail, subject, message) {
    /* notice in this version I'm sending the strings in as parameters, but I
     * could have also skipped that and used the whole form like in the
     * raw JS version. You can do either method in either way.
     */

    //bring the message area in to report errors or "Sent!"
    let msgArea = document.getElementById("msg");

    $.ajax({
        url: 'email.php',
        type: 'POST',
        data: {name: name, firEmail: firEmail, secEmail: secEmail, subject: subject, message: message},
        success: function (val) {
            //console.log(val);
            if (val === 'okay') {
                clearForm();
                msgArea.innerHTML = "Your message was sent";
            } else {
                msgArea.innerHTML = "Sorry, your email was not sent";
            }
        },
        error: function () {
            msgArea.innerHTML = "Sorry, your email was not sent";
        }
    });

    return;
}

function validate(){
    var errorMessage = "";
    
    //bring the message area in to report errors
    let msgArea = document.getElementById("msg");
    
    //trims and puts back the inputs
    var name = $('#main-name').val().trim();
    var firEmail = $('#return-email').val().trim();
    var secEmail = $('#reenter-email').val().trim();
    var subject = $('#subject').val().trim();
    var message = $('#message').val().trim();
    
    $('#main-name').val(name);
    $('#return-email').val(firEmail);
    $('#reenter-email').val(secEmail);
    $('#subject').val(subject);
    $('#message').val(message);
    
    //Checks for empty input boxes
    if (name === "") {
        errorMessage += "Your Name cannot be empty.<br>";
    }
    if (firEmail === "") {
        errorMessage += "Return Email cannot be empty.<br>";
    }
    if (secEmail === "") {
        errorMessage += "Re-Enter Email cannot be empty.<br>";
    }
    if (subject === "") {
        errorMessage += "Subject cannot be empty.<br>";
    }
    if (message === "") {
        errorMessage += "Message cannot be empty.<br>";
    }
    
    //Checks if both emails are the same and checks for valid email
    if(firEmail !== "" && secEmail !== ""){
        if(firEmail !== secEmail){
            errorMessage += "Return Email and Re-Enter Email are not the same.<br>";
        }
        
        if(validEmail(firEmail) === false){ //checks for valid email
            errorMessage += "Emails are not valid.";
        }
    }
    
    if (errorMessage === ""){
        //console.log("calling ajax");
        sendData(name, firEmail, secEmail, subject, message);
    }
    else{
        //console.log("errors");
        msgArea.innerHTML = errorMessage;
    }
    
    return;
}

/*
 * This is the jQuery docready method. It automatically executes when the DOM
 * is ready. You should always put handlers and other auto-executed code in
 * a docready function. It protects you from "race-conditions" when the JS
 * tries to execute before the DOM is complete.
 */
$(document).ready(function () {
    
    // event handler for the clear button
    $("#clear-btn").click(function () {
        clearForm();
    });

    // event handler for the send button
    $("#send-btn").click(function () {
       // only need to call validate. validate will call sendData
       validate();
    });
});
