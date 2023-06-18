/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 */

$(document).ready(function () {
	$("#uploadUserForm").validate({
		rules: {
			fname: {
				required: true
			},
			username: {
				required: true
			}
		},
		messages: {
			fname: {
				required: "Nama harus diisi"
			},
			username: {
				required: "Username harus diisi"
            }
        }
	});
});