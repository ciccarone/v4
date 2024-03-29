<div>
  <?php
  echo $section_headings;
  echo $section_texts;
  $cards['count'] = $page_section['card_count'];
  $cards['limit'] = $page_section['card_limit'];
  $cards['query'] = $page_section['card_query'];
  $cards['category'] = $page_section['card_category'];
  $cards['type'] = $page_section['card_type'];
  $cards['type_class'] = $page_section['card_type'] == 'full' ? 'v4-index__layout--full' : '';
  $cards['category_condition'] = $page_section['card_category_condition'];
  $cards['border_radius'] = $page_section['card_border_radius'] ? 'global_border_radius' : '';
  ?>

  <div class="v4-cards v4-cards__count--<?php echo $cards['count']; ?> grid <?php echo $cards['type_class'];?>">
    <?php
    echo v4_dynamic_cards($cards);
    ?>
  </div>

</div>