jQuery().ready(function($) {

  $("#post").validate({rules: {
    facebook: "url",
    instagram: "url",
    website: "url",
    partner_level: {
      required: true,
      min: 1,
      max: 4
    }
  }});

});
