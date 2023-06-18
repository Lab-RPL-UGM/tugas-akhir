/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 */

$(document).ready(function () {
	$("#plottingDosbingForm").validate({
		rules: {
			dosen: {
				required: true
			}
		},
		messages: {
			dosen: {
				required: "Pilih dosen terlebih dahulu"
			}
		}
	});
});