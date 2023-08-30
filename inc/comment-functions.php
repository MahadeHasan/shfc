<?php
require get_template_directory() . '/inc/class-comment-walker.php';
add_filter('comment_form_default_fields', 'genz_comment_form_default_fields');
function genz_comment_form_default_fields($fields)
{
	global $post;
	$post_id       = $post->ID;
	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';


	$req   = get_option('require_name_email');
	$html5 = 'html5';


	// Define attributes in HTML5 or XHTML syntax.
	$required_attribute = ($html5 ? ' required' : ' required="required"');
	$checked_attribute  = ($html5 ? ' checked' : ' checked="checked"');

	// Identify required fields visually and create a message about the indicator.
	$required_indicator = ' ' . wp_required_field_indicator();
	$required_text      = ' ' . wp_required_field_message();

	$edit_fields = array(
		'author' => sprintf(
			'<p class="comment-form-author">%s %s</p>',
			sprintf(
				'<label class="visually-hidden" for="author">%s%s</label>',
				esc_attr__('Name', 'genz'),
				($req ? $required_indicator : '')
			),
			sprintf(
				'<input id="author" class="%4$s" placeholder="%3$s" name="author" type="text" value="%1$s" size="30" maxlength="245" autocomplete="name"%2$s />',
				esc_attr($commenter['comment_author']),
				($req ? $required_attribute : ''),
				esc_attr__('Name *', 'genz'),
				'form-control mt-30 bg-gray-850 border-gray-800 bdrd16 color-gray-600'
			)
		),
		'email'  => sprintf(
			'<p class="comment-form-email">%s %s</p>',
			sprintf(
				'<label class="visually-hidden" for="email">%s%s</label>',
				esc_attr__('Email', 'genz'),
				($req ? $required_indicator : '')
			),
			sprintf(
				'<input id="email" name="email" %s value="%s" maxlength="100" autocomplete="email" %s placeholder="%s" class="%s"  />',
				//input type
				($html5 ? 'type="email"' : 'type="text"'),
				//user value
				esc_attr($commenter['comment_author_email']),
				// Required
				($req ? $required_attribute : ''),
				//placeholder
				esc_attr__('Enter Email Address *', 'genz'),
				'form-control mt-30 bg-gray-850 border-gray-800 bdrd16 color-gray-600'
			)
		),
		'url'    => sprintf(
			'<p class="comment-form-url">%s %s</p>',
			sprintf(
				'<label class="visually-hidden" for="url">%s</label>',
				esc_attr__('Website', 'genz')
			),
			sprintf(
				'<input id="url" name="website" %s value="%s"  maxlength="100" autocomplete="url"  placeholder="%s" class="%s" />',
				//input type
				($html5 ? 'type="url"' : 'type="text"'),
				// user value
				esc_attr($commenter['comment_author_url']),
				//placeholder
				esc_attr__('Website Url', 'genz'),
				'form-control mt-30 bg-gray-850 border-gray-800 bdrd16 color-gray-500'
			)
		),
	);

	if (has_action('set_comment_cookies', 'wp_set_comment_cookies') && get_option('show_comments_cookies_opt_in')) {
		$consent = empty($commenter['comment_author_email']) ? '' : $checked_attribute;

		$edit_fields['cookies'] = sprintf(
			' <p class="comment-form-cookies-consen mt-20 d-flex align-items-start  mb-20">%s %s</p>',
			sprintf(
				'<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />',
				$consent
			),
			sprintf(
				'<label for="wp-comment-cookies-consent">%s</label>',
				esc_attr__('Save my name, email, and website in this browser for the next time I comment.', 'genz')
			)
		);
	}


	return array_merge($fields, $edit_fields);
}



add_filter('comment_form_defaults', 'genz_comment_form_defaults');
function genz_comment_form_defaults($args)
{
	global $post;
	$post_id       = $post->ID;
	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';


	$req   = get_option('require_name_email');
	$html5 = 'html5';


	// Define attributes in HTML5 or XHTML syntax.
	$required_attribute = ($html5 ? ' required' : ' required="required"');
	$checked_attribute  = ($html5 ? ' checked' : ' checked="checked"');

	// Identify required fields visually and create a message about the indicator.
	$required_indicator = ' ' . wp_required_field_indicator();
	$required_text      = ' ' . wp_required_field_message();


	$defaults = array(
		'comment_field'        => sprintf(
			'<p class="comment-form-comment">%s %s</p>',
			sprintf(
				'<label class="visually-hidden" for="comment">%s%s</label>',
				esc_attr_x('Comment', 'noun', 'genz'),
				$required_indicator
			),
			'<textarea id="comment" placeholder="' . esc_attr_x('Write a Comment *', 'Comment placeholder', 'genz') . '" class="form-control bg-gray-850 border-gray-800 bdrd16 color-gray-600" name="comment" cols="45" rows="8" maxlength="65525"' . $required_attribute . '></textarea>'
		),
		'must_log_in'          => sprintf(
			'<p class="must-log-in">%s</p>',
			sprintf(
				/* translators: %s: Login URL. */
				esc_attr__('You must be <a href="%s">logged in</a> to post a comment.', 'genz'),
				/** This filter is documented in wp-includes/link-template.php */
				wp_login_url(apply_filters('the_permalink', get_permalink($post_id), $post_id))
			)
		),
		'logged_in_as'         => sprintf(
			'<p class="logged-in-as color-gray-300 mb-4">%s</p><p>%s</p>',
			sprintf(
				/* translators: 1: User name, 2: Edit user link, 3: Logout URL. */
				__('Logged in as %1$s. <a class="text-decoration-underline" href="%2$s">Edit your profile</a>. <a  class="text-decoration-underline"  href="%3$s">Log out?</a>', 'genz'),
				$user_identity,
				get_edit_user_link(),
				/** This filter is documented in wp-includes/link-template.php */
				wp_logout_url(apply_filters('the_permalink', get_permalink($post_id), $post_id))
			),
			$required_text
		),
		'comment_notes_before' => sprintf(
			'<p class="comment-notes">%s%s</p>',
			sprintf(
				'<span id="email-notes">%s</span>',
				esc_attr__('Your email address will not be published.', 'genz')
			),
			$required_text
		),
		'comment_notes_after'  => '',
		'action'               => site_url('/wp-comments-post.php'),
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_container'      => 'comment-respond',
		'class_form'           => 'comment-form',
		'class_submit'         => 'submit btn btn-linear',
		'name_submit'          => 'submit',
		'title_reply'          => esc_attr__('Leave a comment', 'genz'),
		/* translators: %s: Author of the comment being replied to. */
		'title_reply_to'       => esc_attr__('Leave a Reply to %s', 'genz'),
		'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title text-heading-4 color-gray-300 mb-40">',
		'title_reply_after'    => '</h4>',
		'cancel_reply_before'  => ' <small class="text-white text-sm ms-5">',
		'cancel_reply_after'   => '</small>',
		'cancel_reply_link'    => esc_attr__('Cancel Reply', 'genz'),
		'label_submit'         => esc_attr__('Post Comment', 'genz'),
		'submit_field'         => '<p class="form-submit mt-20 ">%1$s %2$s</p>  ',
		'format'               => 'xhtml',
	);

	return wp_parse_args($defaults, $args);
}
