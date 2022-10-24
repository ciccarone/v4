<?php

$cta_padding_tb = isset($page_section['cta_padding']['padding_options_top_bottom']) ? $page_section['cta_padding']['padding_options_top_bottom'] : '';

$cta_padding_lr = isset($page_section['cta_padding']['padding_options_left_right']) ? $page_section['cta_padding']['padding_options_left_right'] : '';
?>

<div class="bg-color__<?php echo $page_section['cta_background_color']['color_names'] . ' ' . $cta_padding_tb . ' ' . $cta_padding_lr ;?>">
  <?php echo $section_headings; ?>
  <?php echo $section_texts; ?>
  <?php echo $section_buttons; ?>
</div>
