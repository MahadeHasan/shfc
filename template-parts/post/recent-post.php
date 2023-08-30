 <?php
    $blog_column = is_active_sidebar('sidebar1') ? 8 : 12;
    ?>

 <div class="row mt-70">
     <div class="col-lg-<?php print esc_attr($blog_column); ?>">
         <?php get_template_part("template-parts/post/list-view"); ?>
     </div>
     <!--col-lg-8  -->
     <?php if (is_active_sidebar('sidebar1')) : ?>
         <div class="col-lg-4">
             <div class="sidebar">
                 <?php get_sidebar(); ?>
             </div>
             <!-- sidebar -->
         </div>
     <?php endif; ?>
 </div>