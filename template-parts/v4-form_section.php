<div class="container">
  <div class="row">
    <div class="col-md-4">
      <h2><?php echo $page_section['form_title'] ?></h2>
      <p><?php echo $page_section['form_text'] ?></p>
    </div>
    <div class="col-md-8">
      <?php echo do_shortcode('[gravityform id="'.$page_section['gravity_form_id'].'" title="false" description="false"]') ?>
    </div>
  </div>
</div>
