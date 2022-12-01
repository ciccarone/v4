<div>
  <?php
    echo $section_headings;
    echo $section_texts;
    $cards['count'] = $page_section['card_count'];
    $cards['query'] = $page_section['card_query'];
    $cards['category'] = $page_section['card_category'];
    $cards['category_condition'] = $page_section['card_category_condition'];
    $cards['border_radius'] = $page_section['card_border_radius'] ? 'global_border_radius' : '';
  ?>

  <div class="v4-cards v4-cards__count--<?php echo $cards['count']; ?> grid">
    <?php
      echo v4_dynamic_cards($cards);
    ?>
  </div>

</div>
