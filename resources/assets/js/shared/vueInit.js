/**
 * Vue Localization
 * ------------------
 * Load the localization files.
 */
import VueInternationalization from "vue-i18n";
import locales from "./locales";
import ajaxForm from "./components/AjaxForm.vue";
import formButton from "./components/FormButton.vue";
import formInput from "./components/FormInput.vue";
import formTextarea from "./components/FormTextarea.vue";
import formCodearea from "./components/FormCodearea.vue";
import formCheckbox from "./components/FormCheckbox.vue";
import formSwitch from "./components/FormSwitch.vue";
import formLink from "./components/FormLink.vue";
import formSelect from "./components/FormSelect.vue";
import formDateTimeInput from "./components/FormDateTimeInput.vue";
import formDateInput from "./components/FormDateInput.vue";
import removeButton from "./components/RemoveButton.vue";
import dropdown from "./components/Dropdown.vue";
import dropdownSearch from "./components/DropdownSearch.vue";
import icon from "./components/Icon.vue";
import loader from "./components/Loader.vue";
import panel from "./components/Panel.vue";
import phoenixAudio from "./components/PhoenixAudio.vue";

Vue.use(VueInternationalization);
// TODO: Make dynamic
Vue.config.lang = 'de';

Object.keys(locales).forEach(function (lang) {
    Vue.locale(lang, locales[lang])
});


Vue.component('ajax-form', ajaxForm);

Vue.component('form-button', formButton);
Vue.component('form-input', formInput);
Vue.component('form-textarea', formTextarea);
Vue.component('form-codearea', formCodearea);
Vue.component('form-checkbox', formCheckbox);
Vue.component('form-switch', formSwitch);
Vue.component('form-link', formLink);
Vue.component('form-select', formSelect);
Vue.component('form-datetime-input', formDateTimeInput);
Vue.component('form-date-input', formDateInput);

Vue.component('remove-button', removeButton);

Vue.component('dropdown', dropdown);
Vue.component('dropdown-search', dropdownSearch);

Vue.component('icon', icon);
Vue.component('loader', loader);
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