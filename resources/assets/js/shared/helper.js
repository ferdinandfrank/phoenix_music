// Alerts
import Alert from "./components/Alert";
// AJAX Form Submits
import FormSubmit from "./components/FormSubmit";

window.showAlert = function (type, title, message, timer = 3000, callback) {
    new Alert(type, title, message).show(timer);
    if (isFunction(callback)) {
        setTimeout(() => {
            callback();
        }, timer);
    }
};

window.showConfirm = function (type, title, message, confirmAction = null, cancelAction = null, confirmButtonText = null, cancelButtonText = null) {
    new Alert(type, title, message).confirm(confirmAction, cancelAction, confirmButtonText, cancelButtonText);
};


window.sendFormData = function (form, callback) {
    new FormSubmit(form).send(callback);
};

window.sendInputs = function (wrapper, action, method, callback) {
    new FormSubmit(wrapper, action, method).send(callback);
};


/**
 * Sends the specified data to the specified url with the specified method.
 *
 * @param url
 * @param method
 * @param data
 * @param successCallback
 * @param errorCallback
 */
window.sendRequest = function (url, method = 'get', data = null, successCallback, errorCallback) {

    $.ajax({
        type: method,
        url: url,
        data: data,
        success: function (response) {
            if (isFunction(successCallback)) {
                successCallback(response);
            }
        },
        error: function (response) {
            if (isFunction(errorCallback)) {
                errorCallback(response);
            }
        }
    });
};

/**
 * Appends data to a wrapper.
 *
 * @param {string} wrapper The selector of the wrapper to append the data.
 * @param {string} data The data to append.
 */
window.appendData = function (wrapper, data) {
    $(wrapper).append(data);
    new Vue({
        el: wrapper
    });
};

/**
 * Prepends data to a wrapper.
 *
 * @param {string} wrapper The selector of the wrapper to prepend the data.
 * @param {string} data The data to prepend.
 */
window.prependData = function (wrapper, data) {
    $(wrapper).prepend(data);
    new Vue({
        el: wrapper
    });
};

/**
 * Replaces an element with new data.
 *
 * @param element
 * @param data
 */
window.replaceData = function (element, data) {
    $(element).replaceWith(data);
    new Vue({
        el: element
    });
};

/**
 * Checks if the specified param is a callable js function.
 *
 * @param functionToCheck
 * @returns {boolean}
 */
window.isFunction = function (functionToCheck) {
    return typeof functionToCheck == 'function';
};

/**
 * Replaces a char of a string with a substring.
 *
 * @param {string} s The string where to replace a char.
 * @param {int} n The char index that shall be replaced.
 * @param {string} t The substring that shall be inserted.
 * @returns {string}
 */
window.replaceChar = function (s, n, t) {
    return s.substring(0, n) + t + s.substring(n + 1);
};

/**
 * Serializes a form by only including the inputs that have a value.
 *
 * @param form
 * @returns {*}
 */
window.serializeForm = function (form) {

    // Find disabled inputs, and remove the "disabled" attribute
    let disabled = form.find(':input:disabled').removeAttr('disabled');

    // Set the value on the inputs, so these can be serialized
    form.find(":input").each(function () {
        $(this).attr('value', $(this).val());
    });

    let serializedInputs = form.find(":input[value!='']").serialize();

    // Include the values of empty checkboxes to the serialized inputs
    form.find(":input[type=checkbox]").each(function () {
        if (!this.checked || this.value == 0) {
            if (this.name) {
                serializedInputs += '&' + this.name + '=0';
            }
        }
    });

    // Re-disable the set of inputs that were previously enabled
    disabled.attr('disabled', 'disabled');

    return serializedInputs;
};

/**
 * Updates the window location href with params without reloading the page.
 *
 * @param params
 */
window.updateHrefParams = function (params) {
    let url = window.location.href.split('?')[0];
    history.pushState('', '', url + "?" + params);
};

/**
 * Helper to update the window location href with the input values of the specified form without reloading the page.
 *
 * @param form
 */
window.updateHrefParamsWithFormInputs = function (form) {
    updateHrefParams(serializeForm(form));
};

/**
 * Checks if the specified email address is a valid email address.
 *
 * @param email
 * @returns {boolean}
 */
window.isValidEmail = function (email) {
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
};