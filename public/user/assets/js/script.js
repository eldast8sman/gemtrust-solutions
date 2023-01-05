var BASE_URL = "https://develop.gemtrustsolutions.com/";
const USER_URL = "/users/"
const API_URL = BASE_URL + "api/";

let btnFunc = document.getElementById("btnFunc");

function registerUser() {

    let fullName = $("#fullName").val();
    let phoneNumber = $("#phoneNumber").val();
    let emailAddress = $("#emailAddress").val();
    let password = $("#password").val();
    let cPassword = $("#cPassword").val();

    if (fullName === "") {
        alertBox("Form Field Required", "Your Full name must be provided", "warning")
    }
    else if (phoneNumber === "") {
        alertBox("Form Field Required", "Your Phone Number must be provided", "warning")
    }
    else if (phoneNumber.length > 11 || phoneNumber.length < 11) {
        alertBox("Form Field Required", "Phone number can't be lesser or greater than 11 digits", "warning")
    }
    else if (emailAddress === "") {
        alertBox("Form Field Required", "Your Email address must be provided", "warning")
    }
    else if (password === "") {
        alertBox("Form Field Required", "Your Password must be provided", "warning")
    }
    else if (cPassword === "") {
        alertBox("Form Field Required", "Please confirm your password", "warning")
    }
    else if (cPassword !== password) {
        alertBox("Form Field Required", "Your Password doesn't match", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning w-100");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        const params = JSON.stringify({
            "name": fullName,
            "phone": phoneNumber,
            "email": emailAddress,
            "password": password,
            "password_confirmation": cPassword,
        })

        $.ajax({
            type: "POST",
            url: API_URL + "signup",
            data: params,
            contentType: "json",
            headers: {
                // "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary w-100");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Create Account";

                let res = response.data;

                if (response.status == "success") {
                    alertBox("Registration Successful", response.message, "success")

                    sessionStorage.setItem("userToken", res.authorization.token);
                    sessionStorage.setItem("userName", res.name);
                    sessionStorage.setItem("userEmail", res.email);

                    setInterval(window.location = USER_URL + "verifyAccount/", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary w-100");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Create Account";

                alertBox("Error", response.responseJSON.message, "error")
            }
        });
    }

}

function userLogin() {

    let email = $('#emailAddress').val();
    let password = $("#password").val();

    if (email === "") {
        alertBox("Form Field Required", "Email must be provided", "warning")
    }
    else if (password === "") {
        alertBox("Form Field Required", "Password must be provided", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning w-100");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        
        let params = JSON.stringify({
            "email": email,
            "password": password
        })

        $.ajax({
            type: "POST",
            url: API_URL + "login",
            data: params,
            dataType: "json",
            headers: {
                "Content-Type": "application/json"
            },
            success: function(response) {
                btnFunc.setAttribute("class", "btn btn-primary w-100");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Sign In";

                if (response.status == "success") {
                    
                    alertBox("Login Successful", response.message, "success")

                    let res = response.data;
                    sessionStorage.setItem("userToken", res.authorization.token);
                    sessionStorage.setItem("userName", res.name);
                    sessionStorage.setItem("userEmail", res.email);

                    setInterval(window.location = USER_URL, 5000)

                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function(response) {
                btnFunc.setAttribute("class", "btn btn-primary w-100");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Sign In";

                alertBox("Error", response.responseJSON.message, "error")
            }
        })

    }

}

function activateAccount() {

    let verifyToken = $("#verifyToken").val();

    if (verifyToken === "") {
        alertBox("Form Field Required", "Verification Token must be provided", "warning")
    }
    else {
        const params = JSON.stringify({
            "verification_token": verifyToken,
        })

        $.ajax({
            type: "POST",
            url: API_URL + "activate",
            data: params,
            contentType: "json",
            headers: {
                "Content-Type": "application/json"
            },
            success: function (response) {
                if (response.status == "success") {

                    alertBox("Account Activated", response.message, "success")

                    setInterval(window.location = USER_URL + "login", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {

                if (response.responseJSON.status == "failed") {

                    swal({
                        title: response.responseJSON.message,
                        content: {
                            element: "input",
                            attributes: {
                                placeholder: "Enter your Email Address",
                                type: "email",
                            },
                        },
                        icon: "error",
                        buttons: ["Cancel", "Resend"],
                    })
                    .then((inputValue) => {
                        if (inputValue === null) return false;
                        
                        if (inputValue === "") {
                            alertBox("Error", "Your email is required to send reactivation link!", "error")
                            return false
                        }
                        
                        resendAccountVerification(inputValue);
                    })

                }
                else {
                    alertBox("Error", response.responseJSON.message, "error")
                }
                
            }
        });
    }
     
}

function resendAccountVerification(token) {
    
    $.ajax({
        type: "POST",
        url: API_URL + "resend-verification-link",
        data: JSON.stringify({
            "email": token
        }),
        dataType: "JSON",   
        headers: {
            "Content-Type": "application/json"
        },
        success: function (response) {
            if (response.status == "success") {
                alertBox("Verification Mail Sent", response.message, "success")
            }
            else {
                alertBox("Error", response.message, "error")
            }
        },
        error: function (response) {
            alertBox("Error", response.responseJSON.message, "error")
        }
    });
}

function forgotPassword() {
    let emailAddress = $("#emailAddress").val();

    if (emailAddress == "") {
        alertBox("Form Field Required", "Email must be provided", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning w-100");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        $.ajax({
            type: "POST",
            url: API_URL + "forgot-password",
            data: JSON.stringify({
                "email": emailAddress
            }),
            dataType: "JSON",   
            headers: {
                "Content-Type": "application/json"
            },
            success: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary w-100");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Reset Password";

                if (response.status == "success") {
                    alertBox("Reset Password Mail Sent", response.message, "success")
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary w-100");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Reset Password";

                alertBox("Error", response.responseJSON.message, "error")
            }
        });
    }
    
}

function resetPassword(token) {

    let password = $("#password").val();
    let cPassword = $("#cPassword").val();

    if (password === "") {
        alertBox("Form Field Required", "Your Password must be provided", "warning")
    }
    else if (cPassword === "") {
        alertBox("Form Field Required", "Please confirm your password", "warning")
    }
    else if (cPassword !== password) {
        alertBox("Form Field Required", "Your Password doesn't match", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning w-100");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        
        let params = JSON.stringify({
            "token": token,
            "password": password,
            "password_confirmation": cPassword,
        })

        $.ajax({
            type: "POST",
            url: API_URL + "reset-password",
            data: params,
            dataType: "json",
            headers: {
                "Content-Type": "application/json"
            },
            success: function(response) {
                btnFunc.setAttribute("class", "btn btn-primary w-100");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Save Password";

                if (response.status == "success") {
                    
                    alertBox("Login Successful", response.message, "success")

                    setInterval(window.location = USER_URL + "login", 5000)

                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function(response) {
                btnFunc.setAttribute("class", "btn btn-primary w-100");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Save Password";

                alertBox("Error", response.responseJSON.message, "error")
            }
        })

    }

}

function userLogout() {

    // $.ajax({
    //     type: "GET",
    //     url: API_URL + "logout",
    //     headers: {
    //         "Authorization": "Bearer " + sessionStorage.getItem('spToken'),
    //         "Content-Type": "application/json"
    //     },
    //     success: function (response) {

    //         if (response.status == "success") {
                sessionStorage.clear()

                alertBox("Logging Out", "Log out successfully", "success")
                // alertBox("Logout Successful", response.message, "success")

                setInterval(window.location = USER_URL, 5000)
    //         }
    //         else {
    //             alertBox("Error", response.message, "error")
    //         }
    //     },
    //     error: function (response) {
    //         alertBox("Error", response.responseJSON.message, "error")
    //     }
    // })
}

function fetchSignals() {

    let getPage = document.title;

    if (getPage == "View Signal || User Dashboard || Gemtrust") {

        $.ajax({
            type: "GET",
            url: API_URL + "signals",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('userToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#signalCardHtml').html('');

                    response.data.data.forEach(element => {

                        let signalSection = "<div class='col-md-6'>";
                            signalSection += "<div class='card'>";
                                signalSection += "<div class='card-body'>";

                                signalSection += "<div class='row mb-3 mt-4' >";

                                    signalSection += "<div class='col-sm-6'>";
                                        signalSection += "<label class='col-form-label'>Currency Pair</label>";
                                        signalSection += "<h6>" + element.currency_pair + "</h6>";
                                    signalSection += "</div>";

                                    signalSection += "<div class='col-sm-6'>";
                                        signalSection += "<label class='col-form-label'>Order Type</label>";
                                        signalSection += "<h6 class='mb-4'>" + element.order_type + "</h6>";
                                    signalSection += "</div>";

                                signalSection += "</div>";

                                signalSection += "<div class='row mb-3'>";
                                    
                                    signalSection += "<div class='col-sm-6'>";
                                        signalSection += "<label class='col-form-label'>Lot Size</label>";
                                        signalSection += "<h6 class='mb-4'>" + element.lot_size + "</h6>";
                                    signalSection += "</div>";

                                    signalSection += "<div class='col-sm-6'>";
                                        signalSection += "<label class='col-form-label'>Entry Price</label>";
                                        signalSection += "<h6 class='mb-4'>" + element.entry_price + "</h6>";
                                    signalSection += "</div>";

                                signalSection += "</div>";

                                signalSection += "<a href='" + USER_URL + "signal/" + element.id + "' class='btn btn-primary py-2 w-100 mt-2'>View Signal</a>";
                           
                                signalSection += "</div>";
                            signalSection += "</div>";
                        signalSection += "</div>";

                        $('#signalCardHtml').append(signalSection);

                    });

                    let pagination = response.data;
                    let signalPagination = "<div class='col-md-12'>";

                        signalPagination += "<h3>Showing " + pagination.from + " to " + pagination.to + " of " + pagination.total + " entries</h3>";
                            signalPagination += '<ul class="pagination justify-content-end">';
                            
                            response.data.links.forEach(element => {

                                let page_status = "";
                                let page_url = "";

                                if (element.active == true) {
                                    page_status = "active";
                                }
                                else {
                                    page_status = "disabled";
                                }

                                if (element.url !== null) {
                                    page_url = element.url;
                                    console.log(page_url)
                                }

                                signalPagination += '<li class="page-item ' + page_status + '">';
                                    signalPagination += '<a class="page-link" href="' + page_url + '">';
                                        signalPagination += element.label;
                                    signalPagination += '</a>';
                                signalPagination += '</li>';

                            });

                            signalPagination += '</ul>';

                        signalPagination += '</div>';


                    $('#signalCardHtml').append(signalPagination);
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                alertBox("Error", response.responseJSON.message, "error")
            }
        })
    }
}
fetchSignals()

function fetchSingleSignal() {

    let getPage = document.title;

    if (getPage == "View Single Signal || User Dashboard || Gemtrust") {

        let signal_id = $("#signal_id").val();

        $.ajax({
            type: "GET",
            url: API_URL + "signals/" + signal_id,
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('userToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#singleSignalCardHtml').html('');

                    let element = response.data;

                    let signalBody = "<div class='col-xxl-12 col-md-12'>";
                        signalBody += "<div class='card'>";
                            signalBody += "<div class='card-body'>";

                                signalBody += "<h3 class='card-title mb-4'>Signal Details</h3>";

                                signalBody += "<div class='row g-4'>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Currency Pair</label>";
                                        signalBody += "<h6 class='mb-4'>" + element.currency_pair + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Oder Type</label>";
                                        signalBody += "<h6 class='mb-4'>" + element.order_type + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Lot Size</label>";
                                        signalBody += "<h6 class='mb-4'>" + element.lot_size + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Entry Price</label>";
                                        signalBody += "<h6 class='mb-4'>" + element.entry_price + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Take Profit 1</label>";
                                        signalBody += "<h6 class='mb-4'>" + element.take_profit1 + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Take Profit 2</label>";
                                        signalBody += "<h6 class='mb-4'>" + element.take_profit2 + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Take Profit 3</label>";
                                        signalBody += "<h6 class='mb-4'>" + element.take_profit3 + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Stop Loss</label>";
                                        signalBody += "<h6 class='mb-4'>" + element.stop_loss + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Date Created</label>";
                                        signalBody += "<h6 class='mb-4'>" + formatDate(element.created_at) + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-6'>";
                                        signalBody += "<label class='col-form-label'>Last Update</label>";
                                        signalBody += "<h6 class='mb-4'>" + formatDate(element.updated_at) + "</h6>";
                                    signalBody += "</div>";

                                    signalBody += "<div class='col-sm-12'>";
                                        signalBody += "<label class='col-form-label'>Oder Type</label>";
                                        signalBody += "<p class='mb-4'>" + element.remarks + "</p>";
                                    signalBody += "</div>";

                                    // signalBody += "<div class='col-sm-6'>";
                                    //     signalBody += "<button type='button' data-bs-toggle='modal' data-bs-target='#sectionEditModal' onclick='loadEditSectionModal()' title='click here to edit Section' class='btn btn-primary py-3 w-100 mb-4' >Edit</button>";
                                    // signalBody += "</div>";

                                    // signalBody += "<div class='col-sm-6'>";
                                    //     signalBody += "<button type='button' title='click here to delete Section' class='btn btn-danger py-3 w-100 mb-4' onclick='deleteSection(" + '"' + element.id + '"' + ")' >Delete</button>";
                                    // signalBody += "</div>";

                                signalBody += "</div>";

                            signalBody += "</div>";
                        signalBody += "</div>";
                    signalBody += "</div>";

                    $('#singleSignalCardHtml').html(signalBody);
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                alertBox("Error", response.responseJSON.message, "error")
            }
        })
    }

}
fetchSingleSignal()


function signal_subscription() {

    btnFunc.setAttribute("class", "btn btn-warning mt-4 w-100");
    btnFunc.setAttribute("disabled", "disabled");
    btnFunc.innerHTML = '<div class="spinner-border"></div>';
    

    $.ajax({
        type: "GET",
        url: API_URL + "signal-providing/subscribe",
        headers: {
            "Authorization": "Bearer " + sessionStorage.getItem('userToken'),
            "Content-Type": "application/json"
        },
        success: function(response) {
            btnFunc.setAttribute("class", "btn btn-primary mt-4 w-100");
            btnFunc.removeAttribute("disabled");
            btnFunc.innerText = "Subscribe";

            if (response.status == "success") {
                alertBox("Subscribed To Signals", response.message, "success")
            }
            else {
                alertBox("Error", response.message, "error")
            }

        },
        error: function(response) {
            btnFunc.setAttribute("class", "btn btn-primary mt-4 w-100");
            btnFunc.removeAttribute("disabled");
            btnFunc.innerText = "Subscribe";

            alertBox("Error", response.responseJSON.message, "error")
        }
    })
}

function alertBox(title, text, icon) {
    swal({
        title: title,
        text: text,
        icon: icon,
        buttons: false,
        dangerMode: false,
    }) 
}

function dataTable() {
    $('#resultTable').DataTable({
        "scrollX": true,
        "bPaginate": true,
        "info": true, 
    });
}

function formatDate(date_string) {
    let date = new Date(date_string);
    return date.toUTCString();
}

document.querySelectorAll("#userName").forEach(element => {
    element.innerText = sessionStorage.getItem('userName');
})