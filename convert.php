<?php

header('Content-Type: application/json');

function getLiveRate($from, $to) {
    $url = "https://api.frankfurter.app/latest?amount=1&from={$from}&to={$to}";

    $response = file_get_contents($url);
    if ($response === false) {
        return ['error' => 'Failed to fetch exchange rates.'];
    }

    $data = json_decode($response, true);
    if (!isset($data['rates'][$to])) {
        return ['error' => "Rate not available for $from to $to."];
    }

    return ['rate' => $data['rates'][$to]];
}

function convertCurrency($amount, $fromCurrency, $toCurrency) {
    if ($amount <= 0) {
        return ['error' => "Invalid amount. Please enter a positive number."];
    }

    if ($fromCurrency === $toCurrency) {
        return ['convertedAmount' => number_format($amount, 2)];
    }

    $rateInfo = getLiveRate($fromCurrency, $toCurrency);

    if (isset($rateInfo['error'])) {
        return $rateInfo;
    }

    $convertedAmount = $amount * $rateInfo['rate'];
    return ['convertedAmount' => number_format($convertedAmount, 2)];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = isset($_POST['amount']) ? (float) $_POST['amount'] : 0;
    $fromCurrency = strtoupper(trim($_POST['from_currency'] ?? ''));
    $toCurrency = strtoupper(trim($_POST['to_currency'] ?? ''));

    if (!$amount || !$fromCurrency || !$toCurrency) {
        echo json_encode(['error' => 'Invalid input.']);
        exit;
    }

    echo json_encode(convertCurrency($amount, $fromCurrency, $toCurrency));
}
?>
