/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 */

$(document).ready(function () {
    $.validator.addMethod("noSpace", function(value, element) { 
        return value.trim().length != 0;  
      }, "No space please");
      
	$("#addEditProyekForm").validate({
		rules: {
			select_dosen: {
				required: true,
				noSpace: true
			},
			nama_proyek: {
                required: true,
				noSpace: true
			},
			instansi: {
				required: true,
				noSpace: true
			}
		},
		messages: {
			select_dosen: {
				required: 'Dosen penanggungjawab tidak boleh kosong',
				noSpace: 'Dosen penanggungjawab tidak boleh kosong'
			},
		    nama_proyek: {
                required: 'Nama proyek tidak boleh kosong',
				noSpace: 'Nama proyek tidak boleh kosong'
			},
			instansi: {
                required: 'Nama instansi tidak boleh kosong',
				noSpace: 'Nama instansi tidak boleh kosong'
			}
		}
	});
});