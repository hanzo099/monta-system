<?php
/**
 * Capture raw inputs exactly as entered.
 * Returns array that preserves original raw values.
 */
function captureInputs($q, $e, $t) {
    // Keep raw values unmodified (except trim to remove accidental surrounding whitespace)
    $raw = [
        'Q' => is_null($q) ? null : trim($q),
        'E' => is_null($e) ? null : trim($e),
        'T' => is_null($t) ? null : trim($t),
        'captured_at' => date('c')
    ];

    return $raw;
}
?>