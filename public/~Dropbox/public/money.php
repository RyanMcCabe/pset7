<?php

    // configuration
    require("../includes/config.php"); 
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["money"] > 0)
        {    
            query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["money"], $_SESSION["id"]);
            redirect("/");
        }    
    
        else
            apologize("Please enter an positive amount of money");
    }
    else
        render("money_form.php", ["title" => "Money"]);
?>
