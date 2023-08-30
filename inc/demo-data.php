<?php
add_filter( 'pt-ocdi/import_files', 'eventor_import_demo_data' );
function eventor_import_demo_data() {
  return array( 
    array(
      'import_file_name'           => 'Home',
      'import_file_url'            => GENZ_URI.'/inc/demo-data/demo-content.xml',
      'import_widget_file_url'     => GENZ_URI.'/inc/demo-data/widgets.wie',
      'preview_url'                => 'https://jthemes.net/themes/wp/genz/',
      'import_preview_image_url'   => GENZ_ASSETS . '/imgs/homepage-01.png',
    )
  );
}



function eventor_demo_import_nav_menu_setup(){
    // Assign menus to their locations.
    $primary = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $footer_menu = get_term_by( 'name', 'Social Links', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', array(
          'primary' => $primary->term_id,
          'footer' => $footer_menu->term_id,
        )
    );

}

function eventor_demo_import_page_on_front_setup($selected_import){
  if( get_option('page_on_front') != '' ):
    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
  endif; 


  $home_pages = array(	'Home' );
  if( !in_array($selected_import['import_file_name'], $home_pages) ) return;

	$pagename = trim($selected_import['import_file_name']);
  if ( $pagename === $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title( $pagename );
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
  }
}

function eventor_demo_import_elementor_setup(){
  update_option( 'elementor_load_fa4_shim', 'yes' );
}

add_action( 'pt-ocdi/after_import', 'eventor_after_import_setup', 10, 1 );
function eventor_after_import_setup($selected_import) {
  eventor_demo_import_nav_menu_setup();
  eventor_demo_import_page_on_front_setup($selected_import);  
  eventor_demo_import_elementor_setup();
  set_theme_mod('display_navbar_search', true);   
  set_theme_mod('display_navbar_button', true);  
  set_theme_mod('navbar_display_popular_terms', true);  
  set_theme_mod('navbar_button_text', 'Subscribe');      
  set_theme_mod('navbar_button_link', '#');  
   
  flush_rewrite_rules(true);
}

function eventor_before_content_import( $selected_import ) {
  if(empty($selected_import['import_file_name'])) return;
  wp_delete_post(1, true); // remove hello world

}
add_action( 'ocdi/before_content_import', 'eventor_before_content_import' );

function eventor_before_widgets_import( $selected_import ) { 
  set_theme_mod('respect_user_color_preference', 1);
}
add_action( 'ocdi/before_widgets_import', 'eventor_before_widgets_import' );