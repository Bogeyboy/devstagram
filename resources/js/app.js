import './bootstrap';

import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: 'Sube aquí tu imagen...',
    acceptedFiles: ".png, .jpg, .jpeg, .gif", /* Tipo de imágenes permitidas */
    addRemoveLinks: true,/* Para poder borrar la imagen */
    dictRemoveFile: 'Eliminar archivo',
    maxFiles: 1,
    uploadMultiple: false,
});