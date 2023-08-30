import "./bootstrap";
import "./vendor/dom";
import "./vendor/tailwind-merge";
import "./vendor/svg-loader";
import Alpine from 'alpinejs'

Alpine.start()

import "jquery"
// import lightbox2 and jquery
import "lightbox2/dist/js/lightbox.min.js";
import "lightbox2/dist/css/lightbox.min.css";
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
  })


// Load static files
import.meta.glob(["../images/**"]);
