<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup($_POST["symbol"]);
        if($stock === false)
            apologize("That stock doesn't exist please try again");
        
        else
            render("quote.php", ["stock" => $stock, "title" => "Stock Quote"]);
    }
    else
    {    
        render("quote_form.php", ["title" => "quote"]);
    }
?>
