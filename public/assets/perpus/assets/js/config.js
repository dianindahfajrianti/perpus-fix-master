$(document).ready(function () {
  $(".btn-filter").click(function (e) {
    e.preventDefault;
    // var x = document.getElementById("myDIV");
    // if (x.style.display === "none") {
    //   x.style.display = "block";
    // } else {
    //   x.style.display = "none";
    // }
    var sidebar = $('.sidebar');
    if(sidebar.is(":hidden")){  
      sidebar.show();
      sidebar.addClass("d-block");
      sidebar.removeClass("d-none");
    } else{
      sidebar.hide();
      sidebar.addClass("d-none");
      sidebar.addClass("d-lg-block");
      sidebar.removeClass("d-block");
    }
  });
//   $(".btn-filter").click(function () {
//   // show hide paragraph on button click
//   });
});
