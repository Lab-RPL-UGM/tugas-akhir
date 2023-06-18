$(document).ready(function () {
    $.validator.addMethod("noSpace", function(value, element) {
        return value.trim().length != 0;
    }, "Tidak boleh ada spasi");
    // $.validator.addClassRules('rules', {
    //     required: true
    // });

    $("#formNilai").validate({
        rules: {
            '.inputNilai': {
                required: true
            }
        },
        messages: {
            '.inputNilai': {
                required: 'Wajib diisi'

            }
        }
    });
    $(".rules").rules("add", {
        required:true
    });
});