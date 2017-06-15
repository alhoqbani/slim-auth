$(function () {
    $('#forget_password').click(function (event) {
        event.preventDefault();
        var email = $('#email').val();
        if (!email) {
            alert('Please Provide an email address');
            return;
        }
        var data = new FormData();
        data.append(csrf_token.name.key, csrf_token.name.value);
        data.append(csrf_token.value.key, csrf_token.value.value);
        data.append("email", email);
        $.ajax({
            url: "/forget",
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data, status, xhr) {
                console.log(data);
                csrf_token = JSON.parse(xhr.getResponseHeader('X-CSRF-Token'));
            }
        });
    })
});