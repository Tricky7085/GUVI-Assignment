$(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: 'php/profile.php',
        success: function(res){
            if(res.success){
                $('#username').text(res.username);
                $('#age').val(res.age);
                $('#dob').val(res.dob);
                $('#contact').val(res.contact);
            }else{
                $('#profile-message').text(res.message);
            }
        },
        error: function(){
            $('#profile-message').text("An error occurred");
        }
    });
    $('#update-profile').on('click', function(){
        let age = $('#age').val();
        let dob = $('#dob').val();
        let contact = $('#contact').val();

        $.ajax({
            type: 'POST',
            url: 'php/profile.php',
            data: {
                age: age,
                dob: dob,
                contact: contact
            },
            success: function(res){
                if(res.success){
                    $('#profile-message').text(res.message);
                }else{
                    $('#profile-message').text(res.message);
                }
            },
            error: function(){
                $('#profile-message').text("An error occurred");
            }
        });
    });
});