var BASE_URL = "http://127.0.0.1:8000/";
var ADMIN_URL = BASE_URL + "admin/";

if (sessionStorage.getItem('adminToken') == null || sessionStorage.getItem('adminToken') == '') {
    window.location = ADMIN_URL + 'login'
}