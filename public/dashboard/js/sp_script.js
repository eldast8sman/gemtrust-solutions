var BASE_URL = "http://127.0.0.1:8000/";
var SP_URL = "/signalsProvider/"
var API_URL = BASE_URL + "api/signal-provider/";

let btnFunc = document.getElementById("btnFunc");
let signalArray;

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

    sessionStorage.clear()

    alertBox("Logging out...", "Logged out successfully", "success")

    setInterval(window.location = SP_URL, 3000)
}

function sendSignal() {
    
    let currencyPair = $("#currencyPair").val();
    let orderType = $("#orderType").val();
    let lotSize = $("#lotSize").val();
    let entryPrice = $("#entryPrice").val();
    let take_profit_1 = $("#take_profit_1").val();
    let take_profit_2 = $("#take_profit_2").val();
    let take_profit_3 = $("#take_profit_3").val();
    let stopLose = $("#stopLose").val();
    let remark = $("#remark").val();

    if (currencyPair === "") {
        alertBox("Form Field Required", "Currency pair is required", "warning")
    }
    else if (orderType === "") {
        alertBox("Form Field Required", "Order type is required", "warning")
    }
    else if (lotSize === "") {
        alertBox("Form Field Required", "Lot size is required", "warning")
    }
    else if (entryPrice === "") {
        alertBox("Form Field Required", "Entry price is required", "warning")
    }
    else if (take_profit_1 === "") {
        alertBox("Form Field Required", "Take Profit 1 is required", "warning")
    }
    else if (take_profit_2 === "") {
        alertBox("Form Field Required", "Take Profit 2 is required", "warning")
    }
    else if (take_profit_3 === "") {
        alertBox("Form Field Required", "Take Profit 3 is required", "warning")
    }
    else if (stopLose === "") {
        alertBox("Form Field Required", "Stop lose is required", "warning")
    }
    else if (remark === "") {
        alertBox("Form Field Required", "Description is required", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning py-3 w-100 mb-4");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        const params = JSON.stringify({
            "currency_pair": currencyPair,
            "order_type": orderType,
            "lot_size": lotSize,
            "entry_price": entryPrice,
            "take_profit1": take_profit_1,
            "take_profit2": take_profit_2,
            "take_profit3": take_profit_3,
            "stop_loss": stopLose,
            "remarks": remark
        });

        $.ajax({
            type: "POST",
            url: API_URL + "signals",
            data: params,
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('spToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Send Signal';

                if (response.status == "success") {
                    alertBox("Signal Added", response.message, "success")

                    setInterval(window.location = SP_URL + "signals", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Send Signal';

                alertBox("Error", response.responseJSON.message, "error")
            }
        });
    }
}

function fetchSignals() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Signals") {
        $.ajax({
            type: "GET",
            url: API_URL + "signals",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('spToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#signalsHtml').html('');
                    $('#signalsHtml').html("<h3 class='mb-4'>Signals</h3>");

                    console.log(response.data)
                    response.data.data.forEach(element => {

                        let signalSection = "<div class='col-sm-12 col-xl-6'>";
                            signalSection += "<div class='bg-light rounded h-100 p-4'>";
                                
                                signalSection += "<label>Currency Pair</label>";
                                signalSection += "<h6 class='mb-4'>" + element.currency_pair + "</h6>";

                                signalSection += "<label>Order Type</label>";
                                signalSection += "<h6 class='mb-4'>" + element.order_type + "</h6>";

                                signalSection += "<label>Lot Size</label>";
                                signalSection += "<h6 class='mb-4'>" + element.lot_size + "</h6>";

                                signalSection += "<label>Entry Price</label>";
                                signalSection += "<h6 class='mb-4'>" + element.entry_price + "</h6>";

                                signalSection += "<a href='" + SP_URL + "signal/" + element.id + "' class='btn btn-primary py-3 w-50 mt-2'>View Signal</a>";
                           
                            signalSection += "</div>";
                        signalSection += "</div>";

                        $('#signalsHtml').append(signalSection);
                    });

                    let signalPagination = "<div class='col-sm-12 col-xl-12'>";
                        signalPagination += '<ul class="pagination">';
                        signalPagination += '<li class="page-item disabled">';
                            signalPagination += '<a class="page-link" href="#" tabindex="-1">';
                            signalPagination += '<span class="fa fa-angle-left"></span>';
                            signalPagination += '</a>';
                            signalPagination += '</li>';
                            signalPagination += '<li class="page-item"><a class="page-link" href="#">1</a></li>';
                            signalPagination += '<li class="page-item active">';
                            signalPagination += '<a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>';
                            signalPagination += '</li>';
                            signalPagination += '<li class="page-item"><a class="page-link" href="#">3</a></li>';
                            
                            signalPagination += '<li class="page-item">';
                                signalPagination += '<a class="page-link" href="#">';
                                    signalPagination += '<span class="fa fa-angle-right"></span>';
                                signalPagination += '</a>';
                            signalPagination += '</li>';
                        signalPagination += '</ul>';

                        signalPagination += '</div>';


                    $('#signalsHtml').append(signalPagination);
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

    if (getPage == "Gemtrust Dashboard || View Single Signal") {

        let signal_id = $("#signal_id").val();

        $.ajax({
            type: "GET",
            url: API_URL + "signals/" + signal_id,
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('spToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#singleSignalHtml').html('');

                    let element = response.data;
                    signalArray = element;

                    let signalBody = "<div class='col-sm-12 col-xl-12'>";
                        signalBody += "<div class='bg-light rounded h-100 p-4'>";
                            signalBody += "<div class='row g-4'>";

                                signalBody += "<h3 class='mb-4'>Signal Details</h3>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Currency Pair</label>";
                                    signalBody += "<h6 class='mb-4'>" + element.currency_pair + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Oder Type</label>";
                                    signalBody += "<h6 class='mb-4'>" + element.order_type + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Lot Size</label>";
                                    signalBody += "<h6 class='mb-4'>" + element.lot_size + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Entry Price</label>";
                                    signalBody += "<h6 class='mb-4'>" + element.entry_price + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Take Profit 1</label>";
                                    signalBody += "<h6 class='mb-4'>" + element.take_profit1 + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Take Profit 2</label>";
                                    signalBody += "<h6 class='mb-4'>" + element.take_profit2 + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Take Profit 3</label>";
                                    signalBody += "<h6 class='mb-4'>" + element.take_profit3 + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Stop Loss</label>";
                                    signalBody += "<h6 class='mb-4'>" + element.stop_loss + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Date Created</label>";
                                    signalBody += "<h6 class='mb-4'>" + formatDate(element.created_at) + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-6'>";
                                    signalBody += "<label>Last Update</label>";
                                    signalBody += "<h6 class='mb-4'>" + formatDate(element.updated_at) + "</h6>";
                                signalBody += "</div>";

                                signalBody += "<div class='col-sm-12'>";
                                    signalBody += "<label>Oder Type</label>";
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

                    $('#singleSignalHtml').html(signalBody);
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


function subscribeSignal(packageAmount) {
    alertBox("Logout Successful", "You have subscribe to the " + packageAmount + " Package.", "success")
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