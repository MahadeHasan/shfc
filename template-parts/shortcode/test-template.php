<?php
extract($args);

?>

<div class="card p-3 mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="<?php echo esc_attr($rounded_image) ?>" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?php echo esc_attr($title) ?></h5>
                <p class="card-text"><?php echo esc_attr($cardtext) ?></p>
                <p class="card-text2"><small class="text-body-secondary"><?php echo esc_attr($card_text2) ?></small></p>
                <a href="<?php echo esc_attr($btn_link) ?>" class="btn btn-primary"><?php echo esc_attr($btn_text) ?></a>
            </div>
        </div>
    </div>
</div>