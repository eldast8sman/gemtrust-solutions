var BASE_URL = "https://develop.gemtrustsolutions.com/";
var ADMIN_URL = "/admin/"
var API_URL = BASE_URL + "api/admin/";

let btnFunc = document.getElementById("btnFunc");
let packageArray;
let partnerArray;
let sectionArray;
let adminArray;
let signalProviderArray;

function adminLogin() {

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
            success: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Sign In";

                if (response.status == "success") {

                    alertBox("Login Successful", response.message, "success")

                    let res = response.data;
                    sessionStorage.setItem("adminToken", res.authorization.token);
                    sessionStorage.setItem("adminName", res.name);
                    sessionStorage.setItem("adminEmail", res.email);

                    setInterval(window.location = ADMIN_URL, 5000)

                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = "Sign In";

                alertBox("Error", response.responseJSON.message, "error")
            }
        })

    }

}

function registerAdmin() {

    var fullName = $("#admin_fullname").val();
    var emailAddress = $("#admin_emailAddress").val();
    var password = $("#admin_Password").val();
    var cPassword = $("#admin_cPassword").val();

    if (fullName === "") {
        alertBox("Form Field Required", "Administrator full name must be provided", "warning")
    }
    else if (emailAddress === "") {
        alertBox("Form Field Required", "Administrator email address must be provided", "warning")
    }
    else if (password === "") {
        alertBox("Form Field Required", "Administrator password must be provided", "warning")
    }
    else if (cPassword === "") {
        alertBox("Form Field Required", "Please confirm administrator password", "warning")
    }
    else if (cPassword !== password) {
        alertBox("Form Field Required", "Administrator Password doesn't match", "warning")
    }
    else {
        const params = JSON.stringify({
            "name": fullName,
            "email": emailAddress,
            "password": password
        })

        $.ajax({
            type: "POST",
            url: API_URL + "admins",
            data: params,
            contentType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                if (response.status == "success") {
                    alertBox("Login Successful", response.message, "success")

                    setInterval(window.location = ADMIN_URL + "viewAdmins", 5000)
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

}

function fetchAdmins() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Administrators") {
        $.ajax({
            type: "GET",
            url: API_URL + "admins",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    let sn = 1;

                    $('#tableBody').html('');

                    response.data.forEach(element => {
                        let tableBody = "<tr>";
                            tableBody += "<th scope='row'>" + sn++ + "</th>";
                            tableBody += "<td>" + element.name + "</td>";
                            tableBody += "<td>" + element.email + "</td>";
                            tableBody += "<td>" + formatDate(element.created_at) + "</td>";
                            tableBody += "<td><a href='" + ADMIN_URL + "admin/" + element.id + "' class='btn btn-primary py-2 w-100'>View</a></td>";
                        tableBody += "</tr>";

                        $('#tableBody').append(tableBody);
                    });

                    dataTable();
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
fetchAdmins()

function fetchSingleAdmin() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Single Admin") {

        let admin_id = $("#admin_id").val();

        $.ajax({
            type: "GET",
            url: API_URL + "admins/" + admin_id,
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#singleAdminHtml').html('');

                    let element = response.data;
                    adminArray = element;

                    let adminBody = "<div class='col-sm-12 col-xl-12'>";
                        adminBody += "<div class='bg-light rounded h-100 p-4'>";

                            adminBody += "<div class='row g-4'>";

                                adminBody += "<h3 class='mb-4'>Administrator Details</h3>";

                                adminBody += "<div class='col-sm-6'>";
                                adminBody += "<label>FullName</label>";
                                adminBody += "<h6 class='mb-4'>" + element.name + "</h6>";
                                adminBody += "</div>";

                                adminBody += "<div class='col-sm-6'>";
                                adminBody += "<label>Email</label>";
                                adminBody += "<h6 class='mb-4' id='adminEmail' >" + element.email + "</h6>";
                                adminBody += "</div>";

                                adminBody += "<div class='col-sm-6'>";
                                adminBody += "<label>Date Created</label>";
                                adminBody += "<h6 class='mb-4'>" + formatDate(element.created_at) + "</h6>";
                                adminBody += "</div>";

                                adminBody += "<div class='col-sm-6'>";
                                adminBody += "<label>Last Updated</label>";
                                adminBody += "<h6 class='mb-4'>" + formatDate(element.updated_at) + "</h6>";
                                adminBody += "</div>";

                                adminBody += "<div class='col-sm-6'>";
                                adminBody += "<button type='button' data-bs-toggle='modal' data-bs-target='#adminEditModal' title='click here to edit Admin' class='btn btn-primary py-3 w-100 mb-4' >Edit</button>";
                                adminBody += "</div>";

                                adminBody += "<div class='col-sm-6'>";
                                adminBody += "<button type='button' title='click here to delete Section' class='btn btn-danger py-3 w-100 mb-4' onclick='alert(" + '"Under Development :( "' + ")' >Delete</button>";
                                adminBody += "</div>";

                            adminBody += "</div>";
                        adminBody += "</div>";
                    adminBody += "</div>";

                    $('#singleAdminHtml').html(adminBody);
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
fetchSingleAdmin()

function updateAdminPassword() {
    let emailAddress = $('#adminEmail').val();
    let currentPassword = $('#e_currentPassword').val();
    let newPassword = $('#e_newPassword').val();
    let cPassword = $('#e_confirmPassword').val();

    const params = JSON.stringify({
        "email": emailAddress,
        "current_password": currentPassword,
        "password": newPassword,
        "password_confirmation": cPassword
    })

    swal({
        title: "Update Administrator",
        text: "Are you sure you want to save the changes?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "PUT",
                    url: API_URL + "change-password",
                    data: params,
                    dataType: "JSON",
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Administrator Updated", response.message, "success")

                            setInterval(window.location.reload(), 5000)
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
            else {
                alertBox("Cancel", "Administrator update request cancelled", "info")
            }
        })

}

function addPackage() {

    let packageName = $("#packageName").val();
    let level = $("#level").val();
    let amount = $("#amount").val();
    let discount = $("#discount").val();
    let Upline1 = $("#Upline1").val();
    let Upline2 = $("#Upline2").val();
    let Upline3 = $("#Upline3").val();
    let Upline4 = $("#Upline4").val();
    let description = $("#description").val();

    if (packageName === "") {
        alertBox("Form Field Required", "Package Name is required", "warning")
    }
    else if (level === "") {
        alertBox("Form Field Required", "Package level is required", "warning")
    }
    else if (amount === "") {
        alertBox("Form Field Required", "Package amount is required", "warning")
    }
    else if (discount === "") {
        alertBox("Form Field Required", "Package discount is required", "warning")
    }
    else if (Upline1 === "") {
        alertBox("Form Field Required", "Package upline 1 is required", "warning")
    }
    else if (Upline2 === "") {
        alertBox("Form Field Required", "Package upline 2 is required", "warning")
    }
    else if (Upline3 === "") {
        alertBox("Form Field Required", "Package upline 3 is required ", "warning")
    }
    else if (Upline4 === "") {
        alertBox("Form Field Required", "Package upline 4 is required", "warning")
    }
    else if (description === "") {
        alertBox("Form Field Required", "Package description is required", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning py-3 w-100 mb-4");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        const params = JSON.stringify({
            "package": packageName,
            "description": description,
            "level": level,
            "reg_amount": amount,
            "discount": discount,
            "upline1": Upline1,
            "upline2": Upline2,
            "upline3": Upline3,
            "upline4": Upline4
        })

        $.ajax({
            type: "POST",
            url: API_URL + "packages",
            data: params,
            contentType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerHTML = 'Add Package';

                if (response.status == "success") {
                    alertBox("Package Added", response.message, "success")

                    setInterval(window.location = ADMIN_URL + "packages", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Add Package';

                alertBox("Error", response.responseJSON.message, "error")
            }
        });
    }

}

function fetchPackages() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || Packages") {
        $.ajax({
            type: "GET",
            url: API_URL + "packages",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#packageHtml').html('');
                    $('#packageHtml').html("<h3 class='mb-4'>Packages</h3>");

                    response.data.forEach(element => {

                        let packageBody = "<div class='col-sm-12 col-xl-6'>";
                            packageBody += "<div class='bg-light rounded h-100 p-4'>";
                                packageBody += "<label for='" + element.package + "'>Package Name</label>";
                                packageBody += "<h6 class='mb-4'>" + element.package + "</h6>";
                                packageBody += "<label for='amount'>Amount</label>";
                                packageBody += "<h6 class='mb-4'>&#8358;" + element.reg_amount + "</h6>";
                                packageBody += "<a href='" + ADMIN_URL + "package/" + element.id + "' class='btn btn-primary py-3 w-50 mt-2'>View Package</a>";
                            packageBody += "</div>";
                        packageBody += "</div>";

                        $('#packageHtml').append(packageBody);
                    });

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
fetchPackages()

function fetchSinglePackage() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Package") {
        let packageId = $("#package_id").val();

        $.ajax({
            type: "GET",
            url: API_URL + "packages/" + packageId,
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#singlePackageHtml').html('');

                    let element = response.data;
                    packageArray = element;

                    let sn = 1;

                    let packageBody = "<div class='col-sm-6 col-xl-6'>";
                        packageBody += "<div class='bg-light rounded h-100 p-4'>";
                            packageBody += "<div class='row g-4'>";

                                packageBody += "<h3 class='mb-4'>Package Details</h3>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='package Name'>Package Name</label>";
                                    packageBody += "<h4 class='mb-4'>" + element.package + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='amount'>Amount</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.reg_amount + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='level'>Level</label>";
                                    packageBody += "<h4 class='mb-4'>" + element.level + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='discount'>Discount</label>";
                                    packageBody += "<h4 class='mb-4'>" + element.discount + "%</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='upline1'>upline1</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.upline1 + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='upline2'>upline2</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.upline2 + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='upline3'>Upline3</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.upline3 + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='upline4'>Upline4</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.upline4 + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='level1_bonus'>upline1</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.level1_bonus + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='level2_bonus'>upline2</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.level2_bonus + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='level3_bonus'>Upline3</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.level3_bonus + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='level4_bonus'>Upline4</label>";
                                    packageBody += "<h4 class='mb-4'>&#8358;" + element.level4_bonus + "</h4>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='created_at'>Date Created</label>";
                                    packageBody += "<h5 class='mb-4'>" + formatDate(element.created_at) + "</h5>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<label for='updated_at'>Last Update</label>";
                                    packageBody += "<h5 class='mb-4'>" + formatDate(element.updated_at) + "</h5>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-12'>";
                                    packageBody += "<label for='Description'>Description</label>";
                                    packageBody += "<h5 class='mb-4'>" + element.description + "</h5>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6' >";
                                    packageBody += "<button type='button' data-bs-toggle='modal' data-bs-target='#packageEditModal' onclick='loadEditPackageModal()' title='click here to edit Package' class='btn btn-primary py-3 w-100 mb-4' >Edit</button>";
                                packageBody += "</div>";

                                packageBody += "<div class='col-sm-6'>";
                                    packageBody += "<button type='button' title='click here to delete Package' class='btn btn-danger py-3 w-100 mb-4' onclick='deletePackage(" + '"' + element.id + '"' + ")' >Delete</button>";
                                packageBody += "</div>";

                            packageBody += "</div>";
                        packageBody += "</div>";
                    packageBody += "</div>";

                    packageBody += "<div class='col-sm-6 col-xl-6'>";
                        packageBody += "<div class='bg-light rounded h-100 p-4'>";
                            packageBody += "<div class='row g-4'>";

                                packageBody += "<h3 class='mb-4'>Package\'s Partners</h3>";

                                packageBody += '<table class="table table-bordered table-responsive">';
                                    packageBody += '<thead>';
                                        packageBody += '<tr>';
                                            packageBody += '<th scope="col">#</th>';
                                            packageBody += '<th scope="col">Partner</th>';
                                            packageBody += '<th scope="col">Amount</th>';
                                            packageBody += '<th scope="col">Action</th>';
                                        packageBody += '</tr>';
                                    packageBody += '</thead>';

                                    packageBody += '<tbody>';
                                    element.partners.forEach(partner => {
                                        packageBody += "<tr>";
                                            packageBody += "<th scope='row'>" + sn++ + "</th>";
                                            packageBody += "<td>" + partner.partner + "</td>";
                                            packageBody += "<td>&#8358;" + partner.amount + "</td>";
                                            packageBody += "<td><button type='button' title='click here to remove Partner' class='btn btn-danger py-2 w-100' onclick='removePartner(" + '"' + partner.id + '"' + ")' >Remove</button></td>";
                                        packageBody += "</tr>"
                                    })
                                    packageBody += '</tbody>';
                                packageBody += '</table>';

                                packageBody += "<div class='col-sm-12'>";
                                    packageBody += '<div class="form-floating mb-2">';
                                        packageBody += '<select class="form-select" id="partner_package_select" >';
                                        packageBody += '</select>';
                                        packageBody += '<label for="partner_package_select">Select Partner</label>';
                                    packageBody += '</div>';

                                    packageBody += '<div class="form-floating mb-3">';
                                        packageBody += '<input type="number" class="form-control" id="partnerAmount" placeholder="Partner Amount">';
                                        packageBody += '<label for="partnerAmount">Partner Amount</label>';
                                    packageBody += '</div>';
                                packageBody += '</div>';

                                packageBody += "<div class='col-sm-12'>";
                                    packageBody += "<button type='button' title='click here to add Partner' class='btn btn-success py-3 w-100 mb-4' onclick='add_partner_package()' >Add Partner</button>";
                                packageBody += "</div>";

                            packageBody += "</div>";
                        packageBody += "</div>";
                    packageBody += "</div>";

                    $('#singlePackageHtml').html(packageBody);

                    load_package_partner()

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
fetchSinglePackage()

function load_package_partner() {

    $.ajax({
        type: "GET",
        url: API_URL + "partners",
        headers: {
            "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
            "Content-Type": "application/json"
        },
        success: function (response) {

            if (response.status == "success") {

                $('#partner_package_select').html('');
                $('#partner_package_select').html('<option value="" selected >select partner</option>');

                response.data.forEach(element => {
                    $('#partner_package_select').append('<option value="' + element.id + '">' + element.partner + '</option>');
                });

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

function add_partner_package() {

    let packageId = $('#package_id').val();
    let partnerId = $('#partner_package_select').val();
    let partnerAmount = $('#partnerAmount').val();

    if (partnerId === "") {
        alertBox("Form Field Required", "Partner is required", "warning")
    }
    else if (partnerAmount === "") {
        alertBox("Form Field Required", "Partner amount is required", "warning")
    }
    else {

        const params = JSON.stringify({
            "package_id": packageId,
            "partner_id": partnerId,
            "amount": partnerAmount,
        })

        swal({
            title: "Add Partner Package",
            text: "Are you sure you want to add this partner to the package?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {

                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: API_URL + "packages/" + packageId + "/add-partner",
                        data: params,
                        dataType: "JSON",
                        headers: {
                            "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                            "Content-Type": "application/json"
                        },
                        success: function (response) {

                            if (response.status == "success") {
                                alertBox("Partner Added", response.message, "success")

                                setInterval(window.location.reload(), 5000)
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
                else {
                    alertBox("Cancel", "Add Partner to Package request cancelled", "info")
                }
            })
    }

}

function loadEditPackageModal() {
    document.getElementById('e_packageName').value = packageArray.package;
    document.getElementById('e_amount').value = packageArray.reg_amount;
    document.getElementById('e_upline1').value = packageArray.upline1;
    document.getElementById('e_upline3').value = packageArray.upline2;
    document.getElementById('e_upline2').value = packageArray.upline3;
    document.getElementById('e_upline4').value = packageArray.upline4;
    document.getElementById('e_description').value = packageArray.description;
}

function updatePackage() {

    let packageId = $('#package_id').val();
    let e_packageName = $('#e_packageName').val();
    let e_amount = $('#e_amount').val();
    let e_upline1 = $('#e_upline1').val();
    let e_upline3 = $('#e_upline3').val();
    let e_upline2 = $('#e_upline2').val();
    let e_upline4 = $('#e_upline4').val();
    let e_description = $('#e_description').val();

    const params = JSON.stringify({
        "package": e_packageName,
        "description": e_description,
        "reg_amount": e_amount,
        "upline1": e_upline1,
        "upline2": e_upline2,
        "upline3": e_upline3,
        "upline4": e_upline4
    })

    swal({
        title: "Update Package",
        text: "Are you sure you want to save the changes?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "PUT",
                    url: API_URL + "packages/" + packageId,
                    data: params,
                    dataType: "JSON",
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Package Updated", response.message, "success")

                            setInterval(window.location.reload(), 5000)
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
            else {
                alertBox("Cancel", "Package update request cancelled", "info")
            }
        })

}

function deletePackage(packageId) {
    swal({
        title: "Delete Package",
        text: "Are you sure you want to delete this package?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "DELETE",
                    url: API_URL + "packages/" + packageId,
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Package Deleted", response.message, "success")

                            setInterval(window.location = ADMIN_URL + "packages", 5000)
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
            else {
                alertBox("Cancel", "Package delete request cancelled", "info")
            }
        })

}

function removePartner(partnerId) {
    swal({
        title: "Remove Partner",
        text: "Are you sure you want to remove this partner?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "DELETE",
                    url: API_URL + "packages/remove-partner/" + partnerId,
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Partner Removed", response.message, "success")

                            setInterval(window.location.reload(), 5000)
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
            else {
                alertBox("Cancel", "Partner removal request cancelled", "info")
            }
        })
}

function loadBanks() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || Add Partner") {
        $.ajax({
            type: "GET",
            url: API_URL + "banks",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                if (response.status == "success") {

                    $("#bank").html("");
                    $("#bank").html('<option value="" selected>select bank name</option>');

                    response.data.forEach(element => {
                        let bankOption = '<option value="' + element.name + '">' + element.name + '</option>';

                        $("#bank").append(bankOption);
                    })
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

}
loadBanks();

function addPartner() {

    let partner = $("#partnerName").val();
    let bank = $("#bank").val();
    let accountName = $("#account_name").val();
    let accountNumber = $("#account_number").val();
    let description = $("#description").val();

    if (partner === "") {
        alertBox("Form Field Required", "Partner name is required", "warning")
    }
    else if (bank === "") {
        alertBox("Form Field Required", "Partner bank is required", "warning")
    }
    else if (accountName === "") {
        alertBox("Form Field Required", "Partner account name is required", "warning")
    }
    else if (accountNumber === "") {
        alertBox("Form Field Required", "Partner account number is required", "warning")
    }
    else if (description === "") {
        alertBox("Form Field Required", "Partner description is required", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning py-3 w-100 mb-4");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        const params = JSON.stringify({
            "partner": partner,
            "description": description,
            "bank": bank,
            "account_number": accountNumber,
            "account_name": accountName
        });

        $.ajax({
            type: "POST",
            url: API_URL + "partners",
            data: params,
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Add Partner';

                if (response.status == "success") {
                    alertBox("Partner Added", response.message, "success")

                    setInterval(window.location = ADMIN_URL + "partners", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Add Partner';

                alertBox("Error", response.responseJSON.message, "error")
            }
        });
    }

}

function fetchPartners() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Partners") {
        $.ajax({
            type: "GET",
            url: API_URL + "partners",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#partnerHtml').html('');
                    $('#partnerHtml').html("<h3 class='mb-4'>Partners</h3>");

                    response.data.forEach(element => {

                        let partnerBody = "<div class='col-sm-12 col-xl-6'>";
                            partnerBody += "<div class='bg-light rounded h-100 p-4'>";
                                partnerBody += "<label for='partner' >Partner</label>";
                                partnerBody += "<h6 class='mb-4'>" + element.partner + "</h6>";
                                partnerBody += "<label for='description' >Description</label>";
                                partnerBody += "<h6 class='mb-4'>" + element.description + "</h6>";
                                partnerBody += "<a href='" + ADMIN_URL + "partner/" + element.id + "' class='btn btn-primary py-3 w-50 mt-2'>View Partner</a>";
                            partnerBody += "</div>";
                        partnerBody += "</div>";

                        $('#partnerHtml').append(partnerBody);
                    });

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
fetchPartners()

function fetchSinglePartners() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Single Partner") {
        let partner_id = $("#partner_id").val();

        $.ajax({
            type: "GET",
            url: API_URL + "partners/" + partner_id,
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#singlePartnerHtml').html('');

                    let element = response.data;
                    partnerArray = element;

                    let partnerBody = "<div class='col-sm-7 col-xl-7'>";
                        partnerBody += "<div class='bg-light rounded h-100 p-4'>";
                            partnerBody += "<div class='row g-4'>";

                                partnerBody += "<h3 class='mb-4'>Partner Details</h3>";

                                partnerBody += "<div class='col-sm-6'>";
                                    partnerBody += "<label for='partner'>Partner</label>";
                                    partnerBody += "<h4 class='mb-4'>" + element.partner + "</h4>";
                                partnerBody += "</div>";

                                partnerBody += "<div class='col-sm-6'>";
                                    partnerBody += "<label for='Bank'>Bank</label>";
                                    partnerBody += "<h4 class='mb-4'>" + element.bank + "</h4>";
                                partnerBody += "</div>";

                                partnerBody += "<div class='col-sm-6'>";
                                    partnerBody += "<label for='Account Number'>Account Number</label>";
                                    partnerBody += "<h4 class='mb-4'>" + element.account_number + "</h4>";
                                partnerBody += "</div>";

                                partnerBody += "<div class='col-sm-6'>";
                                    partnerBody += "<label for='Account Name'>Account Name</label>";
                                    partnerBody += "<h4 class='mb-4'>" + element.account_name + "</h4>";
                                partnerBody += "</div>";

                                partnerBody += "<div class='col-sm-6'>";
                                    partnerBody += "<label for='created_at'>Date Created</label>";
                                    partnerBody += "<h5 class='mb-4'>" + formatDate(element.created_at) + "</h5>";
                                partnerBody += "</div>";

                                partnerBody += "<div class='col-sm-6'>";
                                    partnerBody += "<label for='updated_at'>Last Update</label>";
                                    partnerBody += "<h5 class='mb-4'>" + formatDate(element.updated_at) + "</h5>";
                                partnerBody += "</div>";

                                partnerBody += "<div class='col-sm-12'>";
                                    partnerBody += "<label for='Description'>Description</label>";
                                    partnerBody += "<h5 class='mb-4'>" + element.description + "</h5>";
                                partnerBody += "</div>";

                                partnerBody += "<div class='col-sm-6' >";
                                    partnerBody += "<button type='button' data-bs-toggle='modal' data-bs-target='#partnerEditModal' onclick='loadEditPartner()' title='click here to edit Partner' class='btn btn-primary py-3 w-100 mb-4' >Edit</button>";
                                partnerBody += "</div>";

                                partnerBody += "<div class='col-sm-6'>";
                                    partnerBody += "<button type='button' title='click here to delete Partner' class='btn btn-danger py-3 w-100 mb-4' onclick='deletePartner(" + '"' + element.id + '"' + ")' >Delete</button>";
                                partnerBody += "</div>";

                            partnerBody += "</div>";
                        partnerBody += "</div>";
                    partnerBody += "</div>";

                    partnerBody += "<div class='col-sm-5 col-xl-5'>";
                        partnerBody += "<div class='bg-light rounded h-100 p-4'>";
                            partnerBody += "<div class='row g-4' id='partnerWalletHtml'>";
                            partnerBody += "</div>";
                        partnerBody += "</div>";
                    partnerBody += "</div>";

                    $('#singlePartnerHtml').html(partnerBody);

                    loadPartnerWallet(element.id)

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
fetchSinglePartners()

function loadPartnerWallet(partnerId) {

    $.ajax({
        type: "GET",
        url: API_URL + "partners/" + partnerId + "/wallet",
        headers: {
            "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
            "Content-Type": "application/json"
        },
        success: function (response) {

            if (response.status == "success") {

                let element = response.data;

                let partnerWalletBody = "<h3 class='mb-4'>Partner\'s Wallet</h3>";

                partnerWalletBody += "<div class='col-sm-6'>";
                    partnerWalletBody += "<label for='partner'>Wallet Type</label>";
                    partnerWalletBody += "<h4 class='mb-4'>" + element.type + "</h4>";
                partnerWalletBody += "</div>";

                partnerWalletBody += "<div class='col-sm-6'>";
                    partnerWalletBody += "<label for='partner'>Total Balance</label>";
                    partnerWalletBody += "<h4 class='mb-4'>&#8358;" + element.balance + "</h4>";
                partnerWalletBody += "</div>";

                partnerWalletBody += "<div class='col-sm-6'>";
                    partnerWalletBody += "<label for='partner'>Total Credit</label>";
                    partnerWalletBody += "<h4 class='mb-4'>&#8358;" + element.total_credit + "</h4>";
                partnerWalletBody += "</div>";

                partnerWalletBody += "<div class='col-sm-6'>";
                    partnerWalletBody += "<label for='partner'>Total Debit</label>";
                    partnerWalletBody += "<h4 class='mb-4'>&#8358;" + element.total_debit + "</h4>";
                partnerWalletBody += "</div>";


                $('#partnerWalletHtml').html(partnerWalletBody);
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

function loadEditPartner() {
    document.getElementById('e_partner').value = partnerArray.partner;
    document.getElementById('bank').value = partnerArray.bank;
    document.getElementById('e_account_number').value = partnerArray.account_number;
    document.getElementById('e_account_name').value = partnerArray.account_name;
    document.getElementById('e_description').value = partnerArray.description;
}

function updatePartner() {

    let partnerId = $('#partner_id').val();
    let partner = $('#e_partner').val();
    let bank = $('#bank').val();
    let accountNumber = $('#e_account_number').val();
    let accountName = $('#e_account_name').val();
    let description = $('#e_description').val();

    const params = JSON.stringify({
        "partner": partner,
        "description": description,
        "bank": bank,
        "account_number": accountNumber,
        "account_name": accountName
    });

    swal({
        title: "Update Partner",
        text: "Are you sure you want to save the changes?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "PUT",
                    url: API_URL + "partners/" + partnerId,
                    data: params,
                    dataType: "JSON",
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Partner Updated", response.message, "success")

                            setInterval(window.location.reload(), 5000)
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
            else {
                alertBox("Cancel", "Partner update request cancelled", "info")
            }
        })

}

function deletePartner(partnerId) {
    swal({
        title: "Delete Partner",
        text: "Are you sure you want to delete this partner?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "DELETE",
                    url: API_URL + "partners/" + partnerId,
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Partner Deleted", response.message, "success")

                            setInterval(window.location = ADMIN_URL + "partners", 5000)
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
            else {
                alertBox("Cancel", "Partner delete request cancelled", "info")
            }
        })

}

function fetchSections() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Sections") {
        $.ajax({
            type: "GET",
            url: API_URL + "sections",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#sectionHtml').html('');
                    $('#sectionHtml').html("<h3 class='mb-4'>Sections</h3>");

                    response.data.forEach(element => {

                        let sectionBody = "<div class='col-sm-12 col-xl-6'>";
                            sectionBody += "<div class='bg-light rounded h-100 p-4'>";
                                sectionBody += "<label>Section Name</label>";
                                sectionBody += "<h6 class='mb-4'>" + element.section + "</h6>";
                                sectionBody += "<label for='amount'>Description</label>";
                                sectionBody += "<p class='mb-4'>" + element.description + "</p>";
                                sectionBody += "<a href='" + ADMIN_URL + "section/" + element.id + "' class='btn btn-primary py-3 w-50 mt-2'>View Section</a>";
                            sectionBody += "</div>";
                        sectionBody += "</div>";

                        $('#sectionHtml').append(sectionBody);
                    });
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
fetchSections()

function fetchSingleSection() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Single Section") {

        let section_id = $("#section_id").val();

        $.ajax({
            type: "GET",
            url: API_URL + "sections/" + section_id,
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#singleSectionHtml').html('');

                    let element = response.data;
                    sectionArray = element;

                    let sectionBody = "<div class='col-sm-12 col-xl-12'>";
                        sectionBody += "<div class='bg-light rounded h-100 p-4'>";
                            sectionBody += "<div class='row g-4'>";

                                sectionBody += "<h3 class='mb-4'>Section Details</h3>";

                                sectionBody += "<div class='col-sm-12'>";
                                    sectionBody += "<label>Section Name</label>";
                                    sectionBody += "<h6 class='mb-4'>" + element.section + "</h6>";
                                sectionBody += "</div>";

                                sectionBody += "<div class='col-sm-12'>";
                                    sectionBody += "<label for='amount'>Description</label>";
                                    sectionBody += "<p class='mb-4'>" + element.description + "</p>";
                                sectionBody += "</div>";

                                sectionBody += "<div class='col-sm-6'>";
                                    sectionBody += "<button type='button' data-bs-toggle='modal' data-bs-target='#sectionEditModal' onclick='loadEditSectionModal()' title='click here to edit Section' class='btn btn-primary py-3 w-100 mb-4' >Edit</button>";
                                sectionBody += "</div>";

                                sectionBody += "<div class='col-sm-6'>";
                                    sectionBody += "<button type='button' title='click here to delete Section' class='btn btn-danger py-3 w-100 mb-4' onclick='deleteSection(" + '"' + element.id + '"' + ")' >Delete</button>";
                                sectionBody += "</div>";

                            sectionBody += "</div>";
                        sectionBody += "</div>";
                    sectionBody += "</div>";

                    $('#singleSectionHtml').html(sectionBody);
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
fetchSingleSection()

function loadEditSectionModal() {
    document.getElementById('e_sectionName').value = sectionArray.section;
    document.getElementById('e_description').value = sectionArray.description;
}

function addSection() {

    let sectionName = $("#sectionName").val();
    let description = $("#description").val();

    if (sectionName === "") {
        alertBox("Form Field Required", "Section name is required", "warning")
    }
    else if (description === "") {
        alertBox("Form Field Required", "Section description is required", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning py-3 w-100 mb-4");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        const params = JSON.stringify({
            "section": sectionName,
            "description": description,
        });

        $.ajax({
            type: "POST",
            url: API_URL + "sections",
            data: params,
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Add Section';

                if (response.status == "success") {
                    alertBox("Section Added", response.message, "success")

                    setInterval(window.location = ADMIN_URL + "sections", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Add Section';

                alertBox("Error", response.responseJSON.message, "error")
            }
        });
    }

}

function updateSection() {

    let sectionId = $('#section_id').val();
    let sectionName = $('#e_sectionName').val();
    let description = $('#e_description').val();

    const params = JSON.stringify({
        "section": sectionName,
        "description": description
    });

    swal({
        title: "Update Section",
        text: "Are you sure you want to save the changes?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "PUT",
                    url: API_URL + "sections/" + sectionId,
                    data: params,
                    dataType: "JSON",
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Section Updated", response.message, "success")

                            setInterval(window.location.reload(), 5000)
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
            else {
                alertBox("Cancel", "Section update request cancelled", "info")
            }
        })

}

function deleteSection(sectionId) {
    swal({
        title: "Delete Section",
        text: "Are you sure you want to delete this Section?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "DELETE",
                    url: API_URL + "sections/" + sectionId,
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Section Deleted", response.message, "success")

                            setInterval(window.location = ADMIN_URL + "sections", 5000)
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
            else {
                alertBox("Cancel", "Section delete request cancelled", "info")
            }
        })

}


function fetchArticles() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Articles") {
        $.ajax({
            type: "GET",
            url: API_URL + "articles",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#articleHtml').html('');
                    $('#articleHtml').html("<h3 class='mb-4'>Articles</h3>");

                    console.log(response.data)
                    // response.data.forEach(element => {

                    //     let sectionBody = "<div class='col-sm-12 col-xl-6'>";
                    //         sectionBody += "<div class='bg-light rounded h-100 p-4'>";
                    //             sectionBody += "<label>Section Name</label>";
                    //             sectionBody += "<h6 class='mb-4'>" + element.section + "</h6>";
                    //             sectionBody += "<label for='amount'>Description</label>";
                    //             sectionBody += "<p class='mb-4'>" + element.description + "</p>";
                    //             sectionBody += "<a href='" + ADMIN_URL + "section/" + element.id + "' class='btn btn-primary py-3 w-50 mt-2'>View Section</a>";
                    //         sectionBody += "</div>";
                    //     sectionBody += "</div>";

                    //     $('#articleHtml').append(sectionBody);
                    // });
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
fetchArticles()

// Add Articles
let frm = $('#addArticleForm');

frm.submit(function (e) {
    
    e.preventDefault(e);

    let articleTitle = $("#title").val();
    let articleAuthor = $("#author").val();
    let articleImage = $("#filename").val();
    let articleSectionId = $("#section_id").val();
    let articleMinimunLevel = $("#minimum_level").val();
    let articleReleaseDate = $("#release_date").val();
    let articleContent = $("#content").val();


    if (articleTitle === "") {
        alertBox("Form Field Required", "Title is required", "warning")
    }
    else if (articleAuthor === "") {
        alertBox("Form Field Required", "Author is required", "warning")
    }
    else if (articleImage === "") {
        alertBox("Form Field Required", "Image file is required", "warning")
    }
    else if (articleSectionId === "") {
        alertBox("Form Field Required", "Section ID is required", "warning")
    }
    else if (articleMinimunLevel === "") {
        alertBox("Form Field Required", "Minimum level is required", "warning")
    }
    else if (articleReleaseDate === "") {
        alertBox("Form Field Required", "Release date is required", "warning")
    }
    else if (articleContent === "") {
        alertBox("Form Field Required", "Content is required", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning py-3 w-100 mb-4");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        let img = document.getElementById("filename").files[0];

        // let reader = new FileReader();
        
        // reader.readAsDataURL(img);
    
        // reader.onload = function() {
            let formData = new FormData();

            let imgObj = {
                "name": img.name,
                "size": img.size,
                "type": img.type
            }


            formData.append('title', articleTitle)
            formData.append('content', articleAuthor)
            formData.append('filename', img)
            formData.append('section_id', articleSectionId)
            formData.append('minimum_level', articleMinimunLevel)
            formData.append('author', articleReleaseDate)
            formData.append('release_date', articleContent)

            $.ajax({
                async: true,
                type: "POST",
                url: API_URL + "articles",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "Authorization": "Bearer " + sessionStorage.getItem('adminToken')
                },
                success: function (response) {
                    btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                    btnFunc.removeAttribute("disabled");
                    btnFunc.innerText = 'Add Article';

                    if (response.status == "success") {
                        alertBox("Section Added", response.message, "success")

                        setInterval(window.location = ADMIN_URL + "sections", 5000)
                    }
                    else {
                        alertBox("Error", response.message, "error")
                    }
                },
                error: function(response) {
                    btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                    btnFunc.removeAttribute("disabled");
                    btnFunc.innerText = 'Add Article';
                    
                    alertBox("Error", response.responseJSON.message, "error")
                }
            });
            
    
        // };
    
        // reader.onerror = function() {
        //     alertBox("Error", reader.error, "error")
        //     console.log(reader.error);
        // };
    }

})

function loadSections() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || Add Article") {
        $.ajax({
            type: "GET",
            url: API_URL + "sections",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                if (response.status == "success") {

                    $("#section_id").html("");
                    $("#section_id").html('<option value="" selected>Select Section</option>');

                    response.data.forEach(element => {
                        let sectionOption = '<option value="' + element.id + '">' + element.section + '</option>';

                        $("#section_id").append(sectionOption);
                    })
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

}
loadSections();

function addSignalProvider() {

    let fullName = $("#signal_fullname").val();
    let emailAddress = $("#signal_email").val();
    let phoneNumber = $("#signal_phoneNumber").val();

    if (fullName === "") {
        alertBox("Form Field Required", "Full name is required", "warning")
    }
    else if (emailAddress === "") {
        alertBox("Form Field Required", "Email address is required", "warning")
    }
    else if (phoneNumber === "") {
        alertBox("Form Field Required", "Phone number is required", "warning")
    }
    else if (phoneNumber.length > 11 || phoneNumber.length < 11) {
        alertBox("Form Field Required", "Phone number can't be lesser or greater than 11 digits", "warning")
    }
    else {

        btnFunc.setAttribute("class", "btn btn-warning py-3 w-100 mb-4");
        btnFunc.setAttribute("disabled", "disabled");
        btnFunc.innerHTML = '<div class="spinner-border"></div>';

        const params = JSON.stringify({
            "name": fullName,
            "email": emailAddress,
            "phone": phoneNumber,
        });

        $.ajax({
            type: "POST",
            url: API_URL + "signal-providers",
            data: params,
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Add Signal Provider';

                if (response.status == "success") {
                    alertBox("Signal Provider Added", response.message, "success")

                    setInterval(window.location = ADMIN_URL + "signalsProvider", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function (response) {
                btnFunc.setAttribute("class", "btn btn-primary py-3 w-100 mb-4");
                btnFunc.removeAttribute("disabled");
                btnFunc.innerText = 'Add Signal Provider';

                alertBox("Error", response.responseJSON.message, "error")
            }
        });
    }

}

function fetchSignalProvider() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Signals Provider") {
        $.ajax({
            type: "GET",
            url: API_URL + "signal-providers",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#SignalsProviderHtml').html('');
                    $('#SignalsProviderHtml').html("<h3 class='mb-4'>Signals Provider</h3>");

                    response.data.forEach(element => {

                        let status;
                        if (element.status == "0") {
                            status = "Not Verified";
                            statusClass = "text-danger";
                        }
                        else {
                            status = "Verified";
                            statusClass = "text-success";
                        }

                        let signalProviderBody = "<div class='col-sm-6 col-xl-6'>";
                            signalProviderBody += "<div class='bg-light rounded h-100 p-4'>";

                                signalProviderBody += "<label for=''>Fullname</label>";
                                signalProviderBody += "<h6 class='mb-4'>" + element.name + "</h6>";

                                signalProviderBody += "<label for=''>Email Address</label>";
                                signalProviderBody += "<h6 class='mb-4'>" + element.email + "</h6>";

                                signalProviderBody += "<label for=''>Phone Number</label>";
                                signalProviderBody += "<h6 class='mb-4'>" + element.phone + "</h6>";

                                signalProviderBody += "<label for=''>Status</label>";
                                signalProviderBody += "<h6 class='mb-4 " + statusClass + "'>" + status + "</h6>";

                                signalProviderBody += "<a href='" + ADMIN_URL + "signalProvider/" + element.id + "' class='btn btn-primary py-3 w-100 mt-2'>View Signal Provider</a>";

                            signalProviderBody += "</div>";
                        signalProviderBody += "</div>";

                        $('#SignalsProviderHtml').append(signalProviderBody);
                    });
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
fetchSignalProvider()

function fetchSingleSignalProvider() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Signal Provider") {

        let signalProvider_id = $("#signalProvider_id").val();

        $.ajax({
            type: "GET",
            url: API_URL + "signal-providers/" + signalProvider_id,
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function (response) {

                if (response.status == "success") {

                    $('#SignalProviderHtml').html('');

                    let element = response.data;
                    signalProviderArray = element;

                    let status;
                    if (element.status == "0") {
                        status = "Not Verified";
                        statusClass = "text-danger";
                    }
                    else {
                        status = "Verified";
                        statusClass = "text-success";
                    }

                    let signalProviderBody = "<div class='col-sm-12 col-xl-12'>";
                        signalProviderBody += "<div class='bg-light rounded h-100 p-4'>";
                            signalProviderBody += "<div class='row g-4'>";

                                signalProviderBody += "<h3 class='mb-4'>Signal Provider Details</h3>";

                                signalProviderBody += "<div class='col-sm-6'>";
                                    signalProviderBody += "<label>Fullname</label>";
                                    signalProviderBody += "<h5 class='mb-4'>" + element.name + "</h5>";
                                signalProviderBody += "</div>";

                                signalProviderBody += "<div class='col-sm-6'>";
                                    signalProviderBody += "<label for='amount'>Email Address</label>";
                                    signalProviderBody += "<h5 class='mb-4'>" + element.email + "</h5>";
                                signalProviderBody += "</div>";

                                signalProviderBody += "<div class='col-sm-6'>";
                                    signalProviderBody += "<label>Phone Number</label>";
                                    signalProviderBody += "<h5 class='mb-4'>" + element.phone + "</h5>";
                                signalProviderBody += "</div>";

                                signalProviderBody += "<div class='col-sm-6'>";
                                    signalProviderBody += "<label for=''>Status</label>";
                                    signalProviderBody += "<h5 class='mb-4 " + statusClass + "'>" + status + "</h5>";
                                signalProviderBody += "</div>";

                                signalProviderBody += "<div class='col-sm-6'>";
                                    signalProviderBody += "<label>Date Created</label>";
                                    signalProviderBody += "<h5 class='mb-4'>" + formatDate(element.created_at) + "</h5>";
                                signalProviderBody += "</div>";

                                signalProviderBody += "<div class='col-sm-6'>";
                                    signalProviderBody += "<label>Last Updated</label>";
                                    signalProviderBody += "<h5 class='mb-4'>" + formatDate(element.updated_at) + "</h5>";
                                signalProviderBody += "</div>";

                                signalProviderBody += "<div class='col-sm-6'>";
                                    signalProviderBody += "<button type='button' data-bs-toggle='modal' data-bs-target='#SignalProviderEditModal' onclick='loadEditSignalProviderModal()' title='click here to edit Signal Provider' class='btn btn-primary py-3 w-100 mb-4' >Edit</button>";
                                signalProviderBody += "</div>";

                                signalProviderBody += "<div class='col-sm-6'>";
                                    signalProviderBody += "<button type='button' title='click here to delete Signal Provider' class='btn btn-danger py-3 w-100 mb-4' onclick='deleteSignalProvider(" + '"' + element.id + '"' + ")' >Delete</button>";
                                signalProviderBody += "</div>";

                            signalProviderBody += "</div>";
                        signalProviderBody += "</div>";
                    signalProviderBody += "</div>";

                    $('#SignalProviderHtml').html(signalProviderBody);
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
fetchSingleSignalProvider()

function loadEditSignalProviderModal() {
    document.getElementById('e_name').value = signalProviderArray.name;
    document.getElementById('e_email').value = signalProviderArray.email;
    document.getElementById('e_phone').value = signalProviderArray.phone;
}

function updateSignalProvider() {

    let fullName = $("#e_name").val();
    let emailAddress = $("#e_email").val();
    let phoneNumber = $("#e_phone").val();
    let signalProvider_id = $("#signalProvider_id").val();

    if (fullName === "") {
        alertBox("Form Field Required", "Full name is required", "warning")
    }
    else if (emailAddress === "") {
        alertBox("Form Field Required", "Email address is required", "warning")
    }
    else if (phoneNumber === "") {
        alertBox("Form Field Required", "Phone number is required", "warning")
    }
    else if (phoneNumber.length > 11 || phoneNumber.length < 11) {
        alertBox("Form Field Required", "Phone number can't be lesser or greater than 11 digits", "warning")
    }
    else {

        const params = JSON.stringify({
            "name": fullName,
            "email": emailAddress,
            "phone": phoneNumber,
        });

        swal({
            title: "Update Signal Provider",
            text: "Are you sure you want to save the changes?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {

                if (willDelete) {

                    $.ajax({
                        type: "PUT",
                        url: API_URL + "signal-providers/" + signalProvider_id,
                        data: params,
                        dataType: "JSON",
                        headers: {
                            "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                            "Content-Type": "application/json"
                        },
                        success: function (response) {

                            if (response.status == "success") {
                                alertBox("Signal Provider Updated", response.message, "success")

                                setInterval(window.location.reload(), 5000)
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
                else {
                    alertBox("Cancel", "Signal Provider update request cancelled", "info")
                }
            })
    }

}

function deleteSignalProvider(signalProviderId) {
    swal({
        title: "Delete Signal Provider",
        text: "Are you sure you want to delete this Signal Provider?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

            if (willDelete) {

                $.ajax({
                    type: "DELETE",
                    url: API_URL + "signal-providers/" + signalProviderId,
                    headers: {
                        "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
                        "Content-Type": "application/json"
                    },
                    success: function (response) {

                        if (response.status == "success") {
                            alertBox("Signal Provider Deleted", response.message, "success")

                            setInterval(window.location = ADMIN_URL + "signalsProvider", 5000)
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
            else {
                alertBox("Cancel", "Signal Provider delete request cancelled", "info")
            }
        })

}

function fetchSignals() {

    let getPage = document.title;

    if (getPage == "Gemtrust Dashboard || View Signals") {
        $.ajax({
            type: "GET",
            url: API_URL + "signals",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
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

                                signalSection += "<a href='" + ADMIN_URL + "signal/" + element.id + "' class='btn btn-primary py-3 w-50 mt-2'>View Signal</a>";
                           
                            signalSection += "</div>";
                        signalSection += "</div>";

                        $('#signalsHtml').append(signalSection);
                    });

                    let signalPagination = "<div class='col-sm-12 col-xl-12 mt-4'>";
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
                "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
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



var admin_del_buttons = document.querySelectorAll(".del_admin");
for (let i = 0; i < admin_del_buttons.length; i++) {
    del_button = admin_del_buttons[i];

    del_button.onclick = function (e) {
        var admin_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL + "users/" + admin_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                if (response.status == "success") {
                    toaster_success(response.message);

                    $("tr#admin" + admin_id).fadeOut(1500);
                }
            },
            error: function (response) {
                toaster_error(response.responseText);
            }
        })
    }
}

var series_message_div = document.querySelectorAll(".show_series_message");
for (let i = 0; i <= series_message_div.length - 1; i++) {
    series = series_message_div[i];

    series.onclick = function (e) {
        var id = e.target.dataset['id'];

        $.ajax({
            type: "GET",
            url: API_URL + "messages/" + id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                if (response.status == "success") {
                    var data = response.data;

                    $("#series_message_modal h5.modal-title").html(data.title);
                    var output = '<div class="row"><img src="' + data.image_path + '" style="width: 400px; max-width:80%; margin: 0 auto" /></div>';
                    output += '<div class="row">';
                    output += '<div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-2"><audio src="' + data.audio_path + '" style="margin: 0 auto" controls></audio></div>'
                    output += '</div>';
                    output += '<div class="row text-dark">';
                    output += '<div class="col-lg-9 col-md-12 mx-auto">';
                    output += '<p><strong>Date Preached: </strong>' + data.date_preached + '</p>';
                    output += '<p>' + data.description + '</p>';
                    output += '</div>';
                    output += '</div>';
                    $("#series_message_modal div.modal-body").html(output);
                } else {
                    $("#series_message_modal .modal-body").html(response.message);
                }
            },
            error: function (response) {
                toaster_error(response.responseText);
            }
        })
    };
    //console.log(i);
}

del_series = document.querySelector("#delete_series");
if (del_series) {
    del_series.onclick = function (e) {
        var series_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL + "series/" + series_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function (response) {
                if (response.status == "success") {
                    toaster_success(response.message);

                    window.location = ADMIN_URL + "message-series";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function (response) {
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.message_form").submit(function (e) {
    e.preventDefault();

    var title = $("input#message_title").val();
    var minister = $("select#message_minister").val();
    var image_files = $('#image_upload')[0].files;
    var audio_files = $("input#audio_upload")[0].files;
    var data_id = e.target.dataset['id'];
    if (data_id == "") {
        if ((title == "") || (minister == "") || (image_files.length < 1) || (audio_files.length < 1)) {
            var error_message = "";
            if (title == "") {
                error_message += "Message Title must be provided! ";
            }
            if (minister == "") {
                error_message += "Minister must be provided! ";
            }
            if (image_files.length < 1) {
                error_message += "Message Album Art must be uploaded! ";
            }
            if (audio_files.length < 1) {
                error_message += "Message Audio File must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        image_file = image_files[0].type;
        if ((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")) {
            toaster_error("Wrong Image Filetype");
            return false;
        }

        audio_file = audio_files[0].type;
        if ((audio_file != "audio/mp3") && (audio_file != "audio/mpeg3") && (audio_file != "audio/mpeg")) {
            toaster_error("Wrong Audio File upload");
            console.log(audio_file);
            return false;
        }

        url = API_URL + "messages";
    } else {
        if ((title == "") || (minister == "")) {
            var error_message = "";
            if (title == "") {
                error_message += "Message Title must be provided! ";
            }
            if (minister == "") {
                error_message += "Minister must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        if (image_files.length > 0) {
            image_file = image_files[0].type;
            if ((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")) {
                toaster_error("Wrong Image Filetype");
                return false;
            }
        }

        if (audio_files.length > 0) {
            audio_file = audio_files[0].type;
            if ((audio_file != "audio/mp3") && (audio_file != "audio/mpeg3") && (audio_file != "audio/mpeg")) {
                toaster_error("Wrong Audio File upload");
                return false;
            }
        }

        url = API_URL + "messages/" + data_id;
    }
    var fd = new FormData(document.querySelector(".message_form"));
    toaster_success("Message Uploading...");
    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + sessionStorage.getItem('token')
        },
        success: function (response) {
            if (response.status == "success") {
                toaster_success(response.message);
                if (data_id == "") {
                    var redirect = $("input#redirect");
                    if (redirect) {
                        window.location = ADMIN_URL + "message-series/" + redirect.val();
                    } else {
                        window.location = ADMIN_URL + "messages";
                    }
                } else {
                    window.location = ADMIN_URL + "messages/" + response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function (response) {
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});


$("form.book_form").submit(function (e) {
    e.preventDefault();

    var title = $("input#book_title").val();
    var minister = $("select#book_author").val();
    var image_files = $('#image_upload')[0].files;
    var pdf_files = $("input#pdf_upload")[0].files;
    var data_id = e.target.dataset['id'];

    if (data_id == "") {
        if ((title == "") || (minister == "") || (image_files.length < 1) || (pdf_files.length < 1)) {
            var error_message = "";
            if (title == "") {
                error_message += "Book Title must be provided! ";
            }
            if (minister == "") {
                error_message += "Author must be provided! ";
            }
            if (image_files.length < 1) {
                error_message += "Book Cover Image must be uploaded! ";
            }
            if (pdf_files.length < 1) {
                error_message += "Book PDF File must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        image_file = image_files[0].type;
        if ((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")) {
            toaster_error("Wrong Image Filetype");
            return false;
        }

        pdf_file = pdf_files[0].type;
        if (pdf_file != "application/pdf") {
            toaster_error("Wrong File Format Uploaded for Books");
            console.log(audio_file);
            return false;
        }

        url = API_URL + "books";
    } else {
        if ((title == "") || (minister == "")) {
            var error_message = "";
            if (title == "") {
                error_message += "Book Title must be provided! ";
            }
            if (minister == "") {
                error_message += "Author must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        if (image_files.length > 0) {
            image_file = image_files[0].type;
            if ((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")) {
                toaster_error("Wrong Image Filetype");
                return false;
            }
        }

        if (pdf_files.length > 0) {
            pdf_file = pdf_files[0].type;
            if (pdf_file != "application/pdf") {
                toaster_error("Wrong File Format Uploaded for Books");
                return false;
            }
        }

        url = API_URL + "books/" + data_id;
    }
    var fd = new FormData(document.querySelector(".book_form"));
    toaster_success("Book Uploading...");
    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Authorization": "Bearer " + sessionStorage.getItem('token')
        },
        success: function (response) {
            if (response.status == "success") {
                toaster_success(response.message);
                if (data_id == "") {
                    window.location = ADMIN_URL + "books"
                } else {
                    window.location = ADMIN_URL + "books/" + response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function (response) {
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});


function adminLogout() {

    $.ajax({
        type: "GET",
        url: API_URL + "logout",
        headers: {
            "Authorization": "Bearer " + sessionStorage.getItem('adminToken'),
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

var currSeconds = 0;

$(document).ready(function () {

    setInterval(timerIncrement, 1000);

    $(this).mousemove(resetTimer);
    $(this).keypress(resetTimer);
    
})

function timerIncrement() {
    currSeconds = currSeconds + 1;

    if (currSeconds == 600) {
        sessionStorage.clear();
        window.location = "/admin/login";
    }
}

function resetTimer() {
    currSeconds = 0;
}

document.querySelectorAll("#adminName").forEach(element => {
    element.innerText = sessionStorage.getItem('adminName');
})