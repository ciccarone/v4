<?php

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}

add_filter( 'excerpt_length', function($length) {
    return get_field('global_excerpt_length', 'option');
}, PHP_INT_MAX );

function new_excerpt_more( $more ) {
	return get_field('global_excerpt_ellipsis', 'option');
}
add_filter('excerpt_more', 'new_excerpt_more');

function acf_load_color_field_choices( $field ) {

    // reset choices
    $field['choices'] = array();


    // get the textarea value from options page without any formatting
    $choices = get_field('v4_theme_colors', 'option', false);


    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);


    // remove any unwanted white space
    $choices = array_map('trim', $choices);


    // loop through array and add to field 'choices'
    if( is_array($choices) ) {

        foreach( $choices as $choice ) {

            $field['choices'][ $choice ] = $choice;

        }

    }


    // return the field
    return $field;

}

add_filter('acf/load_field/name=color_selector', 'acf_load_color_field_choices');

function v4_page_content( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'return' => true,
  ), $atts );
  global $post;


  if ($page_content = get_field('service', 'option')) {
    foreach ($page_content as $pc) {

      foreach ($pc['service_reference'] as $p) {
        if ($p['value'] == $post->post_name) {
          // var_dump($pc);
          if ($a['return'] == 'featured_image') {
            return $pc['service_image']['url'];
          } elseif ($a['return'] == 'content') {

            $ret = '';

            $ret .= '<div class="page-title-container"><div class="service_title_holder"><h2>'.$pc['service_title'].'</h2></div>';
            $ret .= '<div class="frame" style="background-image: url('.$pc['service_image']['url'].')"></div></div>';

            $ret .= $pc['service_content'];
            return $ret;
          }

        }
      }
    }
  }


}

add_shortcode('v4_page_content', 'v4_page_content');

add_post_type_support( 'page', 'excerpt' );



function v4_form_section( $atts, $content = null )
{
	$a = shortcode_atts( array(
    'service_type' => true,
  ), $atts );
  global $post;


  if ($page_content = get_field('service', 'option')) {
    foreach ($page_content as $pc) {
      if ($pc['service_type'] == $a['service_type']) {
        $ret .= '<li class="col-lg-12 col-md-6 col-sm-6"><a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'">'.$pc['service_reference'][$a['service_type']]['label'].'</a></li>';
      }
    }

    return $ret;
  }
}


function company_name()
{
  if ($data = get_field('company_name', 'option')) {
    return $data;
  } else {
    return 'Company Name Not Set';
  }
}
add_shortcode('company_name', 'company_name');

function company_phone()
{
  if ($data = get_field('company_phone', 'option')) {
    return $data;
  } else {
    return 'Company Phone Not Set';
  }
}
add_shortcode('company_phone', 'company_phone');

function company_address()
{
  if ($data = get_field('company_address', 'option')) {
    return $data;
  } else {
    return 'Company Address Not Set';
  }
}
add_shortcode('company_address', 'company_address');

function company_email()
{
  if ($data = get_field('company_email_address', 'option')) {
    return $data;
  } else {
    return 'Company Email Not Set';
  }
}
add_shortcode('company_email', 'company_email');

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .hidden-acf {
    	display: none;
    }
    }
  </style>';
}

function v4_retrieve_color($field)
{
  if ($color = get_field($field, 'option')) {
    return $color['color_selector'];
  }
}

function v4_retrieve_color_name($field)
{
  if ($color = get_field($field, 'option')) {
    return $color['color_names'];
  }
}

add_action('wp_head', 'my_custom_css');

function my_custom_css() {

$h1 = get_field('h1_settings', 'option');
$h2 = get_field('h2_settings', 'option');
$h3 = get_field('h3_settings', 'option');
$h4 = get_field('h4_settings', 'option');
$h5 = get_field('h5_settings', 'option');
$h6 = get_field('h6_settings', 'option');
$li = get_field('li_settings', 'option');
$li_footer = get_field('footer_list_item_settings', 'option');
$nav_font = get_field('nav_font_settings', 'option');
$footer_heading = get_field('footer_heading_settings', 'option');
$sidebar_heading = get_field('sidebar_heading_settings', 'option');

$p = get_field('p_settings', 'option');
$logo_max_width = get_field('logo_max_width', 'option');
$global_border_radius = get_field('global_border_radius', 'option');

$button_bg_color = get_field('button_background_color', 'option');
$button_bg_color_hover = get_field('button_background_color_hover', 'option');
$button_text_color = get_field('button_text_color', 'option');
$button_text_color_hover = get_field('button_text_color_hover', 'option');
// $button_padding_top_bottom = get_field('button_padding_padding_options_top_bottom', 'option');
// $button_padding_left_right = get_field('button_padding_padding_options_left_right', 'option');

$sidebar_bg_color = get_field('sidebar_bg_color', 'option');
$sidebar_link_color = get_field('sidebar_link_color', 'option');

$footer_link_color = get_field('footer_link_color', 'option');


echo '<style>
:root {
--color-dark: '.v4_retrieve_color('color_map_dark').';
--color-light: '.v4_retrieve_color('color_map_light').';
--color-primary: '.v4_retrieve_color('color_map_primary').';
--color-secondary: '.v4_retrieve_color('color_map_secondary').';
--width-boxed: '.get_field('site_width', 'option').'px;
--global-border-radius: '.get_field('global_border_radius', 'option').'px;
--global-grid-gap: '.get_field('global_grid_gap', 'option').'px;
--global-mobile-breakpoint: '.get_field('global_mobile_breakpoint', 'option').'px;
--global-tablet-breakpoint: '.get_field('global_tablet_breakpoint', 'option'). 'px;
}

aside.widget-area h2 {
  font-size: ' . $sidebar_heading['font_size'] . 'px;
  font-family: ' . $sidebar_heading['font_family'] . ';
  font-style: ' . $sidebar_heading['font_style'] . ';
  font-weight: ' . $sidebar_heading['font_weight'] . ';
  letter-spacing: ' . $sidebar_heading['letter_spacing'] . 'px;
  line-height: ' . $sidebar_heading['line_height'] . 'px;
  text-transform: ' . $sidebar_heading['text_transform'] . ';
}

.v4-footer a, .v4-footer a:hover {
  color: '. v4_retrieve_color('color_map_' . $footer_link_color['color_names']) .';
}

@media  (min-width: '.get_field('global_mobile_breakpoint', 'option').'px) {
	.alignwide {	
		max-width: var(--width-boxed) !important;
	}
  }

.boxed {
  max-width: var(--width-boxed);
  margin: 0 auto;
}

@media (max-width: '.get_field('global_mobile_breakpoint', 'option'). 'px) {
	.grid {
		grid-template-columns: 1fr;
  }

}
@media (max-width: '.(get_field('site_width', 'option') + 40). 'px) {

        div.v4-single.boxed {
          padding: 1em !important;
        }
}

.text-primary {
	color: var(--color-primary) !important;
}

.global_border_radius {
	border-radius: var(--global-border-radius);
}

aside.widget-area {
	background-color: '. v4_retrieve_color('color_map_'. $sidebar_bg_color['color_names']) .';
}

aside.widget-area a {
	color: '. v4_retrieve_color('color_map_' . $sidebar_link_color['color_names']) .';
}


h1 {
  font-size: '.$h1['font_size'].'px;
  font-family: '.$h1['font_family'].';
  font-style: '.$h1['font_style'].';
  font-weight: '.$h1['font_weight'].';
  letter-spacing: '.$h1['letter_spacing'].'px;
  line-height: '.$h1['line_height'].'px;
  text-transform: '.$h1['text_transform'].';
}

h2 {
  font-size: '.$h2['font_size'].'px;
  font-family: '.$h2['font_family'].';
  font-style: '.$h2['font_style'].';
  font-weight: '.$h2['font_weight'].';
  letter-spacing: '.$h2['letter_spacing'].'px;
  line-height: '.$h2['line_height'].'px;
  text-transform: '.$h2['text_transform'].';
}

h3 {
  font-size: '.$h3['font_size'].'px;
  font-family: '.$h3['font_family'].';
  font-style: '.$h3['font_style'].';
  font-weight: '.$h3['font_weight'].';
  letter-spacing: '.$h3['letter_spacing'].'px;
  line-height: '.$h3['line_height'].'px;
  text-transform: '.$h3['text_transform'].';
}

h4 {
  font-size: '.$h4['font_size'].'px;
  font-family: '.$h4['font_family'].';
  font-style: '.$h4['font_style'].';
  font-weight: '.$h4['font_weight'].';
  letter-spacing: '.$h4['letter_spacing'].'px;
  line-height: '.$h4['line_height'].'px;
  text-transform: '.$h4['text_transform'].';
}

h5 {
  font-size: '.$h5['font_size'].'px;
  font-family: '.$h5['font_family'].';
  font-style: '.$h5['font_style'].';
  font-weight: '.$h5['font_weight'].';
  letter-spacing: '.$h5['letter_spacing'].'px;
  line-height: '.$h5['line_height'].'px;
  text-transform: '.$h5['text_transform'].';
}

h6 {
  font-size: '.$h6['font_size'].'px;
  font-family: '.$h6['font_family'].';
  font-style: '.$h6['font_style'].';
  font-weight: '.$h6['font_weight'].';
  letter-spacing: '.$h6['letter_spacing'].'px;
  line-height: '.$h6['line_height'].'px;
  text-transform: '.$h6['text_transform'].';
}

p {
  font-size: '.$p['font_size'].'px;
  font-family: '.$p['font_family'].';
  font-style: '.$p['font_style'].';
  font-weight: '.$p['font_weight'].';
  letter-spacing: '.$p['letter_spacing'].'px;
  line-height: '.$p['line_height'].'px;
  text-transform: '.$p['text_transform'].';
}

li {
  font-size: '.$li['font_size'].'px;
  font-family: '.$li['font_family'].';
  font-style: '.$li['font_style'].';
  font-weight: '.$li['font_weight'].';
  letter-spacing: '.$li['letter_spacing'].'px;
  line-height: '.$li['line_height'].'px;
  text-transform: '.$li['text_transform']. ';
}

.navbar-nav li {
  font-size: '.$nav_font['font_size'].'px;
  font-family: '.$nav_font['font_family'].';
  font-style: '.$nav_font['font_style'].';
  font-weight: '.$nav_font['font_weight'].';
  letter-spacing: '.$nav_font['letter_spacing'].'px;
  line-height: '.$nav_font['line_height'].'px;
  text-transform: '.$nav_font['text_transform'].';
}

.v4-footer li {
  font-size: '.$li_footer['font_size'].'px;
  font-family: '.$li_footer['font_family'].';
  font-style: '.$li_footer['font_style'].';
  font-weight: '.$li_footer['font_weight'].';
  letter-spacing: '.$li_footer['letter_spacing'].'px;
  line-height: '.$li_footer['line_height'].'px;
  text-transform: '.$li_footer['text_transform'].';
}

.v4-footer .footer-title {
  font-size: '.$footer_heading['font_size'].'px;
  font-family: '.$footer_heading['font_family'].';
  font-style: '.$footer_heading['font_style'].';
  font-weight: '.$footer_heading['font_weight'].';
  letter-spacing: '.$footer_heading['letter_spacing'].'px;
  line-height: '.$footer_heading['line_height'].'px;
  text-transform: '.$footer_heading['text_transform'].';
}


.btn {

	background-color: '.v4_retrieve_color('color_map_'.$button_bg_color['color_names']).';
	border-color: '.v4_retrieve_color('color_map_'.$button_bg_color['color_names']).';
	color: '.v4_retrieve_color('color_map_'.$button_text_color['color_names']).';
}

.btn:hover {
	background-color: '.v4_retrieve_color('color_map_'.$button_bg_color_hover['color_names']).';
	border-color: '.v4_retrieve_color('color_map_'.$button_bg_color_hover['color_names']).';
	color: '.v4_retrieve_color('color_map_'.$button_text_color_hover['color_names']).';
}
.site-branding img {
	max-width: '.$logo_max_width.'px;
}
</style>';
}

function v4_dynamic_cards($cards)
{
	$query = $cards['query'];
	$count = $cards['count'];
	$category = $cards['category'];
	$category_condition = $cards['category_condition'];
	$border_radius = $cards['border_radius'];

	// WP_Query arguments
	$args = array(
	    'post_type'              => array('post'),
	    'post_status'            => array('publish'),
	    'posts_per_page'         => $count,
	    'order'                  => 'DESC',
	    'orderby'                => 'date',
			'ignore_sticky_posts' => 1,
	);

	if ($query == 'category') {
	$args['tax_query'] = array(
			'relation' => $category_condition,
			array(
					'taxonomy'         => 'category', // taxonomy slug
					'terms'            => $category, // term ids
					'field'            => 'term_id', // Also support: slug, name, term_taxonomy_id
					'operator'         => 'IN', // Also support: AND, NOT IN, EXISTS, NOT EXISTS
					'include_children' => true,
			)
	);
	}

	// The Query
	$query = new WP_Query($args);

	$image['image_option'] = 'featured';

	$padding_options_top_bottom = get_field('card_content_padding_padding_options_top_bottom', 'option');
	$padding_options_left_right = get_field('card_content_padding_padding_options_left_right', 'option');

	// The Loop
	if ($query->have_posts()) {
	    while ($query->have_posts()) {
	        $query->the_post();

          $card_bg_color = get_field('card_background_color', 'option')['color_names'];

          $card_title = v4_heading_generator_default(get_the_ID());

          $card_excerpt = v4_card_excerpt_generator_default(get_the_ID());

          $card_button = v4_button_generator_default(get_the_ID());

          echo '<div class="v4-card bg-color__'.$card_bg_color.' '.$border_radius.'">';
            echo v4_card_image_generator($image, get_the_ID());
            echo '<div class="v4-card__content '. $padding_options_top_bottom .' ' . $padding_options_left_right . '">';
              echo $card_title;
              echo $card_excerpt;
              echo $card_button;
            echo '</div>';
          echo '</div>';

	        // do something
	    }
	} else {
	    // no posts found
	}

	// Restore original Post Data
	wp_reset_postdata();

}

function v4_button_generator_default($post_id)
{

	if (get_field('card_button_show', 'option')) {
		
		$b = [
			[
			'button_design' => '',
			'button_custom' => [
					'button_design_bg_color' => get_field('card_button_background_color', 'option')['color_names'],
					'button_design_bg_color_hover' => get_field('card_button_background_color_hover', 'option')['color_names'],
					'button_design_text_color' => get_field('card_button_text_color', 'option')['color_names'],
					'button_design_text_color_hover' => get_field('card_button_text_color_hover', 'option')['color_names'],
			],
			'button_position' => get_field('card_button_position', 'option')['position_options'],
			'button_link' => [
				'url' => get_the_permalink($post_id),
				'target' => '_self',
				'title' => get_field('card_button_default_text', 'option')
			]
		]
		];

		return v4_button_generator($b);
	} else {
		return;
	}
}

function v4_button_generator($buttons, $alignment = 'left')
{
	if ($buttons) {
		
		$ret = '';
		$custom_button_classes = '';
		$ret .= count($buttons) > 1 ? '<div class="btn__container btn__container__alignment--'.$alignment.'">' : '';
		foreach ($buttons as $button) {

			if (isset($button['button_custom'])) {
				$custom_button_classes_arr[] = 'button_design_bg_color--' . $button['button_custom']['button_design_bg_color'];
				$custom_button_classes_arr[] = 'button_design_bg_color_hover--' . $button['button_custom']['button_design_bg_color_hover'];
				$custom_button_classes_arr[] = 'button_design_text_color--' . $button['button_custom']['button_design_text_color'];
				$custom_button_classes_arr[] = 'button_design_text_color_hover--' . $button['button_custom']['button_design_text_color_hover'];

				$custom_button_classes = join(' ', $custom_button_classes_arr);
			}
			
			$padding_options_top_bottom = get_field('button_padding_padding_options_top_bottom', 'option');
			$padding_options_left_right = get_field('button_padding_padding_options_left_right', 'option');
			$ret .= '<a class="btn btn-v4-'.$button['button_design'].' '.$padding_options_top_bottom.' '.$padding_options_left_right.' global_border_radius btn__position--'.$button['button_position'].' ' . $custom_button_classes . '" href="'.$button['button_link']['url'].'" target="'.$button['button_link']['target'].'">'.$button['button_link']['title'].'</a>';
		}
		$ret .= count($buttons) > 1 ? '</div>' : '';

		return $ret;
	}
	return false;
}

// for default options:
function v4_heading_generator_default($post_id = false)
{
	$padding_options_top_bottom = get_field('card_title_padding_padding_options_top_bottom', 'option');
	$padding_options_left_right = get_field('card_title_padding_padding_options_left_right', 'option');
		$ret = '<'.get_field('card_title_element_element_options', 'option').' class="'.$padding_options_top_bottom.' '.$padding_options_left_right.' v4-heading text-'.get_field('card_title_position', 'option')['position_options'].' text-'.get_field('card_title_color', 'option')['color_names'].'">'.get_the_title($post_id).'</'.get_field('card_title_element_element_options', 'option').'>';
		return $ret;
}

function v4_heading_generator($headings, $post_id = false)
{
	$title_override = true;
	if ($headings) {

		$ret = '';
		foreach ($headings as $heading) {

			$title_override = $heading['heading_text'] !== '' ? $heading['heading_text'] : get_the_title($post_id);
			$ret .= '<'.$heading['element_options'].' class="v4-heading text-'.$heading['position_options'].' text-'.$heading['color_names'].' '.$heading['heading_padding']['padding_options_left_right'].' '.$heading['heading_padding']['padding_options_top_bottom'].'">'.$title_override.'</'.$heading['element_options'].'>';
		}
		return $ret;
	}
	return false;
}

function v4_card_image_generator($image, $passed_post_id = false)
{
	if ($image) {

		$image_url = false;

		switch ($image['image_option']) {
			case 'featured':

				$post_id = $passed_post_id ? $passed_post_id : $image['card_relationship'][0]->ID;
				$image_url = get_the_post_thumbnail_url($post_id, 'large');
				if ($image_url == '') {
					$image_url = get_field('site_fallback_image','option');
				}
				break;

			case 'upload':
				$image = $image['image_upload'];
				$image_url = $image['sizes']['medium_large'];
				break;

			case 'icon':
				var_dump($image['icon_choice']);
				
				// $image = v4_icon_generator($image);
				// $image_url = $image['sizes']['medium_large'];
				break;

			default:
				// code...
				break;
		}



		$ret = '<div class="v4-card__image" style="background-image: url('.$image_url.')"></div>';

		return $ret;
	}
	return false;
}

function v4_text($text)
{
	$padding_options_top_bottom = !empty($text['padding-y']) ? $text['padding-y'] : 'py-0';
	$padding_options_left_right = !empty($text['padding-x']) ? $text['padding-x'] : 'px-0';
	return '<div class="'.$padding_options_top_bottom.' '.$padding_options_left_right.' v4-text text-'.$text['position'].' text-'.$text['color'].'">'.$text['content'].'</div>';
}

function v4_card_excerpt_generator_default($post_id = false)
{
	if (!get_field('card_excerpt_show', 'option')) {
		return;
	}
	$padding_options_top_bottom = get_field('card_excerpt_padding_padding_options_top_bottom', 'option');
	$padding_options_left_right = get_field('card_excerpt_padding_padding_options_left_right', 'option');
	$position = get_field('card_excerpt_position', 'option')['position_options'];
	$color = get_field('card_excerpt_color', 'option')['color_names'];
	return '<div class="'.$padding_options_top_bottom.' '.$padding_options_left_right.' v4-text text-'.$position.' text-'.$color.'">'.get_the_excerpt($post_id).'</div>';
}

function v4_card_excerpt_generator($card)
{
	if ($card['excerpt_options']) {
		$excerpt = '';

		switch ($card['excerpt_options']) {
			case 'show':
				$excerpt = get_the_excerpt($card);
				$text['position'] = $card['excerpt_style']['position_options'];
				$text['color'] = $card['excerpt_style']['color_names'];
				$text['padding-y'] = $card['excerpt_style']['padding_options_top_bottom'];
				$text['padding-x'] = $card['excerpt_style']['padding_options_left_right'];
				$text['content'] = $excerpt;
				$excerpt = v4_text($text);
				break;

			case 'custom':
				$excerpt = $card['custom_excerpt']['text_repeater'][0]['text'];
				$text['position'] = $card['excerpt_style']['position_options'];
				$text['color'] = $card['excerpt_style']['color_names'];
				$text['padding-y'] = $card['excerpt_style']['padding_options_top_bottom'];
				$text['padding-x'] = $card['excerpt_style']['padding_options_left_right'];
				$text['content'] = $excerpt;
				$excerpt = v4_text($text);
				break;

			case 'none':
				$excerpt = '';
				break;

			default:
				$excerpt = false;
				break;
		}
		return $excerpt;
	}
	return false;
}

function v4_card_button_generator($card)
{
	// var_dump($card);
	if ($card['button_options']) {
		$button = '';

		switch ($card['button_options']) {
			case 'show':
				$button_text = $card['card_button_text'];
				break;

			case 'none':
				$button = '';
				break;

			default:
				$button = false;
				break;
		}
		return $button;
	}
	return false;
}

function v4_icon_generator($icon)
{
	// TODO: get working
	var_dump($icon);
}

function v4_text_generator($texts)
{
	$title_override = true;
	if ($texts) {

		$ret = '';
		foreach ($texts as $text) {
			$title_override = $text['text'] !== '' ? $text['text'] : get_the_title();
			$text['position'] = $text['position_options'];
			$text['color'] = $text['color_names'];
			$text['content'] = $title_override;
			$ret .= v4_text($text);
		}
		return $ret;
	}
	return false;
}


function v4_retrieve_overlay_header_boolean()
{
	if (is_front_page()) {
		return get_field('header_overlay_on_homepage', 'option') ? 'header-overlay--true' : '';
	}
}


function v4_retrieve_page_header( $title_override )
{
	return $title_override ? $title_override : get_the_title();

}

add_filter('the_content','do_shortcode');


function v4_author_box() {
  if (!get_field('show_author_boxes_on_posts', 'option')) {
	return false;
  }
	$user_image = false;
	$user_social = false;
	$user_label = false;
	if ($author_repeater = get_field('author_repeater')) {
		$i = 0;
	  foreach ($author_repeater as $author) {

		if ($user_association = $author['author_user_association']) {


			$u[$i]['user_url'] = $user_association->data->user_url;
			$userdata = get_user_meta( $user_association->data->ID );
			$u[$i]['user_bio'] = wpautop($userdata['description'][0]);
			$u[$i]['user_name'] = $user_association->data->display_name;

			if ($user_social_field = get_field('author_social', 'user_'.$user_association->data->ID)['social_links']) {
				$u[$i]['user_social'] = social_unwrapper($user_social_field);
			}

			if ($user_label_field = get_field('author_label', 'user_'.$user_association->data->ID)) {
				$u[$i]['user_label'] = $user_label_field;
			}
			if ($user_image_field = get_field('author_image', 'user_'.$user_association->data->ID)) {
				$u[$i]['user_image'] = $user_image_field['sizes']['medium_large'];
			}

			global $post;
			$authors_posts = get_posts( array( 'author' => $user_association->data->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ) );

			if ($authors_posts) {
				$post_li = '<ul>';
				foreach ($authors_posts as $authors_post) {
					$post_li .= '<li><a href="'.$authors_post->guid.'">'.$authors_post->post_title.'</a></li>';
				}
				$post_li .= '</ul>';
				$u[$i]['post_li'] = $post_li;
			}

		} else {
			$u[$i]['user_name'] = $author['author_name'];
			$u[$i]['user_image'] = $author['author_image']['sizes']['medium_large'];
			$u[$i]['user_bio'] = $author['author_bio'];
			$u[$i]['post_li'] = false;
			$u[$i]['user_social'] = social_unwrapper($author['author_social']['social_links']);
		}

		$i++;
	  }
	} else {
		
		$u['m']['user_bio'] = get_the_author_meta('description');
		$u['m']['user_name'] = get_the_author_meta('display_name');
		$u['m']['user_url'] = get_the_author_meta('user_url');
		if ($user_social_field = get_field('author_social', 'user_'.get_the_author_meta('ID'))) {
			$u['m']['user_social'] = social_unwrapper($user_social_field['social_links']);
		}

		if ($user_label_field = get_field('author_label', 'user_'.get_the_author_meta('ID'))) {
			$u['m']['user_label'] = $user_label_field;
		}
		if ($user_image_field = get_field('author_image', 'user_'.get_the_author_meta('ID'))) {
			$u['m']['user_image'] = $user_image_field['sizes']['medium_large'];
		}
		global $post;
		$authors_posts = get_posts( array( 'author' => get_the_author_meta('ID'), 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ) );

		if ($authors_posts) {
			$post_li = '<ul>';
			foreach ($authors_posts as $authors_post) {
				$post_li .= '<li><a href="'.$authors_post->guid.'">'.$authors_post->post_title.'</a></li>';
			}
			$post_li .= '</ul>';
			$u['m']['post_li'] = $post_li;
		}
	}

	
	echo display_author_box($u);
}

function display_author_box($u)
{
	
	$ret = false;
	$ret .= '<div class="v4-author__box">';
	$i = 0;
	foreach ($u as $key => $value) {
		$ret .= '<div class="v4-author__item">';
		$ret .= '<input checked="checked" id="tab'.$i.'" type="radio" name="pct" />';
		if ($value['post_li'] ?? null) {
			$ret .= '<input id="tab'.($i+1).'" type="radio" name="pct" />';
		}
		$ret .= '<nav><ul>';
			$ret .= '<li class="tab'.$i.'"><label for="tab'.$i.'"><i class="fas fa-user"></i> '.$value['user_name'].'</label></li>';
			if ($value['post_li'] ?? null) {
				$ret .= '<li class="tab'.($i+1).'"><label for="tab'.($i+1).'"><i class="far fa-list-alt"></i> Articles</label></li>';
			}
		$ret .= '</ul></nav>';

		$ret .= '<section>';
		$ret .= '<div class="tab'.$i.'">';
		$ret .= '<div class="v4-author__container">';
		$ret .= '<div class="v4-author__image">';
			$ret .= '<img src="';
			if (isset($value['user_image'])) {
				$ret .= $value['user_image'];
			} else {
				$ret .= get_field('user_fallback_image', 'option');
			}
			$ret .= '" />';
			
		$ret .= '</div>';
		$ret .= '<div class="v4-author__content">';
			$ret .= '<strong>'.$value['user_name'].'</strong>';
			$ret .= $value['user_bio'];
			if (isset($value['user_social'])) {
				$ret .= $value['user_social'];
			}
		$ret .= '</div>';
		// if (isset($value['user_label'])) {
		// 	$ret .= '<h5>'.$value['user_label'].'</h5>';
		// }
		$ret .= '</div>';
		$ret .= '</div>';
		
		if (isset($value['post_li'])) {
		$ret .= '<div class="tab'.($i+1).'">';
			$ret .= $value['post_li'];
		$ret .= '</div>';
		}
		$ret .= '</div>';
		$i++;
	}
	$ret .= '</div>';

	return $ret;
}

function social_unwrapper($socials)
{
	$ret = '<div class="v4-socials">';
	foreach ($socials as $s) {
		// foreach ($social as $s) { dafuq?
			$ret .= '<a href="'.$s['social_network_url'].'" target="_blank">';
				$ret .= '<i class="'.$s['social_network'].'"></i>';
			$ret .= '</a>';
		// }
	}
	$ret .= '</div>';
	return $ret;
}

function v4_image_generator($images, $size)
{

	return '<img src="'.$images['sizes'][$size].'" />';
}

function generate_star_rating($rating)
{
	$ret_extra = false;
	$ret = '<div class="v4-star-rating">';
	$ret .= '<div class="v4-star-rating__inner">';
	$ret .= '<div class="v4-star-rating__title">Editor\'s Rating</div>';
	for ($i=0; $i < $rating; $i++) {
		$ret .= '<i class="fas fa-star"></i>';

	}
	if ($rating !== 5) {
		for ($i=0; $i < (5 - $rating); $i++) {
			$ret_extra .= '<i class="fal fa-star"></i>';
		}
	}
	$ret_extra .= '<span>'.$rating.'</span>';
	$ret .= $ret_extra . '</div></div>';
	return $ret;
}


function v4_adplace($location)
{	
	if ($ad_repeater = get_field('ad_repeater', 'option')) {
		foreach ($ad_repeater as $ad) {
			if (in_array($location, $ad['ad_location'])) {
				echo '<div class="v4-ad_place v4-ad_place__'. $location.'"><a href="'. $ad['ad_link'].'" target="_blank"><img src="'.$ad['ad_image']['url'].'" alt="'.$ad['ad_alt_tag'].'" /></a></div>';
			}
		}
	}
}

function add_before_my_siderbar($name)
{
	echo "Loaded on top of the {$name}-sidebar";

	// Example that uses the $name of the sidebar as switch/trigger
	'main' === $name and print "I'm picky and only echo for special sidebars!";
}
add_action('wp_meta', 'add_before_my_siderbar');


add_action('widgets_init', 'v4_register_sidebars');
function v4_register_sidebars()
{

	register_sidebar(
		array(
			'id'            => 'page',
			'name'          => __('Page Sidebar'),
			'description'   => __(''),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}