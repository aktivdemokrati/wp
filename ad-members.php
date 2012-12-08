<?php
if ( !current_user_can('list_users') )
	wp_die(__('Cheatin&#8217; uh?'));

	$usersearch = isset($_GET['usersearch']) ? $_GET['usersearch'] : null;
	$userspage = isset($_GET['userspage']) ? $_GET['userspage'] : null;

	// Query the user IDs for this page
	$wp_user_search = new WP_User_Search($usersearch, $userspage, null);

	// Query the post counts for this page
	$post_counts = count_many_users_posts($wp_user_search->get_results());

	// Query the users for this page
	cache_users($wp_user_search->get_results());



function ad_member_row( $user_object, $style = '', $role = '', $numposts = 0 ) {
	global $wp_roles;

	if ( !( is_object( $user_object) && is_a( $user_object, 'WP_User' ) ) )
		$user_object = new WP_User( (int) $user_object );
	$user_object = sanitize_user_object($user_object, 'display');
	$email = $user_object->user_email;
	$url = $user_object->user_url;
	$short_url = str_replace( 'http://', '', $url );
	$short_url = str_replace( 'www.', '', $short_url );
	if ('/' == substr( $short_url, -1 ))
		$short_url = substr( $short_url, 0, -1 );
	if ( strlen( $short_url ) > 35 )
		$short_url = substr( $short_url, 0, 32 ).'...';
	$checkbox = '';
	// Check if the user for this row is editable
	if ( current_user_can( 'list_users' ) ) {
		// Set up the user editing link
		// TODO: make profile/user-edit determination a separate function
		if ( get_current_user_id() == $user_object->ID) {
			$edit_link = 'profile.php';
		} else {
			$edit_link = esc_url( add_query_arg( 'wp_http_referer', urlencode( esc_url( stripslashes( $_SERVER['REQUEST_URI'] ) ) ), "user-edit.php?user_id=$user_object->ID" ) );
		}
		$edit = "<strong><a href=\"$edit_link\">$user_object->user_login</a></strong><br />";

		// Set up the hover actions for this user
		$actions = array();

		if ( current_user_can('edit_user',  $user_object->ID) ) {
			$edit = "<strong><a href=\"$edit_link\">$user_object->user_login</a></strong><br />";
			$actions['edit'] = '<a href="' . $edit_link . '">' . __('Edit') . '</a>';
		} else {
			$edit = "<strong>$user_object->user_login</strong><br />";
		}

		if ( !is_multisite() && get_current_user_id() != $user_object->ID && current_user_can('delete_user', $user_object->ID) )
			$actions['delete'] = "<a class='submitdelete' href='" . wp_nonce_url("users.php?action=delete&amp;user=$user_object->ID", 'bulk-users') . "'>" . __('Delete') . "</a>";
		if ( is_multisite() && get_current_user_id() != $user_object->ID && current_user_can('remove_user', $user_object->ID) )
			$actions['remove'] = "<a class='submitdelete' href='" . wp_nonce_url("users.php?action=remove&amp;user=$user_object->ID", 'bulk-users') . "'>" . __('Remove') . "</a>";
		$actions = apply_filters('user_row_actions', $actions, $user_object);
		$action_count = count($actions);
		$i = 0;
		$edit .= '<div class="row-actions">';
		foreach ( $actions as $action => $link ) {
			++$i;
			( $i == $action_count ) ? $sep = '' : $sep = ' | ';
			$edit .= "<span class='$action'>$link$sep</span>";
		}
		$edit .= '</div>';

		// Set up the checkbox (because the user is editable, otherwise its empty)
		$checkbox = "<input type='checkbox' name='users[]' id='user_{$user_object->ID}' class='$role' value='{$user_object->ID}' />";

	} else {
		$edit = '<strong>' . $user_object->user_login . '</strong>';
	}
	$role_name = isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role] ) : __('None');
	$r = "<tr id='user-$user_object->ID'$style>";
	$columns = get_column_headers('users');
	$hidden = get_hidden_columns('users');
	$avatar = get_avatar( $user_object->ID, 32 );
	foreach ( $columns as $column_name => $column_display_name ) {
		$class = "class=\"$column_name column-$column_name\"";

		$style = '';
		if ( in_array($column_name, $hidden) )
			$style = ' style="display:none;"';

		$attributes = "$class$style";

		switch ($column_name) {
			case 'cb':
				$r .= "<th scope='row' class='check-column'>$checkbox</th>";
				break;
			case 'username':
				$r .= "<td $attributes>$avatar $edit</td>";
				break;
			case 'name':
				$r .= "<td $attributes>$user_object->first_name $user_object->last_name</td>";
				break;
			case 'email':
				$r .= "<td $attributes><a href='mailto:$email' title='" . sprintf( __('E-mail: %s' ), $email ) . "'>$email</a></td>";
				break;
			case 'role':
				$r .= "<td $attributes>$role_name</td>";
				break;
			case 'posts':
				$attributes = 'class="posts column-posts num"' . $style;
				$r .= "<td $attributes>";
				if ( $numposts > 0 ) {
					$r .= "<a href='edit.php?author=$user_object->ID' title='" . __( 'View posts by this author' ) . "' class='edit'>";
					$r .= $numposts;
					$r .= '</a>';
				} else {
					$r .= 0;
				}
				$r .= "</td>";
				break;
			default:
				$r .= "<td $attributes>";
				$r .= apply_filters('manage_users_custom_column', '', $column_name, $user_object->ID);
				$r .= "</td>";
		}
	}
	$r .= '</tr>';

	return $r;
}









?>

<div class="wrap">
<?php screen_icon(); ?>
<h2>Aktiv Demokrati Medlemsregister
<?php
if( isset($_GET['usersearch']) && $_GET['usersearch'] )
  printf( '<span class="subtitle">' . __('Search results for &#8220;%s&#8221;') . '</span>', esc_html( $_GET['usersearch'] ) ); ?>
</h2>
</div>


<table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">
<?php print_column_headers('users') ?>
</tr>
</thead>

<tfoot>
<tr class="thead">
<?php print_column_headers('users', false) ?>
</tr>
</tfoot>

<tbody id="users" class="list:user user-list">
<?php
$style = '';
foreach ( $wp_user_search->get_results() as $userid ) {
	$user_object = new WP_User($userid);
	$roles = $user_object->roles;
	$role = array_shift($roles);

	$style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
	echo "\n\t", user_row( $user_object, $style, $role, $post_counts[ $userid ] );
}
?>
</tbody>
</table>

<div class="tablenav">

<?php if ( $wp_user_search->results_are_paged() ) : ?>
	<div class="tablenav-pages"><?php $wp_user_search->page_links(); ?></div>
<?php endif; ?>

<div class="alignleft actions">
<select name="action2">
<option value="" selected="selected"><?php _e('Bulk Actions'); ?></option>
<?php if ( !is_multisite() && current_user_can('delete_users') ) { ?>
<option value="delete"><?php _e('Delete'); ?></option>
<?php } else { ?>
<option value="remove"><?php _e('Remove'); ?></option>
<?php } ?></select>
<input type="submit" value="<?php esc_attr_e('Apply'); ?>" name="doaction2" id="doaction2" class="button-secondary action" />
</div>

<br class="clear" />
</div>
