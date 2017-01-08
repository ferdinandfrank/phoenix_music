/**
 * Vue Localization
 * ------------------
 * Load the localization files.
 */

import dropdown from "./components/Dropdown.vue";
import dropdownSearch from "./components/DropdownSearch.vue";
import panel from "./components/Panel.vue";
import phoenixAudio from "./components/PhoenixAudio.vue";

Vue.component('dropdown', dropdown);
Vue.component('dropdown-search', dropdownSearch);

Vue.component('panel', panel);
Vue.component('phoenix-audio', phoenixAudio);

/**
 * If it doesn't already exist, register a separate empty vue instance that
 * is attached to the window, we can use it to listen out for and handle
 * any events that may emitted by components...
 */
if (!window.eventHub) {
    window.eventHub = new Vue();
}