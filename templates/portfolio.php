<table>
    <tr>
        <td>symbol </td>
        <td>shares </td>
        <td>price</td>
        <td>total</td>
    <br/>
    </tr>
<br/>

<?php foreach($positions as $positions): ?>

    <tr>
        <td><?= $positions["symbol"]?> </td>
        <td><?= $positions["shares"]?> </td>
        <td>$<?= $positions["price"]?> </td>
        <td>$<?= $positions["shares"] * $positions["price"]?></td>
    <br/>
    </tr>        
    <? endforeach ?>
</table>
<div>
    Cash on hand is:  $<?= number_format($cash[0]["cash"],2)?>
</div>
<div>
    <a href="logout.php">Log Out</a>
</div>
