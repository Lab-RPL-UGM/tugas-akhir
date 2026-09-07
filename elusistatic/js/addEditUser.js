/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 */

$(document).ready(function () {
	$.validator.addMethod("noSpace", function(value, element) {
        // this.optional(element) -- kalau field-nya opsional (mis. password, tidak
        // punya rule required) DAN kosong, lolos saja. Tanpa ini, field opsional yang
        // dikosongkan tetap ditolak sebagai "cuma berisi spasi" walau memang kosong.
        return this.optional(element) || value.trim().length != 0;
	}, "No space please");
	
	$("#addEditUserForm").validate({
		rules: {
			fname: {
				required: true,
				noSpace: true
			},
			username: {
				required: true,
				minlength: 2,
				noSpace: true,
				remote: {
					url: baseURL + 'akademik/user/checkUsernameExists',
					type: 'post',
					data : { userId : function(){ return $("#userId").val(); } }
				}
			},
			nim:{
				required: true,
				noSpace: true,
				remote: {
					url: baseURL + 'akademik/user/checkNIMExists',
					type: 'post',
					data : { userId : function(){ return $("#userId").val(); } }
				}
			},
			nid:{
				required: true,
				noSpace: true,
				remote: {
					url: baseURL + 'akademik/user/checkNIDExists',
					type: 'post',
					data : { userId : function(){ return $("#userId").val(); } }
				}
			},
			// Password opsional -- dosen/kaprodi login lewat SSO (dicocokkan by email),
			// jadi tidak wajib diisi. Kalau memang diisi, tetap divalidasi normal
			// (jQuery Validate otomatis skip rule lain kalau field kosong & required:false).
			password: {
				required: false,
				noSpace: true,
				minlength: 5
			},
			cpassword: {
				required: false,
				equalTo: "#password"
			}
		},
		messages: {
			fname: {
				required: "Nama harus diisi",
				noSpace: "Nama tidak boleh kosong"
			},
			username: {
				required: "Username harus diisi",
				minlength: "Masukkan username minimal 2 karakter",
				remote: "Username sudah ada",
				noSpace: "Username tidak boleh kosong"
			},
			nim: {
				required: "NIM harus diisi",
				noSpace: "NIM tidak boleh kosong",
				remote: "NIM sudah ada"
			},
			nid: {
				required: "NID harus diisi",
				noSpace: "NID tidak boleh kosong",
				remote: "NID sudah ada"
			},
			// email: {
			// 	required: "Alamat email harus diisi",
			// 	email: "Please enter valid email address",
			// 	remote: "Email sudah ada"
			// },
			password: {
				required: "Password harus diisi",
				minlength: "Password harus minimal 5 karakter",
				noSpace: "Password paling tidak harus berisi karakter"
			},
			cpassword: {
				required: "Confirm password harus diisi",
				equalTo: "Confirm password harus sama dengan password"
			}
			// mobile: {
			// 	required: "Nomor Handphone harus diisi",
			// 	digits: "Hanya boleh memasukkan nomor"
			// }
		}

	});
});