<?php

$files = [
    'resources/views/admin/books/index.blade.php',
    'resources/views/admin/orders/index.blade.php',
    'resources/views/admin/reports/index.blade.php',
    'resources/views/admin/dashboard.blade.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    // Fix thead background explicitly
    $content = str_replace('<thead style="background-color: #F8FAFC;">', '<thead style="background-color: #F8FAFC;">', $content); // No-op if already
    $content = str_replace('<thead style="background-color: #F9FAFB;">', '<thead style="background-color: #F8FAFC;">', $content);
    $content = preg_replace('/<thead>/', '<thead style="background-color: #F8FAFC;">', $content);
    
    // Make headers background #F8FAFC explicitly just in case bootstrap overrides
    $content = preg_replace('/<th (class="[^"]*") style="([^"]*)"/', '<th $1 style="background-color: #F8FAFC; $2"', $content);
    
    // Decrease padding for td from px-4 py-3 or px-4 py-4 to px-3 py-3
    $content = str_replace('px-4 py-4', 'px-3 py-3', $content);
    
    // Wait, in orders and reports, td padding is "px-4 py-3". Let's change it to "px-3 py-3"
    $content = str_replace('px-4 py-3', 'px-3 py-3', $content);

    // Header size in books is 0.75rem. Let's make sure th uses font-size: 0.75rem;
    $content = str_replace('font-size: 0.7rem;', 'font-size: 0.75rem;', $content);
    
    file_put_contents($file, $content);
    echo "Updated $file\n";
}

