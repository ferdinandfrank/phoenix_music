export default function imageUploader(dialog) {
    let image, xhr, xhrComplete, xhrProgress;

    let uploadUrl = '/admin/media/images';

    dialog.addEventListener('imageuploader.cancelupload', function () {
        // Stop the upload
        if (xhr) {
            xhr.upload.removeEventListener('progress', xhrProgress);
            xhr.removeEventListener('readystatechange', xhrComplete);
            xhr.abort();
        }

        // Set the dialog to empty
        dialog.state('empty');
    });

    dialog.addEventListener('imageuploader.clear', function () {
        // Clear the current image
        dialog.clear();
        image = null;
    });

    dialog.addEventListener('imageuploader.fileready', function (event) {
        // Upload a file to the server
        let formData = new FormData();
        let file = event.detail().file;

        formData.append('file', file);

        // Define functions to handle upload progress and completion
        xhrProgress = function (ev) {
            // Set the progress for the upload
            dialog.progress((ev.loaded / ev.total) * 100);
        };

        xhrComplete = function (ev) {
            let response;

            // Check the request is complete
            if (ev.target.readyState != 4) {
                return;
            }

            // Clear the request
            xhr = null;
            xhrProgress = null;
            xhrComplete = null;

            // Handle the result of the upload
            if (parseInt(ev.target.status) == 200) {
                // Unpack the response (from JSON)
                response = JSON.parse(ev.target.responseText);

                // Store the image details
                image = {
                    size: response.size,
                    url: response.url
                };

                // Populate the dialog
                dialog.populate(image.url, image.size);

            } else {
                // The request failed, notify the user
                new ContentTools.FlashUI('no');
            }
        };

        // Set the dialog state to uploading and reset the progress bar to 0
        dialog.state('uploading');
        dialog.progress(0);


        // Make the request
        xhr = new XMLHttpRequest();
        xhr.upload.addEventListener('progress', xhrProgress);
        xhr.addEventListener('readystatechange', xhrComplete);
        xhr.open('POST', uploadUrl, true);
        xhr.setRequestHeader("X-CSRF-TOKEN", Laravel.csrfToken);
        xhr.send(formData);
    });

    dialog.addEventListener('imageuploader.rotateccw', function () {
        rotateImage(90);
    });

    dialog.addEventListener('imageuploader.rotatecw', function () {
        rotateImage(-90);
    });

    dialog.addEventListener('imageuploader.save', function () {
        let crop, formData;

        // Define a function to handle the request completion
        xhrComplete = function (ev) {
            // Check the request is complete
            if (ev.target.readyState !== 4) {
                return;
            }

            // Clear the request
            xhr = null;
            xhrComplete = null;

            // Free the dialog from its busy state
            dialog.busy(false);

            // Handle the result of the rotation
            if (parseInt(ev.target.status) === 200) {
                // Unpack the response (from JSON)
                let response = JSON.parse(ev.target.responseText);

                // Trigger the save event against the dialog with details of the
                // image to be inserted.
                dialog.save(
                    response.url,
                    response.size,
                    {
                        'alt': response.alt,
                        'data-ce-max-width': response.size[0]
                    });

            } else {
                // The request failed, notify the user
                new ContentTools.FlashUI('no');
            }
        };

        // Set the dialog to busy while the rotate is performed
        dialog.busy(true);

        // Build the form data to post to the server
        formData = new FormData();
        formData.append('url', image.url);

        // Set the width of the image when it's inserted, this is a default
        // the user will be able to resize the image afterwards.
        formData.append('width', 600);

        // Check if a crop region has been defined by the user
        if (dialog.cropRegion()) {
            formData.append('crop', JSON.stringify(dialog.cropRegion()));
        }

        // Make the request
        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', xhrComplete);
        xhr.open('POST', uploadUrl + '/modify', true);
        xhr.setRequestHeader("X-CSRF-TOKEN", Laravel.csrfToken);
        xhr.send(formData);
    });

    function rotateImage(degrees) {
        // Request a rotated version of the image from the server
        let formData;

        // Define a function to handle the request completion
        xhrComplete = function (ev) {
            let response;

            // Check the request is complete
            if (ev.target.readyState != 4) {
                return;
            }

            // Clear the request
            xhr = null;
            xhrComplete = null;

            // Free the dialog from its busy state
            dialog.busy(false);

            // Handle the result of the rotation
            if (parseInt(ev.target.status) == 200) {
                // Unpack the response (from JSON)
                response = JSON.parse(ev.target.responseText);

                // Store the image details (use fake param to force refresh)
                image = {
                    size: response.size,
                    url: response.url + '?_ignore=' + Date.now()
                };

                // Populate the dialog
                dialog.populate(image.url, image.size);

            } else {
                // The request failed, notify the user
                new ContentTools.FlashUI('no');
            }
        };

        // Set the dialog to busy while the rotate is performed
        dialog.busy(true);

        // Build the form data to post to the server
        formData = new FormData();
        formData.append('url', image.url);
        formData.append('degrees', degrees);

        // Make the request
        xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', xhrComplete);
        xhr.open('POST', uploadUrl + '/rotate', true);
        xhr.setRequestHeader("X-CSRF-TOKEN", Laravel.csrfToken);
        xhr.send(formData);
    }
}


