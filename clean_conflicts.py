import sys

def clean_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        lines = f.readlines()
    
    out = []
    state = 'NORMAL' # can be NORMAL, HEAD, THEIRS
    for line in lines:
        if line.startswith('<<<<<<< HEAD'):
            state = 'HEAD'
            continue
        elif line.startswith('======='):
            state = 'THEIRS'
            continue
        elif line.startswith('>>>>>>> '):
            state = 'NORMAL'
            continue
            
        if state == 'NORMAL' or state == 'HEAD':
            out.append(line)
            
    with open(filepath, 'w', encoding='utf-8') as f:
        f.writelines(out)

files = [
    'resources/views/admin/reports/index.blade.php',
    'resources/views/admin/reports/pdf.blade.php',
    'resources/views/admin/orders/index.blade.php'
]

for file in files:
    clean_file(file)
    print(f"Cleaned {file}")
