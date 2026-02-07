<?php
require __DIR__ . '/../includes/input_capture.php';
require __DIR__ . '/../includes/rating_conversion.php';
require __DIR__ . '/../includes/narrative_generator.php';
require __DIR__ . '/../includes/final_rating_calculator.php';
require __DIR__ . '/../includes/persistence_layer.php';

// CLI args: Q E T
$argv = $_SERVER['argv'];
array_shift($argv); // script name

if (count($argv) < 3) {
    // Default example inputs
    $q = '85%';
    $e = 'Very Satisfactory';
    $t = 'on time';
} else {
    $q = $argv[0];
    $e = $argv[1];
    $t = $argv[2];
}

$raw = captureInputs($q, $e, $t);
$ratings = convertRatings($raw);
$final = calculateFinalRating($ratings);

// Optional 4th CLI argument: task_id to fetch a suggested accomplishment_text
$taskId = isset($argv[3]) ? (is_numeric($argv[3]) ? (int)$argv[3] : null) : null;
$narrative = generateNarrative($raw, $taskId);

$record = [
    'raw' => $raw,
    'ratings' => $ratings,
    'final_rating' => $final,
    'narrative' => $narrative
];

$id = storeData($record);

// Output results
echo "Raw Inputs:\n";
print_r($raw);

echo "\nConverted Ratings:\n";
print_r($ratings);

echo "\nFinal Rating: $final\n";

echo "\nNarrative:\n$narrative\n";

echo "\nStored record id: $id\n";

exit(0);
?>