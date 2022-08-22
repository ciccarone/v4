<?php
 $featured_services_buckets_center = isset($page_section['featured_services_buckets_center']) ? $page_section['featured_services_buckets_center'] : false;
 $featured_services_buckets_graphic = isset($page_section['featured_services_buckets_graphic']) ? $page_section['featured_services_buckets_graphic'] : false;
 $featured_services_slide_count = isset($page_section['featured_services_slide_count']) ? $page_section['featured_services_slide_count'] : false;
?>

<div class="container">
  <?php echo do_shortcode('[featured_services_slider service_type="marketing_service" bucket_type="'.$featured_services_buckets_graphic.'" slide_count="'.$featured_services_slide_count.'" center_card_content="'.$featured_services_buckets_center.'"]') ?>
</div>
