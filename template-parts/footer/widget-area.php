<div class="row g-4">
    <div class="col-lg-4 d-grid gap-4 mb-30">
        <?php
        if (is_active_sidebar('footer-1')) {
            dynamic_sidebar('footer-1');
        }
        ?>
    </div>
    <!-- col-lg-4 -->
    <div class="col-lg-4 d-grid gap-4 mb-30">
        <?php
        if (is_active_sidebar('footer-2')) {
            dynamic_sidebar('footer-2');
        }
        ?>
    </div>
    <!-- col-lg-4 -->
    <div class="col-lg-4 d-grid gap-4 mb-30">
        <?php
        if (is_active_sidebar('footer-3')) {
            dynamic_sidebar('footer-3');
        }
        ?>
    </div>
    <!-- col-lg-4 -->
</div>
<!-- row -->