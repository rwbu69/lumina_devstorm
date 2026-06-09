const fs = require('fs');
const path = require('path');

const iconMap = {
    'arrow-left': 'o-arrow-left',
    'arrow-left-right': 'o-arrows-right-left',
    'arrow-right': 'o-arrow-right',
    'bank': 'o-building-library',
    'book': 'o-book-open',
    'book-half': 'o-book-open',
    'book-open': 'o-book-open',
    'box-arrow-right': 'o-arrow-right-on-rectangle',
    'bullseye': 'o-viewfinder-circle',
    'calendar-check': 'o-calendar-days',
    'calendar3': 'o-calendar',
    'card-image': 'o-photo',
    'cart-x': 'o-shopping-cart',
    'cart3': 'o-shopping-cart',
    'cash-stack': 'o-banknotes',
    'check-circle-fill': 's-check-circle',
    'check-lg': 'o-check',
    'check2': 'o-check',
    'chevron-left': 'o-chevron-left',
    'chevron-right': 'o-chevron-right',
    'cloud-arrow-up': 'o-cloud-arrow-up',
    'cloud-upload': 'o-cloud-arrow-up',
    'download': 'o-arrow-down-tray',
    'envelope': 'o-envelope',
    'exclamation-circle': 'o-exclamation-circle',
    'exclamation-circle-fill': 's-exclamation-circle',
    'exclamation-triangle': 'o-exclamation-triangle',
    'eye': 'o-eye',
    'file-earmark-pdf': 'o-document-text',
    'file-earmark-pdf-fill': 's-document-text',
    'file-text': 'o-document-text',
    'filter': 'o-funnel',
    'filter-left': 'o-funnel',
    'graph-up-arrow': 'o-chart-bar',
    'hourglass-split': 'o-clock',
    'image': 'o-photo',
    'inbox': 'o-inbox',
    'journal-bookmark': 'o-bookmark',
    'journal-plus': 'o-document-plus',
    'journal-x': 'o-document-minus',
    'journals': 'o-square-3-stack-3d',
    'lamp': 'o-light-bulb',
    'layout-sidebar': 'o-bars-3-bottom-left',
    'list': 'o-bars-3',
    'list-ul': 'o-list-bullet',
    'lock': 'o-lock-closed',
    'lock-fill': 's-lock-closed',
    'patch-check-fill': 's-check-badge',
    'pencil-square': 'o-pencil-square',
    'person': 'o-user',
    'person-fill': 's-user',
    'person-plus-fill': 's-user-plus',
    'person-x': 'o-user-minus',
    'plus-lg': 'o-plus',
    'receipt': 'o-receipt-percent',
    'save': 'o-document-check',
    'search': 'o-magnifying-glass',
    'shield-check': 'o-shield-check',
    'shield-lock': 'o-shield-exclamation',
    'stars': 'o-star',
    'trash': 'o-trash',
    'x-circle-fill': 's-x-circle',
    'x-lg': 'o-x-mark',
    'zoom-in': 'o-magnifying-glass-plus'
};

function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(function(file) {
        file = dir + '/' + file;
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) { 
            results = results.concat(walk(file));
        } else if (file.endsWith('.blade.php')) { 
            results.push(file);
        }
    });
    return results;
}

const views = walk('d:/KAMPUS/lumina_devstorm/resources/views');

views.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    
    // Pattern to match `<i class="bi bi-xxx extra-classes"></i>` or similar.
    // Also captures self-closing tags just in case, but standard is </i>
    const regex = /<i\s+class\s*=\s*["']([^"']*)["']\s*><\/i>/g;
    
    let modified = content.replace(regex, (match, classString) => {
        if (!classString.includes('bi')) return match;
        
        let classes = classString.split(' ').filter(c => c.trim() !== '');
        let biClass = classes.find(c => c.startsWith('bi-') && c !== 'bi');
        if (!biClass) return match;
        
        let biName = biClass.substring(3); // Remove 'bi-'
        let heroicon = iconMap[biName];
        if (!heroicon) {
            console.log('UNMAPPED ICON:', biName, 'in', file);
            return match; // fallback
        }
        
        // Remove 'bi' and 'bi-xxx' from classes
        classes = classes.filter(c => c !== 'bi' && !c.startsWith('bi-'));
        
        // Transform text size to size-*
        let sizeClassAdded = false;
        const sizeMap = {
            'text-xs': 'size-3',
            'text-sm': 'size-4',
            'text-base': 'size-5',
            'text-lg': 'size-6',
            'text-xl': 'size-6',
            'text-2xl': 'size-8',
            'text-3xl': 'size-10',
            'text-4xl': 'size-12',
            'text-5xl': 'size-16',
            'text-6xl': 'size-20'
        };
        
        for (let i = 0; i < classes.length; i++) {
            if (sizeMap[classes[i]]) {
                classes[i] = sizeMap[classes[i]];
                sizeClassAdded = true;
            }
        }
        
        if (!sizeClassAdded) {
            classes.push('size-5');
        }
        
        const finalClass = classes.join(' ').trim();
        const finalClassAttr = finalClass ? ` class="${finalClass}"` : '';
        
        return `<x-heroicon-${heroicon}${finalClassAttr} />`;
    });
    
    if (content !== modified) {
        fs.writeFileSync(file, modified, 'utf8');
        console.log('Updated:', file);
    }
});
