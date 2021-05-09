(function($) {
    $('.submit-newsletter').on('click',function (e) {
        e.preventDefault();
        const url = window.location.origin;
        let email = $('.email.email-newsletter').val();

        if(isEmail(email))
        {
            $.ajax({
                url: url+"/newsletter/subscription",
                method:"post",
                data:{email:email},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success:function(data) {
                    if(data.status)
                    {
                        toastr.success(data.notification.message);
                    }
                    else
                    {
                        toastr.error(data.notification.message);
                    }

                },
                 error: function (error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function (i, message) {
                            toastr.error(message);
                        });
                    }
                }
            });
        }
        else
        {
            toastr.error('Your provide valid email');
        }

    });
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
})(jQuery);
