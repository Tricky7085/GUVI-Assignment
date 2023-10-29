$(document).ready(function(){
    $('#register-form').on('submit', function(e){
        e.preventDefault();
        
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: 'php/register.php',
            data: {
                username: username,
                email: email,
                password: password
            },
            success: function(){
                if(resizeBy.success){
                    window.location.href = 'login.html';
                }else{
                    $('#register-message').text(res.message);
                }
            },
            error: function(){
                $('#register-message').text("An error occurred")
            }
        });
    });
});