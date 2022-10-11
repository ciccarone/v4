<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
        foreach ($page_section['page_category_cards'] as $card) {
          // var_dump($card);
          $card_title = $card['title_override'];
          echo '<div class="v4-card bg-color__'.$card['card_background_color_color_names'].'">';
            echo v4_card_image_generator($card);
            echo '<div class="v4-card__content">';
              echo v4_heading_generator($card_title['heading_repeater'], $card['card_relationship'][0]->ID);
              echo v4_card_excerpt_generator($card);
              echo v4_button_generator($card['card_button']['button_repeater']);
            echo '</div>';
          echo '</div>';
        }
      ?>
    </div>

  </div>
</div>
