
if (sessionStorage.getItem('spToken') == null || sessionStorage.getItem('spToken') == '') {
    window.location = "/signalsProvider/login";
}