<?php
$files = [
    'resources/views/admin/orders/index.blade.php',
    'resources/views/admin/reports/index.blade.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);

    // Body & Row
    $content = str_replace('<tr class="border-bottom bg-white">', '<tr class="border-bottom" style="background-color: #F8FAFC;">', $content);
    
    // Specific cells
    $content = str_replace('<td class="px-4 py-3 bg-white">', '<td class="px-3 py-3" style="background-color: #F8FAFC;">', $content);
    $content = str_replace('<td class="px-4 py-3 text-muted fw-medium bg-white"', '<td class="px-3 py-3 text-muted fw-medium" style="background-color: #F8FAFC;"', $content);
    $content = str_replace('<td class="px-4 py-3 fw-bold text-dark bg-white"', '<td class="px-3 py-3 fw-bold text-dark" style="background-color: #F8FAFC;"', $content);
    $content = str_replace('<td class="px-4 py-3 text-center bg-white">', '<td class="px-3 py-3 text-center" style="background-color: #F8FAFC;">', $content);
    $content = str_replace('<td class="px-4 py-3 text-muted bg-white"', '<td class="px-3 py-3 text-muted" style="background-color: #F8FAFC;"', $content);
    
    // Also any px-4 py-3 left
    $content = str_replace('px-4 py-3', 'px-3 py-3', $content);
    $content = str_replace('px-4 py-4', 'px-3 py-3', $content);

    file_put_contents($file, $content);
    echo "Updated $file\n";
}
