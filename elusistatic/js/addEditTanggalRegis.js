/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 */

$(document).ready(function () {
    $.validator.addMethod("greaterThanDate", 
	function(value, element, params) {
		array_value = value.split("-")
		date_value = new Date(array_value[2],array_value[1]-1,array_value[0]);

		array_params = $(params).val().split("-")
		date_params = new Date(array_params[2],array_params[1]-1,array_params[0]);

		return date_value > date_params;
	},'Must be greater than {0}.');


      
	$("#editTanggalTA").validate({
		rules: {
			tanggal_awal_ta: {
				required : true,
			},
			tanggal_akhir_ta: { 
				required : true,
				greaterThanDate: "#tanggal_awal_ta",
			}
		},
		messages: {
			tanggal_awal_ta: {
				required: "Tanggal awal harus diisi",
			},
			tanggal_akhir_ta: {
				required: "Tanggal akhir harus diisi",
				greaterThanDate: "Tanggal akhir harus lebih besar dari tanggal awal",
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent().parent());
		}
	});

	$("#editTanggalYudisium").validate({
		rules: {
			tanggal_awal_yudisium: {
				required : true,
				greaterThanDateNow: true
			},
			tanggal_akhir_yudisium: { 
				required : true,
				greaterThanDate: "#tanggal_awal_yudisium",
			}
		},
		messages: {
			tanggal_awal_yudisium: {
				required: "Tanggal awal harus diisi",
				greaterThanDateNow: "Tanggal awal harus lebih dari atau sama dengan tanggal sekarang"
			},
			tanggal_akhir_yudisium: {
				required: "Tanggal akhir harus diisi",
				greaterThanDate: "Tanggal akhir harus lebih besar dari tanggal awal",
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent().parent());
		}
	});
});