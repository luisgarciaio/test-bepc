import Dropzone from "dropzone";
Dropzone.autoDiscover = false;
const dropzone = new Dropzone(".dropzone", {
    dictDefaultMessage: "Sube aquí tu archivo",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    maxFilesize: 5, // Límite de tamaño de archivo en MB
    uploadMultiple: false,

    init: function() {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    },

    error: function(file, errorMessage) {
        if (file.accepted && !file.upload && file.size > this.options.maxFilesize * 1024 * 1024) {
            alert("El archivo excede el tamaño máximo permitido (5 MB).");
            this.removeFile(file);
        } else {
            alert("El archivo excede el tamaño máximo permitido");
            this.removeFile(file);
        }
    }
});

dropzone.on('success', function (file, response) {
    // console.log(response.imagen)
    document.querySelector('[name="imagen"]').value = response.imagen;
})

dropzone.on('removedfile', function () {
    document.querySelector('[name="imagen"]').value = '';
})
