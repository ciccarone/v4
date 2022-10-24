<div class="container">
  <?php
    echo $section_headings;
    echo $section_texts;
    $cards['count'] = $page_section['card_count'];
    $cards['query'] = $page_section['card_query'];
  ?>

  <div class="v4-cards v4-cards__count--<?php echo $cards['count']; ?>">
    <?php
      echo v4_dynamic_cards($cards);
    ?>
  </div>

</div>
