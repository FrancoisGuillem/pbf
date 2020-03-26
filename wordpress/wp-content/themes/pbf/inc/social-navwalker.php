<?php

if (!class_exists('Social_Walker')) {
  class Social_Walker extends Walker
  {
    public function walk($elements, $max_depth, ...$args)
    {
      $list = array();

      foreach ($elements as $item) {
        $icon = $item->classes[0];
        $target = '';

        if (!empty($item->target)) {
          $target = " target='$item->target' rel='noopener noreferrer'";
        }

        $list[] = "<li><a href='$item->url'$target>" . file_get_contents('assets/' . $icon . '.svg.php', TRUE) . "<span>$item->title</span></a></li>";
      }

      return join("\n", $list);
    }
  }
}
