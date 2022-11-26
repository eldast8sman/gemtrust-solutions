var BASE_URL = "http://localhost/";
var ADMIN_URL = BASE_URL + "admin/";

if (sessionStorage.getItem('adminToken') == null || sessionStorage.getItem('adminToken') == '') {
    window.location = ADMIN_URL + 'login'
}