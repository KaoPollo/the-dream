<?php
  $result = ""; // déclaration de la variable $result en tant que chaîne vide
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
    $exchange_rate = $exchange_rates[$exchange_rate_key];
  
    // Calculate result
    $result = $amount * $exchange_rate;
  }

  if(array_key_exists($exchange_rate_key, $exchange_rates)) {
	$exchange_rate = $exchange_rates[$exchange_rate_key];
	$result = $amount * $exchange_rate;
  }
  else {
	$result = "Invalid currency conversion.";
  }
?>

<form action="index.php" method="get">
        <label for="from_currency">From :</label>
        <select name="from_currency" id="from_currency">
          <option value="euro">Euro</option>
          <option value="dollar">Dollar</option>
          <option value="pound">Pound</option>
        </select>
      
        <label for="to_currency">To :</label>
        <select name="to_currency" id="to_currency">
          <option value="euro">Euro</option>
          <option value="dollar">Dollar</option>
          <option value="pound">Pound</option>
        </select>
      
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount">
      
        <input type="submit" value="Submit" name="submit">
        <h2>Result: <?php echo $result; ?></h2>
</form>

