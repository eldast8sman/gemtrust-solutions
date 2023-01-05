var BASE_URL = "https://develop.gemtrustsolutions.com/";
var ADMIN_URL = "/admin/"
var API_URL = BASE_URL + "api/admin/";

let btnFunc = document.getElementById("btnFunc");

function userLogin() {

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


        // let params = JSON.stringify({
        //     "email": email,
        //     "password": password
        // })

        // $.ajax({
        //     type: "POST",
        //     url: API_URL + "login",
        //     data: params,
        //     dataType: "json",
        //     headers: {
        //         "Content-Type": "application/json"
        //     },
        //     success: function (response) {
        //         btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
        //         btnFunc.removeAttribute("disabled");
        //         btnFunc.innerText = "Sign In";

        //         if (response.status == "success") {

        //             alertBox("Login Successful", response.message, "success")

        //             let res = response.data;
        //             sessionStorage.setItem("adminToken", res.authorization.token);
        //             sessionStorage.setItem("adminName", res.name);
        //             sessionStorage.setItem("adminEmail", res.email);

        //             setInterval(window.location = ADMIN_URL, 5000)

        //         }
        //         else {
        //             alertBox("Error", response.message, "error")
        //         }
        //     },
        //     error: function (response) {
        //         btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
        //         btnFunc.removeAttribute("disabled");
        //         btnFunc.innerText = "Sign In";

        //         alertBox("Error", response.responseJSON.message, "error")
        //     }
        // })

    }

}