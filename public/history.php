<?php

    // configuration
    require("../includes/config.php"); 

    // render portfolio
    $id = $_SESSION["id"];
    
    $positions = query("SELECT transaction, symbol, shares, price, time FROM History WHERE id = ?", $id);
    
    if($positions !== false)
    {        
        render("history.php", ["positions" => $positions, "title" => "Portfolio"]);
    }
    else
        render("portfolio.php", ["cash" => $cash, "title" => "Portfolio"]);  
    

?>
