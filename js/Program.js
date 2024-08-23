function confirmDelete(id) {
    $('#deleteModal').modal('show');
    $("#userIdHiddenInput").val(id);
}

function deleteUser() {
    var id = $("#userIdHiddenInput").val();
    window.location = "BorrarUsuario/" + id;

}

function mostrarPassword() {
    var cambio = document.getElementById("txtPassword");
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}
function mostrarPassword2() {
    var cambio2 = document.getElementById("txtconfirmPassword");
    if (cambio2.type == "password") {
        cambio2.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio2.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}

$(document).ready(
    function () {
        $('#ShowPassword').click(
            function () {
                $('#Password').attr(
                    'type',
                    $(this).is(':checked') ? 'text'
                        : 'password');
            });
    }),
    function () {
        $('#ShowPassword2').click(
            function () {
                $('#Password').attr(
                    'type',
                    $(this).is(':checked') ? 'text'
                        : 'password');
            });
    };

