jQuery().ready(function($) {
  $("#post").validate({rules: {
    facebook: "url",
    instagram: "url",
    address: "required"
  }});

});
