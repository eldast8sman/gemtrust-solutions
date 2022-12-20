
if (sessionStorage.getItem('spToken') == null || sessionStorage.getItem('spToken') == '') {
    window.location = "/signalsProvider/login";
}

// () => {
//     let title = document.title;

//     if (title == "Gemtrust Dashboard || Signal Provider || Account Activation") {
//         if (sessionStorage.getItem('spToken') !== null || sessionStorage.getItem('spToken') !== '') {
//             window.location = "/signalsProvider/login";
//         }
//     }
// }