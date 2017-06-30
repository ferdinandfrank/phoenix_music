class Alert {

    constructor(type, title, message) {
        this.type = type;
        this.message = message;
        this.title = title;
        this.animation = "slide-from-top";
    }

    show(timer = 3000) {
        let showConfirmButton = false;
        if (this.type === 'error') {
            timer = null;
            showConfirmButton = true;
        }

        $('.sweet-alert, .sweet-overlay').remove();

        swal({
            title: this.title,
            text: this.message,
            type: this.type,
            timer: timer,
            animation: this.animation,
            html: true,
            showConfirmButton: showConfirmButton
        });
    }

    confirm(confirmAction, cancelAction, buttonText, cancelButtonText) {

        let showCancelButton = true;
        if (this.type === "error") {
            buttonText = "Ok";
        }
        if (cancelButtonText === false || this.type === "error") {
            showCancelButton = false;
        }

        swal({
            title: this.title,
            text: this.message,
            type: this.type,
            html: true,
            animation: this.animation,
            confirmButtonText: buttonText,
            showCancelButton: showCancelButton,
            cancelButtonText: cancelButtonText,
        }, function(isConfirm){
            if (isConfirm) {
                if (confirmAction) {
                    confirmAction.call();
                } else {
                    swal.close();
                }
            } else {
                if (cancelAction) {
                    cancelAction.call();
                } else {
                    swal.close();
                }
            }
        });
    }

    ask(confirmAction, buttonText, cancelButtonText, placeholder = null) {
        swal({
            title: this.title,
            text: this.message,
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: this.animation,
            inputPlaceholder: placeholder,
            confirmButtonText: buttonText,
            cancelButtonText: cancelButtonText,
        }, function(inputValue){

            if (inputValue === false) {
                return false;
            }

            confirmAction(inputValue);
            swal.close();
        });
    }

}

export default Alert;



