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
      
	$("#addPeriodeForm").validate({
		rules: {
			semester: {
				required: true,
				noSpace: true
			},
			thn1: {
				required: true,
				noSpace: true
			}
		},
		messages: {
			semester: {
				required: "Semester harus diisi",
				noSpace: "Semester tidak boleh kosong"
			},
			thn1: {
                required: "Tahun ajaran harus diisi",
				noSpace: "Tahun pertama tidak boleh kosong"
            }
        }
	});
});