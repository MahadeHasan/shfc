<?php
/**
 * Displays the site footer.
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

 $args = wp_parse_args($args, array(  
    'onoff_switch' => get_theme_mod('display_footer_widget_area','off'),

));
extract($args);
 if(is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')){
    $footer_widget_area = true;
 }else{
    $footer_widget_area = false;
 }
?>

<footer class="footer <?php echo !empty($footer_widget_area)? 'has-footer-widgets' : 'no-footer-widgets' ?>">
    <div class="container">
    <div class="footer-1 bg-gray-850 border-gray-800">

        <!-- Widget Area -->
        <?php
            if( $footer_widget_area){
                get_template_part( 'template-parts/footer/widget-area' ); 
            }        
          ?>  
        <!-- footer copyright --> 
        <?php get_template_part( 'template-parts/footer/copyright',''); ?>  
    </div>
    </div>
</footer>

    

 