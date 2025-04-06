<?php

header('Content-Type: application/json');

function convertCurrency($amount, $fromCurrency, $toCurrency, $exchangeRates) {
    if ($amount < 0) {
        return ['error' => "Invalid amount. Please enter a positive number."];
    }

    if ($fromCurrency === $toCurrency) {
        return ['convertedAmount' => number_format($amount, 2)];
    }

    $conversionKey1 = $fromCurrency . '_' . $toCurrency;
    $conversionKey2 = $toCurrency . '_' . $fromCurrency;

    if (isset($exchangeRates[$conversionKey1])) {
        $convertedAmount = $amount * $exchangeRates[$conversionKey1];
        return ['convertedAmount' => number_format($convertedAmount, 2)];
    } elseif (isset($exchangeRates[$conversionKey2])) {
        $convertedAmount = $amount / $exchangeRates[$conversionKey2];
        return ['convertedAmount' => number_format($convertedAmount, 2)];
    } else {
        return ['error' => "Conversion rate not found for $fromCurrency to $toCurrency."];
    }
}

$exchangeRates = [
    'USD_INR' => 75.0,
    'USD_EUR' => 0.88,
    'INR_USD' => 1 / 75.0,
    'EUR_USD' => 1 / 0.88,
    'INR_EUR' => (1 / 75.0) * 0.88,
    'EUR_INR' => 75.0 / 0.88,
];

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
