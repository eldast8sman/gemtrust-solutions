
if (sessionStorage.getItem('adminToken') == null || sessionStorage.getItem('adminToken') == '') {
    window.location = "/admin/login";
}