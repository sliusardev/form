import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;
window.jQuery = $;
import Chart from 'chart.js/auto';
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()
// Import forms after jQuery is defined

import './main.js'
