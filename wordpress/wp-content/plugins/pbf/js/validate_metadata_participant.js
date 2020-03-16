jQuery().ready(function($) {
  $.validator.addMethod(
    "exactly_one_category",
    function(value, element) {
      var categories = $("input[name='tax_input[participant_cat][]']:checked");
      return categories.length == 0;
    },
    "Sélectionnez une et une seule catégorie"
  );

  $.validator.setDefaults({
    ignore: [],
    // any other default options and/or rules
  });

  $("#post").validate({rules: {
    facebook: "url",
    instagram: "url",
    address: "required",
    "tax_input[participant_cat][]": "exactly_one_category"
  }});

});
