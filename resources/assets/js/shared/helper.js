/**
 * Gets the current locale of the url.
 *
 * @returns {*}
 */
window.getCurrentLocale = function () {
    let path = window.location.pathname;
    let locale = path.substr(1, 2);
    if (locale == 'de') {
        return locale;
    }

    return 'en';
};