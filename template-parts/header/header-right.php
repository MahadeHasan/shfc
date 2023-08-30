   <?php
    global $genz_header;
    extract($genz_header);
    $navbar_right = ($display_search || $display_button || has_nav_menu('primary')) ? true : false;
    if (!$navbar_right) return;

    $navbar_right_class = ((!$display_search && !$display_button) && has_nav_menu('primary')) ? 'header-right-menu-only' : 'header-right-info';
    ?>

   <!-- header-right Start -->
   <div class="header-right text-end flex-wrap align-items-center gap-3 <?php echo esc_attr($navbar_right_class) ?>">
       <?php if ($display_search) :  ?>
           <a class="btn btn-search" href="#" data-settings-id="search"></a>
           <div class="form-search p-20">
               <form>
                   <input class="form-control" type="text" placeholder="<?php echo esc_attr($search_placeholder) ?>" name="s">
                   <input class="btn-search-2" type="submit" value="<?php echo get_query_var('s'); ?>">
               </form>
               <?php
                if ($display_popular_terms) :
                    $terms = get_terms($search_popular_type, array(
                        'hide_empty' => true,
                        'orderby' => 'count',
                        'order' => 'DESC'
                    ));

                    $term_links = [];
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $key => $term) {
                            if ($key == 5) break;
                            $term_links[] = sprintf('<a class="color-gray-600 mr-10 font-xs" href="%2$s"># %1$s</a>', $term->name, get_term_link($term));
                        }
                    }
                ?>
                   <div class="popular-keywords text-start mt-20">
                       <p class="mb-10 color-white"><?php echo esc_attr($search_popular_text) ?></p>
                       <?php echo join('', $term_links); ?>
                   </div>
               <?php endif; ?>
           </div>
       <?php endif; ?>

       <?php if (!$disable_color_mode_switcher) : ?>
           <div class="form-check form-switch">
               <input class="form-check-input" type="checkbox" role="switch" id="genzColorMode" <?php echo (genz_get_color_mode() == 'dark') ? ' checked' : '' ?>>
           </div>
       <?php endif; ?>
       <?php if ($display_button && !empty($button_text)) :  ?>
           <a class="btn btn-linear d-none d-sm-inline-block hover-up hover-shadow" href="<?php echo esc_url($button_link) ?>" data-settings-id="subscribe">
               <?php echo esc_attr($button_text) ?> </a>
       <?php endif; ?>

       <div class="burger-icon burger-icon-white">
           <span class="burger-icon-top"></span>
           <span class="burger-icon-mid"></span>
           <span class="burger-icon-bottom"></span>
       </div>
   </div>
   <!-- Header Right End-->