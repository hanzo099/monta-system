<?php
/**
 * Simple JSON file persistence for auditability.
 */
function getDataFilePath() {
    $dir = __DIR__ . '/../data';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    return $dir . '/ipcr_records.json';
}

function storeData($data) {
    $file = getDataFilePath();
    $records = [];
    if (file_exists($file)) {
        $json = file_get_contents($file);
        $records = json_decode($json, true) ?: [];
    }

    // generate an incremental ID
    $id = count($records) + 1;
    $data['id'] = $id;
    $data['stored_at'] = date('c');

    $records[] = $data;
    file_put_contents($file, json_encode($records, JSON_PRETTY_PRINT));

    return $id;
}

function retrieveData($id) {
    $file = getDataFilePath();
    if (!file_exists($file)) return null;
    $records = json_decode(file_get_contents($file), true) ?: [];
    foreach ($records as $rec) {
        if (isset($rec['id']) && $rec['id'] == $id) return $rec;
    }
    return null;
}
?>