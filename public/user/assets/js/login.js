
if (sessionStorage.getItem('userToken') == null || sessionStorage.getItem('userToken') == '') {
    window.location = "/users/login";
}