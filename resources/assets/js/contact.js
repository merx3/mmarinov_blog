
$(function() {

    // ajax for sending the contact form after validations pass
    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name = $("input#name").val();
            var email = $("input#email").val();
            var message = $("textarea#message").val();
            var botPrevention = $("input#favourite_color").val();
            var token = $("input[name='_token']").val();
            var recaptchaResponse;
            var firstName = name; // For Success/Failure Message
            $('#btn_contact_submit').val('Sending...');
            $('#success').html('');
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            recaptchaResponse = grecaptcha.getResponse(recaptchaId);
            if(recaptchaResponse == "") {
                $('#success').html(
                    "<div class='alert alert-danger'>" +
                    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" +
                    "<strong>Please, complete the captcha test before sending.</strong>" +
                    '</div>'
                );

                $('#btn_contact_submit').val('Send');
            } else if(botPrevention == ""){
                $.ajax({
                    url: laravelVars.sendEmailUrl,
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        message: message,
                        favourite_color: botPrevention,
                        recaptcha: recaptchaResponse,
                        _token: token
                    },
                    cache: false,
                    success: function() {
                        // Success message
                        $('#success').html(
                            "<div class='alert alert-success'>" +
                            "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" +
                            "<strong>Your message has been sent. </strong>" +
                            "</div>"
                        );

                        //clear all fields
                        $('#contactForm').trigger("reset");
                        $('#btn_contact_submit').val('Send');
                        grecaptcha.reset(recaptchaId);
                    },
                    error: function() {
                        // Fail message
                        $('#success').html(
                            "<div class='alert alert-danger'>" +
                            "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" +
                            "<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!</strong>" +
                            '</div>'
                        );
                        //clear all fields
                        $('#contactForm').trigger("reset");
                        $('#btn_contact_submit').val('Send');
                        grecaptcha.reset(recaptchaId);
                    },
                });
            } else {
                // Success message
                $('#success').html(
                    "<div class='alert alert-success'>" +
                    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" +
                    "<strong>Your message has been sent. </strong>" +
                    "</div>"
                );

                //clear all fields
                $('#contactForm').trigger("reset");
                $('#btn_contact_submit').val('Send');
                grecaptcha.reset(recaptchaId);
            }
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    //$("a[data-toggle=\"tab\"]").click(function(e) {
    //    e.preventDefault();
    //    $(this).tab("show");
    //});


    var onloadCallback = function() {
        alert("Here!");
    };
});


/*When clicking on Name, hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});

// Floating label headings for the contact form
$(function() {
    $("body").on("input propertychange", ".floating-label-form-group", function(e) {
        $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
    }).on("focus", ".floating-label-form-group", function() {
        $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function() {
        $(this).removeClass("floating-label-form-group-with-focus");
    });
});

