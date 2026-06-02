<?php
$files = [
    'resources/views/admin/orders/index.blade.php',
    'resources/views/admin/reports/index.blade.php',
    'resources/views/admin/dashboard.blade.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    // Replace the thead background
    $content = str_replace('background-color: #F9FAFB;', 'background-color: #F8FAFC;', $content);
    
    // Replace bg-white in table related tags to use inline style #F8FAFC
    // This is tricky because we only want to do it in the table area. 
    // Actually, in the dashboard, orders, reports, the tables are inside <div class="table-responsive">
    // Let's just str_replace specific patterns that we know exist in the tables:
    $content = str_replace('<tbody class="bg-white">', '<tbody style="background-color: #F8FAFC;">', $content);
    $content = str_replace('<tr class="border-bottom bg-white">', '<tr class="border-bottom">', $content);
    
    // For td elements: <td class="px-4 py-3 bg-white">
    $content = str_replace(' bg-white"', '" style="background-color: #F8FAFC;"', $content);
    
    // For pagination footer: <div class="p-4 border-top bg-white
    $content = str_replace('p-4 border-top bg-white', 'p-4 border-top', $content);
    $content = str_replace('p-4 border-top', 'p-4 border-top" style="background-color: #F8FAFC;"', $content); // might double quote, let's be careful.
    
    file_put_contents($file, $content);
    echo "Updated $file\n";
}
