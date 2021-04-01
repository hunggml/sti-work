$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
function time() {
        let time = new Date();
        let day = time.getDay();
        let month = time.getMonth();
        let years = time.getFullYear();
        let hour = time.getHours();
        let minute = time.getMinutes();
        let sescord = time.getSeconds();
        if (hour < 10) {
            hour = "0" + hour;
        }
        if (minute < 10) {
            minute = "0" + minute;
        }
        if (sescord < 10) {
            sescord = "0" + sescord;
        }
        document.getElementById('time').innerHTML = day + "/" + month + "/" + years + "-" + hour + ":" + minute + ":" +
            sescord;
        setTimeout("time()", 1000);
    }
    time();