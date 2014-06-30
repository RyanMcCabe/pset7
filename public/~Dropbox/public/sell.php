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
        {            
            $shares = query("SELECT shares FROM stocks WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
            if(!$shares)
                apologize("You don't own that stock.");
            
            else
            {
                $shares = $shares[0]["shares"];
                $profit = $shares * $stock["price"];
                query("DELETE FROM stocks WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
                query("UPDATE users SET cash = cash + ? WHERE id = ?", $profit, $_SESSION["id"]);
                $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
                query("INSERT INTO History (transaction, symbol, id, shares, time, price) VALUES ('Sell', ?, ?, ?, now(), ?)", $_POST["symbol"], $_SESSION["id"], $shares, $stock["price"]);
                redirect("/");
            }
        }
    }    
    else
        render("sell_form.php", ["title" => "Sell"]); 
?>
