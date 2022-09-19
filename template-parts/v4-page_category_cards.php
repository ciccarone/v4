<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php // var_dump($page_section['page_category_cards']); ?>
      <?php
        foreach ($page_section['page_category_cards'] as $card) {
          // var_dump($card);
          $card_image = $card['image_option'];
          echo v4_card_image_generator($card);

          $card_title = $card['title_override'];
          echo v4_heading_generator($card_title['heading_repeater']);
        }
      ?>
    </div>

  </div>
</div>
