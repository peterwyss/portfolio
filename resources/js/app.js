
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Svelte and other libraries. It is a great starting point when
 * building robust, powerful web applications using Svelte and Laravel.
 */

require('./bootstrap');

import App from "./components/App.svelte";

var div = document.getElementById('testForm');

const app = new App({
  target: div
});

window.app = app;

export default app;