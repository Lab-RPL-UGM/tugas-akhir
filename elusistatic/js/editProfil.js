/**
 * File : editProfil.js
 *
 * This file contain the validation of edit profil form
 *
 * Using validation plugin : jquery.validate.js
 */

$(document).ready(function () {
    $.validator.addMethod("noSpace", function(value, element) {
        return value.trim().length != 0;
    }, "No space please");

    $("#editProfilForm").validate({
        rules: {
            nama: {
                required: true,
                noSpace: true
            },
            nim: {
                required: true,
                noSpace: true,
                minlength: 18,
                remote: {
                    url: baseURL + 'mahasiswa/profil/checkNimExists',
                    type: 'post',
                    data : {
                        id_mahasiswa : function(){
                            return $("#id_mahasiswa").val();
                        }
                    }
                }
            },
            email: {
            	required: true,
            	email: true,
            	remote: {
            		url: baseURL + 'mahasiswa/profil/checkEmailExists',
            		type: 'post',
            		data: {
            			id_mahasiswa: function() {
            			  return $("#id_mahasiswa").val();
            			}
            		}
            	}
            },
            ipk: {
                required: true,
                noSpace: true,
                minlength: 4
            },
            jumlah_SKS: {
                required: true,
                noSpace: true,
                minlength: 3
            },
            mobile: {
                required: true,
                noSpace: true,
                minlength: 10,
                maxlength: 13
            }
        },
        messages: {
            nama: {
                required: "Nama harus diisi",
                noSpace: "Nama tidak boleh kosong"
            },
            nim: {
                required: "NIM harus diisi",
                minlength: "Masukkan NIM lengkap dan valid",
                remote: "NIM sudah ada",
                noSpace: "NIM tidak boleh kosong"
            },
            email: {
            	required: "Alamat email harus diisi",
            	email: "Masukkan email valid",
            	remote: "Email sudah ada"
            },
            ipk: {
                required: "IPK harus diisi",
                noSpace: "IPK tidak boleh kosong",
                minlength: "Format nya harus 2 digit dibelakang koma",
            },
            jumlah_SKS: {
                required: "sks harus diisi",
                noSpace: "IPK tidak boleh kosong",
                min: "Minimal telah menempuh 100 SKS",
                max: "Maksimal telah menempuh 120 SKS"
            },
            mobile: {
            	required: "Nomor Handphone harus diisi",
                minlength: "Masukkan valid nomor handphone",
                maxlength: "Masukkan valid nomor handphone",
            	digits: "Hanya boleh memasukkan nomor"
            }
        }

    });
    $("#editProfilFormDosen").validate({
        rules: {
            nama: {
                required: true,
                noSpace: true
            },
            nid: {
                required: true,
                noSpace: true,
                minlength: 18,
                remote: {
                    url: baseURL + 'dosen/profil/checkNidExists',
                    type: 'post',
                    data : {
                        id_dosen : function(){
                            return $("#id_dosen").val();
                        }
                    }
                }
            },
            email: {
                required: true,
                email: true,
                // remote: {
                //     url: baseURL + 'dosen/profil/checkEmailExists',
                //     type: 'post',
                //     data: {
                //         id_dosen: function() {
                //             return $("#id_dosen").val();
                //         }
                //     }
                // }
            },
            mobile: {
                required: true,
                noSpace: true,
                minlength: 10,
                maxlength: 13
            }
        },
        messages: {
            nama: {
                required: "Nama harus diisi",
                noSpace: "Nama tidak boleh kosong"
            },
            nid: {
                required: "NID harus diisi",
                minlength: "Masukkan NIP valid",
                remote: "NID sudah ada",
                noSpace: "NID tidak boleh kosong"
            },
            email: {
                required: "Alamat email harus diisi",
                email: "Masukkan email valid",
                // remote: "Email sudah ada"
            },
            mobile: {
                required: "Nomor Handphone harus diisi",
                minlength: "Masukkan valid nomor handphone",
                maxlength: "Masukkan valid nomor handphone",
                digits: "Hanya boleh memasukkan nomor"
            }
        }

    });
});