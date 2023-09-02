<?php 
extract($args);
$user_data =get_userdata($user_id)->data;
 ?>

<div class="card p-3 mb-3">
    <div class="row g-0">
        <!-- <div class="col-md-4">
            <img src="<?php echo esc_attr($rounded_image) ?>" class="img-fluid rounded-start" alt="...">
        </div> -->
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?php echo esc_attr($user_data->display_name) ?></h5>
            </div>
        </div>
    </div>
</div>