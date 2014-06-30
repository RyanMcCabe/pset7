<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["username"]) || empty($_POST["password"]))
            apologize("Please enter a username and password.");
                
        if($_POST["password"] != $_POST["confirmation"])
            apologize("Password and confirmation of password are not the same");
        
        if(query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000)", $_POST["username"], crypt($_POST["password"]))===false)
                {
                    apologzie("username already chosen please choose another.");
                }            
            else
            {
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                redirect("/");
            }
                    
    }
    else
    {
        //else render form
        render("register_form.php", ["title" => "Register"]);
    }
?>
