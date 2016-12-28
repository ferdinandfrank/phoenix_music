/**
 * Submits a form (or any kind of element with inputs within the element) with ajax.
 */
class FormSubmit {

    constructor(form, action = null, method = null) {
        this.form = form;

        if (!action) {
            action = form.attr('action');
        }
        this.action = action;

        if (!method) {
            method = form.attr('method').toLowerCase();
        }
        this.method = method.toLowerCase();
    }

    send(callback) {
        const form = this.form;
        const url = this.action;
        const method = this.method;

        sendRequest(url, method, serializeForm(form), function (response) {
            if (isFunction(callback)) {
                callback(true, response);
            }
        }, function (response) {
            if (isFunction(callback)) {
                callback(false, response.responseJSON);
            }
        });
    }
}

export default FormSubmit;



