$(document).ready(function () {

    //fetch url string
    var url_string = window.location.href;
    var url = new URL(url_string);
    var notice = url.searchParams.get("not");
    var filter = url.searchParams.get("q_filter");


    // notice alert
    switch (notice) {
        case 'password_mismatch_error':
            $('#alert').html('<div class="alert alert-danger alert-dismissible fade show shadow" role="alert">' +
                '<strong>Password mismatch!</strong> Password does not match.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>');
            break;
        case 'sign_up_error':
            $('#alert').html('<div class="alert alert-danger alert-dismissible fade show shadow" role="alert">' +
                '<strong>Signup error!</strong> Signup error please check your detail.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>');
            break;
        case 'login_error':
            $('#alert').html('<div class="alert alert-danger alert-dismissible fade show shadow" role="alert">' +
                '<strong>Login error!</strong> Incorrect username or password entered.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>');
            break;
        case 'logout':
            $('#alert').html('<div class="alert alert-warning alert-dismissible fade show shadow" role="alert">' +
                '<strong>Logged out!</strong>  You has been logout successfully.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>');
            break;
        case 'update_success':
            $('#alert').html('<div class="alert alert-success alert-dismissible fade show shadow" role="alert">' +
                '<strong>Profile updated!</strong>  Your profile information has been updated successfully.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>');
            break;
        case 'update_error':
            $('#alert').html('<div class="alert alert-danger alert-dismissible fade show shadow" role="alert">' +
                '<strong>Update error!</strong> Your profile information update fails.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>');
            break;
        default:
            break;
    }


    // check username availability Ajax
    $('#usr').on('keyup', function () {

        var usrname = this.value;

        $.ajax({
            type: "POST",
            url: 'action.php',
            data: { data: 'chk_usr', temp_usr: usrname },
            success: function (data) {

                if (data != 'null' || usrname.length < 4) {

                    $('#usr').addClass("border border-danger");
                    errors['usr'] = '1';

                } else {

                    $('#usr').removeClass("border border-danger");
                    errors['usr'] = '0';

                }
            }

        });

    });


});
