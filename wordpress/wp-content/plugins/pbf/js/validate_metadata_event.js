jQuery().ready(function($) {
  $.validator.addMethod(
    "regex",
    function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Heure au format 00:00"
  );

  $.validator.addMethod(
    "at_least_one_organizer",
    function(value, element) {
      var value = $("#organizers").val();
      return value != undefined && value != "";
    },
    "Sélectionnez au moins un participant!"
  );

  $("#post").validate({rules: {
    start_date: "required",
    start_time: {regex: "^\\d\\d:\\d\\d$" },
    end_time: { regex: "^\\d\\d:\\d\\d$" },
    title_organizer: {at_least_one_organizer: true},
    facebook: "url"
  }});
});
