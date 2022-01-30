const $ = require('jquery');
require('./styles/global.scss');

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// create global $ and jQuery variables
global.$ = global.jQuery = $;