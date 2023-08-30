<?php
if (is_category() || is_tag() || is_single() || is_author() || is_404() || is_search()) {
	$class = 'cover-home3';
} else {
	$class = 'cover-home1';
}

?>
<main class="main">
	<div class="<?php echo esc_attr($class); ?>">
		<div class="container">
			<div class="row">
				<div class="col-xl-10 col-lg-12 mx-auto">