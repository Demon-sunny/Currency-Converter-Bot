<?php

header('Content-Type: application/json');

function convertCurrency($amount, $fromCurrency, $toCurrency, $exchangeRates) {
    if ($amount <= 0) {
        return ['error' => "Invalid amount. Please enter a positive number."];
    }

    if ($fromCurrency === $toCurrency) {
        return ['convertedAmount' => number_format($amount, 2)];
    }

    // Direct conversion
    if (isset($exchangeRates["{$fromCurrency}_{$toCurrency}"])) {
        $convertedAmount = $amount * $exchangeRates["{$fromCurrency}_{$toCurrency}"];
        return ['convertedAmount' => number_format($convertedAmount, 2)];
    }

    // Reverse conversion
    if (isset($exchangeRates["{$toCurrency}_{$fromCurrency}"])) {
        $convertedAmount = $amount / $exchangeRates["{$toCurrency}_{$fromCurrency}"];
        return ['convertedAmount' => number_format($convertedAmount, 2)];
    }

    // Indirect conversion via USD
    if (isset($exchangeRates["{$fromCurrency}USD"]) && isset($exchangeRates["USD{$toCurrency}"])) {
        $convertedAmount = $amount * $exchangeRates["{$fromCurrency}USD"] * $exchangeRates["USD{$toCurrency}"];
        return ['convertedAmount' => number_format($convertedAmount, 2)];
    }

    return ['error' => "Conversion rate not found for $fromCurrency to $toCurrency."];
}

// Base exchange rates (Using USD as the pivot currency)
$usdRates = [
    'USD_INR' => 75.0, 'USD_EUR' => 0.88, 'USD_GBP' => 0.76, 'USD_JPY' => 110.0,
    'USD_CAD' => 1.25, 'USD_AUD' => 1.34, 'USD_CNY' => 6.5, 'USD_SGD' => 1.36
];

// Generate exchange rates dynamically
$exchangeRates = [];
foreach ($usdRates as $pair => $rate) {
    list($base, $quote) = explode('_', $pair);
    $exchangeRates[$pair] = $rate;
    $exchangeRates["{$quote}_{$base}"] = 1 / $rate; // Reverse rate
}

// Now generate cross rates dynamically (e.g., JPY to AUD via USD)
$currencies = array_keys(array_flip(array_merge(array_keys($usdRates), array_keys($exchangeRates))));
foreach ($currencies as $from) {
    foreach ($currencies as $to) {
        if ($from !== $to && !isset($exchangeRates["{$from}_{$to}"])) {
            if (isset($exchangeRates["{$from}USD"]) && isset($exchangeRates["USD{$to}"])) {
                $exchangeRates["{$from}{$to}"] = $exchangeRates["{$from}_USD"] * $exchangeRates["USD{$to}"];
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = isset($_POST['amount']) ? (float) $_POST['amount'] : 0;
    $fromCurrency = strtoupper(trim($_POST['from_currency'] ?? ''));
    $toCurrency = strtoupper(trim($_POST['to_currency'] ?? ''));

    if (!$amount || !$fromCurrency || !$toCurrency) {
        echo json_encode(['error' => 'Invalid input.']);
        exit;
    }

    echo json_encode(convertCurrency($amount, $fromCurrency, $toCurrency, $exchangeRates));
}

?>
