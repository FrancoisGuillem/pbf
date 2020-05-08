<?php

function field_schedule($post)
{
  $metadata = get_post_meta($post->ID);

  wp_nonce_field('save_pbf_post', 'field_schedule');

?>
  <p><span class='field-label'>Date de début:</span>
    <input type="text" id="start_date" name="start_date" value="<?= $metadata["start_date"][0] ?? "" ?>">
  </p>
  <p><span class='field-label'>Date de fin: </span>
    <input type="text" id="end_date" name="end_date" value="<?= $metadata["end_date"][0] ?? "" ?>">
    (Ne remplir que si l'évènement dure plusieurs jours)
  </p>
  <p><span class='field-label'>Heure de début:</span>
    <input type="text" id="start_time" name="start_time" value="<?= $metadata["start_time"][0] ?? "" ?>" placeholder="HH:MM">
  </p>
  <p><span class='field-label'>Heure de fin: </span>
    <input type="text" id="end_time" name="end_time" value="<?= $metadata["end_time"][0] ?? "" ?>" placeholder="HH:MM">
    (Optionnel)
  </p>
  <script type="text/javascript">
    jQuery(function($) {
      $("#start_date").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: "2020-10-03",
        maxDate: "2020-10-11",
        showOtherMonths: true,
        selectOtherMonths: true
      });

      $("#end_date").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: "2020-10-03",
        maxDate: "2020-10-11",
        showOtherMonths: true,
        selectOtherMonths: true
      });

    });
  </script>
  <style media="screen">
    .field-label {
      width: 120px;
      display: inline-block;
    }
  </style>
<?php
}

?>
