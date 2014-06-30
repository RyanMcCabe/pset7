<?php

    // configuration
    require("../includes/config.php"); 
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup($_POST["symbol"]);
        if($stock === false)
            apologize("That stock doesn't exist please try again");
    
        else if(preg_match("/^\d+$/", $_POST["shares"]) == false)
            apologize("Please enter a positive whole number of shares to buy.");
            
        else 
        {            
            $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            $cost = $_POST["shares"] * $stock["price"];
            if($cash[0]["cash"] < $cost)
                apologize("That costs more than you have.");
            
            else
            {
                if(query("INSERT INTO stocks (id, shares, symbol) VALUES (?, ?, ?)", $_SESSION["id"], $_POST["shares"], strtoupper($_POST["symbol"]))===false)
                    query("UPDATE stocks SET shares = shares + ? WHERE id = ?", $_POST["shares"], $_SESSION["id"]); 
                
                query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
                query("INSERT INTO History (transaction, symbol, id, shares, time, price) VALUES ('Buy', ?, ?, ?, now(), ?)", strtoupper($_POST["symbol"]), $_SESSION["id"], $_POST["shares"], $stock["price"]);
                redirect("/");
            }
        }
    }    
    else
        render("buy_form.php", ["title" => "BUY"]); 
?>
