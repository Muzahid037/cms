
$(document).ready(function () {

    ///CKE EDITOR
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
        });

        ///REST OF CODE

});