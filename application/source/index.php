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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>TheDream</title>
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        Currency Converter
      </div>
      <div class="card-body">
        <form action="./index.php" method="get">
          <div class="form-group">
            <label for="from_currency">From :</label>
            <select class="form-control" name="from_currency" id="from_currency">
              <option value="euro" <?php if ($_GET['from_currency'] == "euro") echo "selected"; ?>>Euro</option>
              <option value="dollar" <?php if ($_GET['from_currency'] == "dollar") echo "selected"; ?>>Dollar</option>
              <option value="pound" <?php if ($_GET['from_currency'] == "pound") echo "selected"; ?>>Pound</option>
            </select>
          </div>

          <div class="form-group">
              <input type="submit" value="Switch" name="switch" class="btn btn-secondary">
          </div>

          <div class="form-group">
            <label for="to_currency">To :</label>
            <select class="form-control" name="to_currency" id="to_currency">
              <option value="euro" <?php if ($_GET['to_currency'] == "euro") echo "selected"; ?>>Euro</option>
              <option value="dollar" <?php if ($_GET['to_currency'] == "dollar") echo "selected"; ?>>Dollar</option>
              <option value="pound" <?php if ($_GET['to_currency'] == "pound") echo "selected"; ?>>Pound</option>
            </select>
          </div>
          <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" class="form-control" name="amount" id="amount" value="<?php if (isset($_GET['amount'])) echo $_GET['amount']; ?>">
          </div>
          <div class="form-group">
                        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
                <h2 class="text-center">Result: <?php echo $result; ?></h2>
</body>
</html>

