<?php
require_once "config.php";

$fprice = $priceerr = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fprice = htmlspecialchars($_POST['price']);
    if(empty($fprice)) $priceerr = "&nbsp;&nbsp;Please enter a valid price";
    else $price = floatval($fprice);
}
?>

<html>

<body>
    <h1>Manage Shipping Methods:</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Method: <select name="method">
            <option> Select a method</option>
            <?php
            $query = "SELECT * FROM ShippingMethods";
            $result = mysqli_query($dbConnect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = $result == $row['method'] ? "selected" : "";
                echo "<option {$selected} value = \"{$row['method']}\">{$row['method']} {$row['price']} </option>\n";
            }
            mysqli_free_result($result);
            ?>
            <br><br>
        Update Price:<select name="Price"> <input type="number" name="price" size="8" min="0.01" max="10000.00" step="0.01" value=<?php echo $fprice ?>><?php echo $priceerr?><br><br>
            <?php
            $query = "UPDATE ShippingMethods SET price = $fprice WHERE method = $selected";
            $result = mysqli_query($dbConnect, $query);
            mysqli_free_result($result);
            ?>
            
