$(document).ready(function(){
    $('#login-form').on('submit', function(e){
        e.preventDefault();

        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: {
                username: username,
                password: password
            },
            success: function(res){
                if(res.success){
                    window.location.href = 'profile.html';
                }else{
                    $('#login-message').text(res.message)
                }
            },
            error: function(){
                $('#login-message').text("An error occurred");
            },
        });
    });
});