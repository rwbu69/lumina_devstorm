<?php
$file = 'resources/views/admin/orders/index.blade.php';
$content = file_get_contents($file);

// Find the parts
if (preg_match('/<<<<<<< HEAD\r?\n(.*?)=======\r?\n.*?\r?\n>>>>>>> [a-f0-9]+\r?\n/s', $content, $matches)) {
    $headContent = $matches[1];
    $newContent = str_replace($matches[0], $headContent, $content);
    file_put_contents($file, $newContent);
    echo "Conflict resolved.\n";
} else {
    echo "No conflict found.\n";
}
