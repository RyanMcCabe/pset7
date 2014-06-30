<table>
    <tr>
        <td>transaction type </td>
        <td>symbol </td>
        <td>shares</td>
        <td>price</td>
        <td>time</td>
    <br/>
    </tr>
    <br/>

    <?php foreach($positions as $positions): ?>
    <tr>
        <td><?= $positions["transaction"]?> </td>
        <td><?= $positions["symbol"]?> </td>
        <td><?= $positions["shares"]?> </td>
        <td>$<?= $positions["price"]?></td>
        <td><?= $positions["time"]?></td>
    <br/>
    </tr>   
    <? endforeach ?>
</table>
<div>
    <a href="logout.php">Log Out</a>
</div>
