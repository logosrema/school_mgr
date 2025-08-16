$(function() {
  function showToast(title, message, type) {
    $.toast({
      position: "bottom-right",
      title: title,
      message: message,
      type: type,
      duration: 3000 // auto-dismiss after 3s
    });
  }


  const request = (url, params) => {
   // let elem = $(".load");
   // elem.addClass("bx-loader bx-spin").removeClass("bx-check-shieldn");
   // setTimeout(() => {
      $.post(url, params, function(result) {
        console.log(result)
        return

        if (JSON.parse(result).type == "success") {
          elem.removeClass("bx-loader bx-spin").addClass("bx-check-shieldn");
          showToast(
            "Success",
            "Signin successful",
            "success"
          );
          setTimeout(function() {
            window.location.href = JSON.parse(result).url;
          }, 1000);
        } else {
          elem.removeClass("bx-loader bx-spin").addClass("bx-check-shieldn");
          showToast(
            "Heads up!!",
            "Invalid email or password",
            "error"
          );
        }
      });
   // }, 1000);
  };

  $(".signin").on("click", function(evt) {
   // console.log("hello")
    evt.preventDefault();
    let params = {
      email: $("#card-email").val().trim(),
      password: $("#card-password").val().trim()
    };
    let isEmpty = Object.values(params).some(param => param === "");
    !isEmpty? request("admin/signin", params): showToast( "Heads up!!","All fields are mandatory", "info");
  });


  
});
