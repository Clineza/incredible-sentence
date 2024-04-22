
"use strict";

function clearForm() {
    /*
     * this function replaces the text in text boxes with empty strings
     * and replaces the message area with an html <br>
     */
    document.getElementById("title").value = "";
    document.getElementById("drink").value = "";
    document.getElementById("pet").value = "";
    document.getElementById("fictional").value = "";
    document.getElementById("real").value = "";
    document.getElementById("email").value = "";
    
    document.getElementById("msg").innerHTML = "";
}

function sendData(){
    //bring the message area in to report errors or "Sent!"
    let msgArea = document.getElementById("msg");

    // creat an XMLHttpRequest object
    const XHR = new XMLHttpRequest();
    
    // bring the form in
    /* in this case notice I'm bringing the whole form in, but I could have also
     * just passed the fname and lname directly and sent those. the jQuery
     * version show that way of doing it, but you could do it here too.
     */
    let formData = new FormData(document.getElementById("title-form"));

    /*
     * this is an asynchronous listener. it will not execute until after
     * the server responds with a load event. It may not execute.
     */
    XHR.addEventListener('load', function (event) {
        if (XHR.responseText <= 30) {
            //console.log(XHR.responseText); // for debug
            // you have to clear the form here, not in the handler
            clearForm();
            msgArea.innerHTML = "That's a cute title!";
        } 
        else if(XHR.responseText > 30){
            //console.log(XHR.responseText);
            clearForm();
            msgArea.innerHTML = "That's a heck of a title!";
        }
        else {
            msgArea.innerHTML = "Sorry, your title was not processed.";
        }
    });

    /*
     * this is an asynchronous listener. it will not execute until after
     * the server responds with ae error event. It may not execute.
     */
    XHR.addEventListener('error', function (event) {
        if (XHR.statusText !== "OK") {
            msgArea.innerHTML = "Sorry, your title was not processed.";
        }
    });

    // this opens the connection and sends the form
    XHR.open('POST', 'process.php');
    XHR.send(formData);
    
    return;
}


function validate(){
    let errorMessage = "";
    
    let msgArea = document.getElementById("msg");
    
    //trims and puts back the inputs
    let titleInput = document.getElementById("title");
    let drinkInput = document.getElementById("drink");
    let petInput = document.getElementById("pet");
    let fictionalInput = document.getElementById("fictional");
    let realInput = document.getElementById("real");
    let emailInput = document.getElementById("email");
    
    let title = titleInput.value.trim();
    let drink = drinkInput.value.trim();
    let pet = petInput.value.trim();
    let fictional = fictionalInput.value.trim();
    let real = realInput.value.trim();
    let email = emailInput.value.trim();
    
    titleInput.value = title;
    drinkInput.value = drink;
    petInput.value = pet;
    fictionalInput.value = fictional;
    realInput.value = real;
    emailInput.value = email;
    
    //Checks for empty input boxes
    if (title === "") {
        errorMessage += "Title cannot be empty.<br>";
    }
    if (drink === "") {
        errorMessage += "Favorite Drink cannot be empty.<br>";
    }
    if (pet === "") {
        errorMessage += "Pet's Name cannot be empty.<br>";
    }
    if (fictional === "") {
        errorMessage += "Favorite Fictional Place cannot be empty.<br>";
    }
    if (real === "") {
        errorMessage += "Favorite Real Place cannot be empty.<br>";
    }
    if (email === "") {
        errorMessage += "Email Address cannot be empty.<br>";
    }
    
    if(fictional !== "" && real !== ""){
        if(fictional === real){
            errorMessage += "Fictional Place and Real Place cannot be the same.<br>";
        }
    }
    
    if(email !== "" && validEmail(email) === false){
        errorMessage += "Email address is not valid.<br>";
    }
    
    if(errorMessage === ""){
        // checks for empty message and sends data
        //console.log("calling ajax");
        sendData();
    }
    else{
        // report errors
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
       // validate form and get back error messages (if any)
        validate();
    });
    
});
