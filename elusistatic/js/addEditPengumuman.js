/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 */

$.validator.setDefaults({ ignore: '' });

$(document).ready(function () {
	$.validator.addMethod("noSpace", function(value, element) { 
        return value.trim().length != 0;  
	}, "No space please");


	$("#addEditPengumumanForm").validate({
		rules: {
			judul: {
				required: true,
				noSpace: true
			},
			deskripsi: {
                required: true,
				noSpace: true
			}
		},
		messages: {
			judul: {
				required: "Judul harus diisi",
				noSpace: "Judul tidak boleh kosong"
			},
			deskripsi: {
                required: "Deskripsi tidak boleh kosong",
				noSpace: "Deskripsi harus diisi"
			}
		},
		
	});
});