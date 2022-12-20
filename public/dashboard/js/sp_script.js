var BASE_URL = "https://develop.gemtrustsolutions.com/";
var SP_URL = "/signalsProvider/"
var API_URL = BASE_URL + "api/signal-provider/";

let btnFunc = document.getElementById("btnFunc");

function spLogin() {

    var email = $('#emailAddress').val();
    var password = $("#password").val();

    if (email === "") {
        alertBox("Form Field Required", "Email must be provided", "warning")
    }
    else if (password === "") {
        alertBox("Form Field Required", "Password must be provided", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning py-3 w-100 mb-4");
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
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Sign In";

                if (response.status == "success") {
                    
                    alertBox("Login Successful", response.message, "success")

                    let res = response.data;
                    sessionStorage.setItem("spToken", res.authorization.token);
                    sessionStorage.setItem("spName", res.name);
                    sessionStorage.setItem("spEmail", res.email);

                    setInterval(window.location = SP_URL, 5000)

                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function(response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Sign In";

                alertBox("Error", response.responseJSON.message, "error")
            }
        })

    }

}

function activateAccount() {

    // const urlString = window.location.href;
    // const splitResult = urlString.split('/');
    
    let verifyToken = $("#verifyToken").val();
    let password = $("#sp_password").val();
    let cPassword = $("#sp_cPassword").val();

    if (verifyToken === "") {
        alertBox("Form Field Required", "Verification Token must be provided", "warning")
    }
    else if (password === "") {
        alertBox("Form Field Required", "Password must be provided", "warning")
    }
    else if (cPassword === "") {
        alertBox("Form Field Required", "Please confirm your password", "warning")
    }
    else if (cPassword !== password) {
        alertBox("Form Field Required", "Password doesn't match", "warning")
    }
    else {
        const params = JSON.stringify({
            "verify_token": verifyToken,
            "password": password,
            "password_confirmation": cPassword
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

                    alertBox("Login Successful", response.message, "success")

                    let res = response.data;
                    sessionStorage.setItem("spToken", res.authorization.token);
                    sessionStorage.setItem("spName", res.name);
                    sessionStorage.setItem("spEmail", res.email);

                    setInterval(window.location = "/signalsProvider", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {

                if (response.responseJSON.status == "failed") {
                    alertBox("Error", response.responseJSON.message, "error")

                    swal({
                        title: "Error",
                        text: response.responseJSON.message,
                        icon: "error",
                        buttons: ["Cancel", "Resend"],
                    })
                    .then((willDelete) => {
                        resendAccountVerification(verifyToken)
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
        type: "GET",
        url: API_URL + "resend-verification-link/" + token,
        contentType: "json",
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

function spLogout() {

    $.ajax({
        type: "GET",
        url: API_URL + "logout",
        headers: {
            "Authorization": "Bearer " + sessionStorage.getItem('spToken'),
            "Content-Type": "application/json"
        },
        success: function (response) {

            if (response.status == "success") {
                sessionStorage.clear()

                alertBox("Logout Successful", response.message, "success")

                setInterval(window.location = ADMIN_URL, 3000)
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

document.querySelectorAll("#spName").forEach(element => {
    element.innerText = sessionStorage.getItem('spName');
})