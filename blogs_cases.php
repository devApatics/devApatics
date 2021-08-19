<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/gif" sizes="32x32">
    <title>Apatics | Blogs & Cases</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/font.css" rel="stylesheet" type="text/css" />
    <link href="css/media.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script>
        jQuery(document).ready(function(jQuery) {
            jQuery("#header").load("header.html");
            jQuery("#footer").load("footer.html");

            $("#contact_form").validate({
                rules: {
                    name: {
                        required: true

                    },
                    company: {
                        required: true

                    },
                    email: {
                        required: true,
                        remote: {
                            url: "checkEmail.php",
                            type: "POST"
                        }
                    },
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    city: {
                        required: true

                    },
                    state: {
                        required: true,

                    },
                    'type[]': {
                        required: true
                    }
                },
                messages: {
                    name: "Please enter name.",
                    company: "Please enter company name.",
                    email: {
                        required: "Email is Required.",
                        remote: "Email already in use!",
                    },
                    phone: "Please enter Phone.",
                    city: "Please enter City.",
                    state: "Please enter State."
                },
                submitHandler: submitForm
            });
            $('#submit').click(function() {
                var $captcha = $('#g-recaptcha-response'),
                    response = grecaptcha.getResponse();

                if (response.length === 0) {
                    $('.msg-error').text("reCAPTCHA is mandatory");
                    if (!$captcha.hasClass("error")) {
                        $captcha.addClass("error");
                    }
                } else {
                    $('.msg-error').text('');
                    $captcha.removeClass("error");
                }
            })

            function submitForm() {
                var data = $("#contact_form").serialize();
                var cat_name = $('input[name=category_name]').val();
                $('#loading-image').show();
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        $('#loading-image').hide();
                        if (response == '1') {
                            $("#msg").addClass('show');
                            $("#contact_modal").modal('hide');
                            grecaptcha.reset();
                            $('input[type="checkbox"]').prop('checked', false);
                            $('#contact_form').trigger("reset");
                            if (cat_name == 'provider') {

                                window.open('PDF/fwa.pdf', '_blank');


                            }
                            if (cat_name == 'fraud') {

                                window.open('http://localhost/apatics-design/PDF/pdm.pdf', '_blank');
                            }
                            location.reload();
                        }
                        if (response == '0') {
                            $("#captcha_msg").html("Please select Captcha.");
                        }

                    }
                });
                return false;
            }

            $(function() {
                var requiredCheckboxes = $('.options :checkbox[required]');
                requiredCheckboxes.change(function() {
                    if (requiredCheckboxes.is(':checked')) {
                        requiredCheckboxes.removeAttr('required');
                    } else {
                        requiredCheckboxes.attr('required', 'required');
                    }
                });
            });
        });


        // function toggle(source) {
        //     setTimeout(function() {
        //         $('#contact_form').trigger("reset");
        //         checkboxA = document.getElementById('data_integrity').checked;
        //         checkboxB = document.getElementById('network_detection').checked;
        //         checkboxC = document.getElementById('consultation_demonstration').checked;
        //         checkboxD = document.getElementById('e_news_bulletin').checked;
        //         // alert(checkboxA, checkboxB, checkboxC, checkboxD);
        //         if (checkboxA == true) {
        //             // alert("Checked");
        //             document.getElementById("data_integrity_model").checked = true;
        //         }
        //         if (checkboxB == true) {
        //             document.getElementById("network_detection_model").checked = true;
        //         }
        //         if (checkboxC == true) {
        //             document.getElementById("consultation_demonstration_model").checked = true;
        //         }
        //         if (checkboxD == true) {
        //             document.getElementById("e_news_bulletin_model").checked = true;
        //         }
        //     }, 500)
        // }

        $(function() {
            $(".set_color_font_click").click(function() {
                var my_id_value = $(this).data('id');
                $("#category_name").val(my_id_value);
            })
        });
    </script>
</head>

<body>
    <div id="header" class="custom-header">
    </div>
    <div class="alert alert-success alert-dismissible fade" id="msg" role="alert">
        Thank you for connecting with us !
        <button type="button" class="close p-0" data-dismiss="alert" aria-label="Close">
            <img src="images/error-close.svg" alt="Close-error" />
        </button>
    </div>
    <div class="">
        <div class="container-fluid bg_set_blue set_height_bg">
            <div class="container set_content">
                <h3 class="company_title">BLOG ARTICLES</h3>
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 bg_set_box margin_set-pro blog_bottom_margin">
                        <a href="blog_1.html">
                            <div class="box">
                                <h5>Dimitri Arges
                                    <br>
                                    <span class="font_set">August 4, 2021</span>
                                </h5>
                                <hr class="yellow_border">
                                <p class="font_color_new blog_mar_top">Stopping the Tsunami of Telehealth Fraud, Waste and Abuse</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 bg_set_box margin_set-pro blog_bottom_margin">
                        <a href="blog_2.html">
                            <div class="box">
                                <h5>Theja Birur
                                    <br>
                                    <span class="font_set">August 10, 2021</span>
                                </h5>
                                <hr class="yellow_border">
                                <p class="mt-3 font_color_new">‘Fountain of Youth’ Doctor Fraud Is Now Preventable</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>  
        <div class="container-fluid  cat_mar_top">
            <div class="container set_content">
                <h3 class="company_title color_font_change comp_mar_top_text">WHITEPAPERS</h3>
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 bg_set_box margin_set-pro">
                        <div class="box">
                            <span class="font_set">Category</span>
                            <h5>
                                Provider Data Management
                            </h5>
                            <hr class="yellow_border">
                            <p class="mt-3 font_color_new set_coming">COMING SOON</p>
                            <div class="div_center">
                                <?php
                                if (isset($_SESSION['is_modal']) != 1) {
                                ?>
                                    <a href="#" class=" set_color_font_click" data-id="provider" data-toggle="modal" data-target="#contact_modal" />CLICK TO READ STORY</a>
                                <?php
                                } else { ?>
                                    <a href="PDF/fwa.pdf" target="_blank" class=" set_color_font_click" />CLICK TO READ STORY</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-5 col-sm-12 col-xs-12 bg_set_box margin_set-pro">
                        <div class="box">
                            <span class="font_set">Category</span>
                            <h5>
                                Fraud,Waste and Abuse
                            </h5>
                            <hr class="yellow_border">
                            <p class="mt-3 font_color_new set_coming">COMING SOON</p>
                            <div class="div_center">
                                <!-- <a href="#" class=" set_color_font_click" data-toggle="modal" data-target="#contact_modal" />CLICK TO READ STORY</a> -->
                                <?php
                                if (isset($_SESSION['is_modal']) != 1) {
                                ?>
                                    <a href="#" class="set_color_font_click" data-id="fraud" data-toggle="modal" data-target="#contact_modal" />CLICK TO READ STORY</a>
                                <?php
                                } else { ?>
                                    <a href="PDF/pdm.pdf" target="_blank" class="set_color_font_click" />CLICK TO READ STORY</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div id="footer" class="custom-header">
    </div>
    <!-- Footer -->

    <div class="modal fade contact-modal" id="contact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="contac-modal-form">
                    <div class="modal-logo d-flex align-items-center justify-content-between">
                        <img src="images/logo.svg" alt="Logo" />
                        <button class="close-modal" data-dismiss="modal" aria-label="Close">
                            <img src="images/modal-close.svg" alt="Close-modal" />
                        </button>
                    </div>
                    <form action="" method="POST" id="contact_form" class="contact-modal-form">
                        <input type="hidden" name="category_name" id="category_name" value="" />
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="company" id="company" class="form-control" placeholder="Company">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="city" id="city" class="form-control" placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="state" id="state" class="form-control" placeholder="State">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <div class="connect-option-selection">
                                    <ul class="mb-0">
                                        <li>
                                            <div class="d-flex align-items-center connect-option-link">
                                                <label class="checkbox">
                                                    <!-- <input type="checkbox" id="data_integrity" checked="checked"> -->
                                                    <input type="checkbox" name="type[]" id="data_integrity_model" value="Schedule a FREE provider network data integrity scan" required />
                                                    <span class="checked-box"></span>
                                                </label>
                                                <p>Schedule a <span>FREE</span> provider network data integrity scan</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center connect-option-link">
                                                <label class="checkbox">
                                                    <!-- <input type="checkbox" id="network_detection"> -->
                                                    <input type="checkbox" name="type[]" id="network_detection_model" value="Schedule a FREE FWA network detection scan" required />
                                                    <span class="checked-box"></span>
                                                </label>
                                                <p>Schedule a <span>FREE</span> FWA network detection scan</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center connect-option-link">
                                                <label class="checkbox">
                                                    <!-- <input type="checkbox" id="consultation_demonstration"> -->
                                                    <input type="checkbox" name="type[]" id="consultation_demonstration_model" value="Schedule a consultation and demonstration" required />
                                                    <span class="checked-box"></span>
                                                </label>
                                                <p>Schedule a consultation and demonstration</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center connect-option-link">
                                                <label class="checkbox">
                                                    <!-- <input type="checkbox" id="e_news_bulletin"> -->
                                                    <input type="checkbox" name="type[]" id="e_news_bulletin_model" value="Register for our e-news bulletin" required />
                                                    <span class="checked-box"></span>
                                                </label>
                                                <p>Register for our e-news bulletin</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-end flex-wrap">
                                <div class="g-recaptcha" data-sitekey="6Le5poEbAAAAANOyuBc25cJ183SYjCEdVj_ZwOII" name="g-recaptcha-response"></div>
                                <div id="captcha_msg"></div>
                                <div class="d-flex align-items-center w-100">
                                    <button type="submit" name="submit" id="submit" class="registerbtn">Submit</button>
                                    <div class="" id="loading-image" style="display: none;">
                                        <img src="images/spinner.gif" width="40" class="ml-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>