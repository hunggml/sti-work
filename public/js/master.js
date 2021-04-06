$(".toggle-password").click(function () {

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
    let day = time.getDate();
    let month = time.getMonth() + 1;
    let years = time.getFullYear();
    let hour = time.getHours();
    let minute = time.getMinutes();
    let sescord = time.getSeconds();
    if (hour < 10) {
        hour = "0" + hour;
    }
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    if (minute < 10) {
        minute = "0" + minute;
    }
    if (sescord < 10) {
        sescord = "0" + sescord;
    }
    document.getElementById('time').innerHTML = years + "/" + month + "/" + day + " - " + hour + ":" + minute + ":" +
        sescord;
    setTimeout("time()", 1000);
}
time();
// $(function () {
//     $("#worktable").DataTable({
//         "paging": false,
//         "lengthChange": false,
//         "searching": false,
//         "ordering": false,
//         "info": false,
//         "autoWidth": false,
//         "responsive": true,
//     });

// });
// $(function () {
//     $("#statiscal").DataTable({
//         "paging": false,
//       "lengthChange": false,
//       "searching": true,
//       "ordering": false,
//       "info": false,
//       "autoWidth": false,
//       "responsive": true,
//     });

// });