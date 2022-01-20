$(document).ready(function () {
  $(".btn-filter").click(function (e) {
    e.preventDefault;
    // var x = document.getElementById("myDIV");
    // if (x.style.display === "none") {
    //   x.style.display = "block";
    // } else {
    //   x.style.display = "none";
    // }
    alert("check");
    var sidebar = $('.sidebar');
    if(sidebar.is(":visible")){
        sidebar.hide();
        sidebar.addClass("d-none");
        sidebar.removeClass("d-lg-block");
    } else{
        sidebar.show();
    }
  });
//   $(".btn-filter").click(function () {
//   // show hide paragraph on button click
//   });
});
