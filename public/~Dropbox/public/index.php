<?php

    // configuration
    require("../includes/config.php"); 

    
    // render portfolio
    $id = $_SESSION["id"];
    $cash = query("SELECT id, cash FROM users WHERE id = ?", $id);
    
    $rows = query("SELECT symbol, shares FROM stocks WHERE id = ?", $id);
    
    if($rows !== false)
    {
        $positions = [];
        foreach($rows as $row)    
        {
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                $positions[] = [
                    "name" => $stock["name"],
                    "price" => $stock["price"],
                    "shares" => $row["shares"],
                    "symbol" => $row["symbol"]
                ];
            }
        }
        render("portfolio.php", ["cash" => $cash, "positions" => $positions, "title" => "Portfolio"]);
    }
    else
        render("portfolio.php", ["cash" => $cash, "title" => "Portfolio"]);  
?>  
<div>
    <a href="buy.php">Buy</a>
</div>    
<div>
    <a href="history.php">History</a>
</div>
<div>
    <a href="sell.php">Sell</a>
</div>
<div>
    <a href="money.php">Add Funds</a>
</div>
<div>
    <a href="quote.php">Quote</a>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>

