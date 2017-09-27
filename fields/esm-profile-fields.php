<?php

function esm_add_custom_metabox_profile()
{
	add_meta_box(
		'esm_profile_meta',
		__( 'Profile details' ),
		'esm_profile_meta_callback',
		'profile',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'esm_add_custom_metabox_profile' );

function esm_profile_meta_callback( $post )
{
	// security feature
	wp_nonce_field( basename( __FILE__ ), 'esm_profile_nonce' );
	$esm_stored_data = get_post_meta( $post->ID );
?>
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="profile-name" class="row-title">Name:</label>
			</div>
			<div class="meta-td">
				<input type="text" name="profile-name" id="profile-name" value="<?php if ( ! empty($esm_stored_data['profile-name']) ) echo esc_attr( $esm_stored_data['profile-name'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="profile-personal-title" class="row-title">Title before name:</label>
			</div>
			<div class="meta-td">
				<input type="text" name="profile-personal-title" id="profile-personal-title" value="<?php if ( ! empty($esm_stored_data['profile-personal-title']) ) echo esc_attr( $esm_stored_data['profile-personal-title'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="profile-mission" class="row-title">Mission:</label>
			</div>
			<div class="meta-td">
				<select name="profile-mission" id="profile-mission">
					<option value="student" <?php if ( ! empty($esm_stored_data['profile-mission']) ) if ( $esm_stored_data['profile-mission'] === "student" ) echo "slected"; ?> >Student</option>
					<option value="team" <?php if ( ! empty($esm_stored_data['profile-mission']) ) if ( $esm_stored_data['profile-mission'] === "team" ) echo "slected"; ?>>Team</option>
				</select>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="profile-description" class="row-title">Description:</label>
			</div>
			<div class="meta-td">
				<textarea rows="7" cols="25" name="profile-description" id="profile-description"><?php if ( ! empty($esm_stored_data['profile-description']) ) echo esc_attr( $esm_stored_data['profile-description'][0] ); ?></textarea>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="profile-listing-position" class="row-title">Listing position index:</label>
			</div>
			<div class="meta-td">
				<input type="number" name="profile-listing-position" id="profile-listing-position" value="<?php if ( ! empty($esm_stored_data['profile-listing-position']) ) echo esc_attr( $esm_stored_data['profile-listing-position'][0] ); ?>">
			</div>
		</div>
	</div>
<?php	
}

function esm_profile_meta_save( $post_id )
{
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['esm_contact_nonce'] ) && wp_verify_nonce( $_POST['esm_contact_nonce'], basename(__FILE__) ) ) ? 'true' : 'false';

	// Exists script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce )
	{
		return;
	}

	if ( isset( $_POST['profile-name'] ) )
	{
		update_post_meta( $post_id, 'profile-name', sanitize_text_field( $_POST['profile-name'] ) );

		// insert title
		global $wpdb;
		$where = array( 'ID' => $post_id );
		$wpdb->update( $wpdb->posts, array( 'post_title' => $_POST['profile-name'] ), $where );
	}
	if ( isset( $_POST['profile-personal-title'] ) )
	{
		update_post_meta( $post_id, 'profile-personal-title', sanitize_text_field( $_POST['profile-personal-title'] ) );
	}
	if ( isset( $_POST['profile-mission'] ) )
	{
		update_post_meta( $post_id, 'profile-mission', sanitize_text_field( $_POST['profile-mission'] ) );
	}
	if ( isset( $_POST['profile-description'] ) )
	{
		update_post_meta( $post_id, 'profile-description', sanitize_text_field( $_POST['profile-description'] ) );
	}
	if ( isset( $_POST['profile-listing-position'] ) )
	{
		update_post_meta( $post_id, 'profile-listing-position', sanitize_text_field( $_POST['profile-listing-position'] ) );
	}

}
add_action( 'save_post', 'esm_profile_meta_save' );