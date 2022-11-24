var BASE_URL = "http://localhost/";
var ADMIN_URL = BASE_URL + "admin/"
var API_URL = BASE_URL + "api/admin/";


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
            error: function(response) {
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
            url: API_URL+"admins",
            data: params,
            contentType: "json",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if (response.status == "success") {
                    alertBox("Login Successful", response.message, "success")

                    setInterval(window.location = ADMIN_URL+"viewAdmins", 5000)
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function(response){
                alertBox("Error", response.responseJSON.message, "error")
            }
        });
    }

}


function fetchAdmins() {

    let getUrl = document.URL;

    if (getUrl == ADMIN_URL+"viewAdmins") {
        $.ajax({
            type: "GET",
            url: API_URL+"admins",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('adminToken'),
                "Content-Type": "application/json"
            },
            success: function(response){
                
                if (response.status == "success") {

                    let sn = 1;

                    $('#tableBody').html('');
                        
                    let tableSet = response.data.forEach(element => {
                        let tableBody = "<tr>";
                            tableBody += "<th scope='row'>" + sn++ +"</th>";
                            tableBody += "<td>"+ element.name +"</td>";
                            tableBody += "<td>"+ element.email +"</td>";
                            tableBody += "<td>"+ element.created_at +"</td>";
                        tableBody += "</tr>";
                        
                        $('#tableBody').append(tableBody);
                    });

                    dataTable();
                }
                else {
                    alertBox("Error", response.message, "error")
                }
            },
            error: function(response){
                alertBox("Error", response.responseJSON.message, "error")
            }
        })
    }
    
}

fetchAdmins()


if($("input#action").val() == "update"){
    var admin_id = $("input#admin_id").val();
    var password_div = $("input#admin_password").parent();
    password_div.hide();
    $.ajax({
        type: "GET",
        url: API_URL+"users/"+admin_id,
        dataType: "json",
        headers: {
            "Authorization": "Bearer "+sessionStorage.getItem('token'),
            "Content-Type": "application/json"
        },
        success: function(response){
            if(response.status == "success"){
                data = response.data;

                $("input#admin_name").val(data.name);
                $("input#admin_email").val(data.email);
            }
        },
        error: function(response){
            console.log(response.responseText);
        }
    })
}



var admin_del_buttons = document.querySelectorAll(".del_admin");
for(let i=0; i < admin_del_buttons.length; i++){
    del_button = admin_del_buttons[i];

    del_button.onclick = function(e){
        var admin_id = e.target.dataset['id'];

        $.ajax({
            type: "DELETE",
            url: API_URL+"users/"+admin_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);

                    $("tr#admin"+admin_id).fadeOut(1500);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

var series_message_div = document.querySelectorAll(".show_series_message");
for(let i=0; i<=series_message_div.length-1; i++){
    series = series_message_div[i];
    
    series.onclick = function(e){
        var id = e.target.dataset['id'];

        $.ajax({
            type: "GET",
            url: API_URL+"messages/"+id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    var data = response.data;

                    $("#series_message_modal h5.modal-title").html(data.title);
                    var output = '<div class="row"><img src="'+data.image_path+'" style="width: 400px; max-width:80%; margin: 0 auto" /></div>';
                    output +=   '<div class="row">';
                    output +=       '<div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-2"><audio src="'+data.audio_path+'" style="margin: 0 auto" controls></audio></div>'
                    output +=   '</div>';
                    output +=   '<div class="row text-dark">';
                    output +=       '<div class="col-lg-9 col-md-12 mx-auto">';
                    output +=           '<p><strong>Date Preached: </strong>'+ data.date_preached +'</p>';
                    output +=           '<p>'+data.description+'</p>';
                    output +=       '</div>';
                    output +=   '</div>';
                    $("#series_message_modal div.modal-body").html(output);
                } else {
                    $("#series_message_modal .modal-body").html(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    };
    //console.log(i);
}

del_series = document.querySelector("#delete_series");
if(del_series){
    del_series.onclick = function(e){
        var series_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"series/"+series_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"message-series";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.message_form").submit(function(e){
    e.preventDefault();

    var title = $("input#message_title").val();
    var minister = $("select#message_minister").val();
    var image_files = $('#image_upload')[0].files;
    var audio_files = $("input#audio_upload")[0].files;
    var data_id = e.target.dataset['id'];
    if(data_id == ""){
        if((title == "") || (minister == "") || (image_files.length < 1) || (audio_files.length < 1)){
            var error_message = "";
            if(title == ""){
                error_message += "Message Title must be provided! ";
            }
            if(minister == ""){
                error_message += "Minister must be provided! ";
            }
            if(image_files.length < 1){
                error_message += "Message Album Art must be uploaded! ";
            }
            if(audio_files.length < 1){
                error_message += "Message Audio File must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }

        audio_file = audio_files[0].type;
        if((audio_file != "audio/mp3") && (audio_file != "audio/mpeg3") && (audio_file != "audio/mpeg")){
            toaster_error("Wrong Audio File upload");
            console.log(audio_file);
            return false;
        }

        url = API_URL+"messages";
    } else {
        if((title == "") || (minister == "")){
            var error_message = "";
            if(title == ""){
                error_message += "Message Title must be provided! ";
            }
            if(minister == ""){
                error_message += "Minister must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        if(image_files.length > 0){
            image_file = image_files[0].type;
            if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
                toaster_error("Wrong Image Filetype");
                return false;
            }
        }
        
        if(audio_files.length > 0){
            audio_file = audio_files[0].type;
            if((audio_file != "audio/mp3") && (audio_file != "audio/mpeg3") && (audio_file != "audio/mpeg")){
                toaster_error("Wrong Audio File upload");
                return false;
            }
        }
        
        url = API_URL+"messages/"+data_id;
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
            "Authorization": "Bearer "+sessionStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                if(data_id == ""){
                    var redirect = $("input#redirect");
                    if(redirect){
                        window.location= ADMIN_URL+"message-series/"+redirect.val();
                    } else {
                        window.location = ADMIN_URL+"messages";
                    }
                } else {
                    window.location = ADMIN_URL+"messages/"+response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

del_message = document.querySelector("#delete_message");
if(del_message){
    del_message.onclick = function(e){
        var msg_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"messages/"+msg_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"messages";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}

$("form.book_form").submit(function(e){
    e.preventDefault();

    var title = $("input#book_title").val();
    var minister = $("select#book_author").val();
    var image_files = $('#image_upload')[0].files;
    var pdf_files = $("input#pdf_upload")[0].files;
    var data_id = e.target.dataset['id'];

    if(data_id == ""){
        if((title == "") || (minister == "") || (image_files.length < 1) || (pdf_files.length < 1)){
            var error_message = "";
            if(title == ""){
                error_message += "Book Title must be provided! ";
            }
            if(minister == ""){
                error_message += "Author must be provided! ";
            }
            if(image_files.length < 1){
                error_message += "Book Cover Image must be uploaded! ";
            }
            if(pdf_files.length < 1){
                error_message += "Book PDF File must be uploaded! ";
            }
            toaster_error(error_message);
            return false;
        }

        image_file = image_files[0].type;
        if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
            toaster_error("Wrong Image Filetype");
            return false;
        }

        pdf_file = pdf_files[0].type;
        if(pdf_file != "application/pdf"){
            toaster_error("Wrong File Format Uploaded for Books");
            console.log(audio_file);
            return false;
        }

        url = API_URL+"books";
    } else {
        if((title == "") || (minister == "")){
            var error_message = "";
            if(title == ""){
                error_message += "Book Title must be provided! ";
            }
            if(minister == ""){
                error_message += "Author must be provided! ";
            }
            toaster_error(error_message);
            return false;
        }

        if(image_files.length > 0){
            image_file = image_files[0].type;
            if((image_file != "image/jpg") && (image_file != "image/jpeg") && (image_file != "image/png")){
                toaster_error("Wrong Image Filetype");
                return false;
            }
        }
        
        if(pdf_files.length > 0){
            pdf_file = pdf_files[0].type;
            if(pdf_file != "application/pdf"){
                toaster_error("Wrong File Format Uploaded for Books");
                return false;
            }
        }
        
        url = API_URL+"books/"+data_id;
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
            "Authorization": "Bearer "+sessionStorage.getItem('token')
        },
        success: function(response){
            if(response.status == "success"){
                toaster_success(response.message);
                if(data_id == ""){
                    window.location= ADMIN_URL+"books"
                } else {
                    window.location = ADMIN_URL+"books/"+response.data.slug
                }
            } else {
                toaster_error(response.message);
            }
        },
        error: function(response){
            console.log(response.responseText);
            toaster_error(response.responseText);
        }
    })
});

del_book = document.querySelector("#delete_book");
if(del_book){
    del_book.onclick = function(e){
        var book_id = e.target.dataset['id'];
    
        $.ajax({
            type: "DELETE",
            url: API_URL+"books/"+book_id,
            dataType: "json",
            headers: {
                "Authorization": "Bearer "+sessionStorage.getItem('token'),
                "Content-Type": "application/json"
            },
            success: function(response){
                if(response.status == "success"){
                    toaster_success(response.message);
    
                    window.location = ADMIN_URL+"books";
                } else {
                    toaster_error(response.message);
                }
            },
            error: function(response){
                toaster_error(response.responseText);
            }
        })
    }
}



function adminLogout() {

    $.ajax({
        type: "GET",
        url: API_URL+"logout",
        headers: {
            "Authorization": "Bearer "+sessionStorage.getItem('adminToken'),
            "Content-Type": "application/json"
        },
        success: function(response){
            
            if (response.status == "success") {
                sessionStorage.clear() 

                alertBox("Logout Successful", response.message, "success")

                setInterval(window.location = ADMIN_URL, 3000)
            }
            else {
                alertBox("Error", response.message, "error")
            }
        },
        error: function(response){
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

let adminNames = document.querySelectorAll("#adminName").forEach(element => {
    element.innerText = sessionStorage.getItem('adminName');
})