<?php
  $result = "";
  if(isset($_GET['submit'])) {
    $from_currency = $_GET['from_currency'];
    $to_currency = $_GET['to_currency'];
    $amount = floatval($_GET['amount']);
  
    // Define exchange rates
    $exchange_rates = [
      'euro_dollar' => 1.2,
      'euro_pound' => 0.9,
      'dollar_euro' => 0.83,
      'dollar_pound' => 0.75,
      'pound_euro' => 1.1,
      'pound_dollar' => 1.33
    ];
  
    // Determine exchange rate based on from and to currencies
    $exchange_rate_key = $from_currency . '_' . $to_currency;
    
    if(array_key_exists($exchange_rate_key, $exchange_rates)) {
      $exchange_rate = $exchange_rates[$exchange_rate_key];
      $result = $amount * $exchange_rate;
    }
    else {
      $result = "Invalid currency conversion.";
    }
  }

  if (isset($_GET['switch'])) {
	$tmp = $_GET['from_currency'];
	$_GET['from_currency'] = $_GET['to_currency'];
	$_GET['to_currency'] = $tmp;
  }
  
?>


<form action="index.php" method="get">
  <label for="from_currency">From :</label>
  <select name="from_currency" id="from_currency">
    <option value="euro" <?php if ($_GET['from_currency'] == "euro") echo "selected"; ?>>Euro</option>
    <option value="dollar" <?php if ($_GET['from_currency'] == "dollar") echo "selected"; ?>>Dollar</option>
    <option value="pound" <?php if ($_GET['from_currency'] == "pound") echo "selected"; ?>>Pound</option>
  </select>

  <label for="to_currency">To :</label>
  <select name="to_currency" id="to_currency">
    <option value="euro" <?php if ($_GET['to_currency'] == "euro") echo "selected"; ?>>Euro</option>
    <option value="dollar" <?php if ($_GET['to_currency'] == "dollar") echo "selected"; ?>>Dollar</option>
    <option value="pound" <?php if ($_GET['to_currency'] == "pound") echo "selected"; ?>>Pound</option>
  </select>

  <label for="amount">Amount:</label>
  <input type="text" name="amount" id="amount" value="<?php if (isset($_GET['amount'])) echo $_GET['amount']; ?>">

  <input type="submit" value="Submit" name="submit">
  <input type="submit" value="Switch" name="switch">
  <h2>Result: <?php echo $result; ?></h2>
</form>
