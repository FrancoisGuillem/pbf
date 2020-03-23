<?php
/**
 * Template pour afficher un partenaire dans la page qui liste tous les partenaires.
 *
 * Variables
 *----------
 * $title: nom du partenaire
 * $thumbnail: logo du partenaires
 * $content: description du partenaires
 *, $facebook, $instagram, $website: liens sociaux
 *
 * @package pbf
 */

 $title = get_the_title();
 $thumbnail = get_the_post_thumbnail_url();
 $content = get_the_content();

$metadata = get_post_meta(get_the_ID());
$facebook = $metadata["facebook"][0] ?? "";
$instagram = $metadata["instagram"][0] ?? "";
$website = $metadata["website"][0] ?? "";

?>

<article class="event-detail">
  <div class="event-detail-content">
    <h2 class="event-detail-title">
      <?= $title; ?>
    </h2>
    <?= $content; ?>
  </div>
</article>
