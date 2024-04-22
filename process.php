<?php



/* * *********************************************
 * STEP 1: INPUT: Do NOT process, just get the data.
 * Do not delete this comment,
 * ********************************************** */
function main(){
    if (!empty($_POST['title']) && !empty($_POST['drink']) && !empty($_POST['pet']) && !empty($_POST['fictional']) && !empty($_POST['real']) && !empty($_POST['email'])) {

       
        /* * ******************************************************
         * STEP 2: VALIDATION: Always clean your input first!!!!
         * Do NOT process, only CLEAN and VALIDATE.
         * Do not delete this comment.
         * ****************************************************** */
        // clean up the variables (a little) by removing leading and trailing white space
        $title = trim($_POST['title']);
        $favDrink = trim($_POST['drink']);
        $petName = trim($_POST['pet']);
        $fictPlace = trim($_POST['fictional']);
        $realPlace = trim($_POST['real']);
        $email = trim($_POST['email']);

        // Sub string
        if(strlen($title) > 64){
            $title = substr($title, 0, 64);
        }
        if(strlen($favDrink) > 64){
            $favDrink = substr($favDrink, 0, 64);
        }
        if(strlen($petName) > 64){
            $petName = substr($petName, 0, 64);
        }
        if(strlen($fictPlace) > 64){
            $fictPlace = substr($fictPlace, 0, 64);
        }
        if(strlen($realPlace) > 64){
            $realPlace = substr($realPlace, 0, 64);
        }
        if(strlen($email) > 64){
            $email = substr($email, 0, 64);
        }

        // Strip tags
        $title = strip_tags($title);
        $favDrink = strip_tags($favDrink);
        $petName = strip_tags($petName);
        $fictPlace = strip_tags($fictPlace);
        $realPlace = strip_tags($realPlace);
        $email = strip_tags($email);


        // checks for sentence length
        $sentence = "You are " . $title . " " . $favDrink . " " . $petName . " of " . $fictPlace . " and " . $realPlace . ".";

        /************************************************************************/

        // Checks for inputs to output the correct page
        if (!empty($title) && !empty($favDrink) && !empty($petName) && !empty($fictPlace) && !empty($realPlace)) {
            /*     * *************************************************************************
             * STEP 3 and 4: PROCESSING and OUTPUT: Notice this code only executes
             * if you have valid data from steps 1 and 2. Your code must always have
             * a saftey feature similar to this.
             * Do not delete this comment.
             * ************************************************************************ */

            echo strlen($sentence);

        } else {
            echo "error";
        }
    }
}
main();

?>