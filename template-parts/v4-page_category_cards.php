<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
        foreach ($page_section['page_category_cards'] as $card) {

          $card_bg_color = (count($card['override_default_card_background_color']) < 1) ? get_field('card_background_color', 'option')['color_names'] : $card['card_background_color']['color_names'];

          $card_title = (count($card['override_default_card_title']) < 1) ? v4_heading_generator_default($card['card_relationship'][0]->ID) : v4_heading_generator($card_title['heading_repeater'], $card['card_relationship'][0]->ID);

          $card_excerpt = (count($card['override_default_card_excerpt']) < 1) ? v4_card_excerpt_generator_default($card['card_relationship'][0]->ID) : v4_card_excerpt_generator($card);

          $card_button = (count($card['override_default_card_button']) < 1) ? v4_button_generator_default($card['card_relationship'][0]->ID) : v4_button_generator($card['card_button']['button_repeater']);

          echo '<div class="v4-card bg-color__'.$card_bg_color.'">';
            echo v4_card_image_generator($card);
            echo '<div class="v4-card__content">';
              echo $card_title;
              echo $card_excerpt;
              echo $card_button;
            echo '</div>';
          echo '</div>';

        }
      ?>
    </div>

  </div>
</div>
