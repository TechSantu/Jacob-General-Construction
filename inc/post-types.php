<?php
/**
 * Register Custom Post Types.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function jacob_register_post_types() {
	$labels = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'jacob' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'jacob' ),
		'menu_name'             => __( 'Services', 'jacob' ),
		'name_admin_bar'        => __( 'Service', 'jacob' ),
		'archives'              => __( 'Service Archives', 'jacob' ),
		'attributes'            => __( 'Service Attributes', 'jacob' ),
		'parent_item_colon'     => __( 'Parent Service:', 'jacob' ),
		'all_items'             => __( 'All Services', 'jacob' ),
		'add_new_item'          => __( 'Add New Service', 'jacob' ),
		'add_new'               => __( 'Add New', 'jacob' ),
		'new_item'              => __( 'New Service', 'jacob' ),
		'edit_item'             => __( 'Edit Service', 'jacob' ),
		'update_item'           => __( 'Update Service', 'jacob' ),
		'view_item'             => __( 'View Service', 'jacob' ),
		'view_items'            => __( 'View Services', 'jacob' ),
		'search_items'          => __( 'Search Service', 'jacob' ),
		'not_found'             => __( 'Not found', 'jacob' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jacob' ),
		'featured_image'        => __( 'Featured Image', 'jacob' ),
		'set_featured_image'    => __( 'Set featured image', 'jacob' ),
		'remove_featured_image' => __( 'Remove featured image', 'jacob' ),
		'use_featured_image'    => __( 'Use as featured image', 'jacob' ),
		'insert_into_item'      => __( 'Insert into service', 'jacob' ),
		'uploaded_to_this_item' => __( 'Uploaded to this service', 'jacob' ),
		'items_list'            => __( 'Services list', 'jacob' ),
		'items_list_navigation' => __( 'Services list navigation', 'jacob' ),
		'filter_items_list'     => __( 'Filter services list', 'jacob' ),
	);
	$args = array(
		'label'                 => __( 'Service', 'jacob' ),
		'description'           => __( 'Services provided by Jacob General Construction', 'jacob' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-hammer',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'service', $args );

	$testimonial_labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'jacob' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'jacob' ),
		'menu_name'             => __( 'Testimonials', 'jacob' ),
		'name_admin_bar'        => __( 'Testimonial', 'jacob' ),
		'archives'              => __( 'Testimonial Archives', 'jacob' ),
		'attributes'            => __( 'Testimonial Attributes', 'jacob' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'jacob' ),
		'all_items'             => __( 'All Testimonials', 'jacob' ),
		'add_new_item'          => __( 'Add New Testimonial', 'jacob' ),
		'add_new'               => __( 'Add New', 'jacob' ),
		'new_item'              => __( 'New Testimonial', 'jacob' ),
		'edit_item'             => __( 'Edit Testimonial', 'jacob' ),
		'update_item'           => __( 'Update Testimonial', 'jacob' ),
		'view_item'             => __( 'View Testimonial', 'jacob' ),
		'view_items'            => __( 'View Testimonials', 'jacob' ),
		'search_items'          => __( 'Search Testimonial', 'jacob' ),
		'not_found'             => __( 'Not found', 'jacob' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jacob' ),
		'featured_image'        => __( 'Client Avatar', 'jacob' ),
		'set_featured_image'    => __( 'Set client avatar', 'jacob' ),
		'remove_featured_image' => __( 'Remove client avatar', 'jacob' ),
		'use_featured_image'    => __( 'Use as client avatar', 'jacob' ),
		'insert_into_item'      => __( 'Insert into testimonial', 'jacob' ),
		'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'jacob' ),
		'items_list'            => __( 'Testimonials list', 'jacob' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'jacob' ),
		'filter_items_list'     => __( 'Filter testimonials list', 'jacob' ),
	);
	$testimonial_args = array(
		'label'                 => __( 'Testimonial', 'jacob' ),
		'description'           => __( 'Client reviews and testimonials', 'jacob' ),
		'labels'                => $testimonial_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-testimonial',
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'testimonial', $testimonial_args );

	$project_labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'jacob' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'jacob' ),
		'menu_name'             => __( 'Projects', 'jacob' ),
		'name_admin_bar'        => __( 'Project', 'jacob' ),
		'archives'              => __( 'Project Archives', 'jacob' ),
		'attributes'            => __( 'Project Attributes', 'jacob' ),
		'parent_item_colon'     => __( 'Parent Project:', 'jacob' ),
		'all_items'             => __( 'All Projects', 'jacob' ),
		'add_new_item'          => __( 'Add New Project', 'jacob' ),
		'add_new'               => __( 'Add New', 'jacob' ),
		'new_item'              => __( 'New Project', 'jacob' ),
		'edit_item'             => __( 'Edit Project', 'jacob' ),
		'update_item'           => __( 'Update Project', 'jacob' ),
		'view_item'             => __( 'View Project', 'jacob' ),
		'view_items'            => __( 'View Projects', 'jacob' ),
		'search_items'          => __( 'Search Project', 'jacob' ),
		'not_found'             => __( 'Not found', 'jacob' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jacob' ),
		'featured_image'        => __( 'Project Image', 'jacob' ),
		'set_featured_image'    => __( 'Set project image', 'jacob' ),
		'remove_featured_image' => __( 'Remove project image', 'jacob' ),
		'use_featured_image'    => __( 'Use as project image', 'jacob' ),
		'insert_into_item'      => __( 'Insert into project', 'jacob' ),
		'uploaded_to_this_item' => __( 'Uploaded to this project', 'jacob' ),
		'items_list'            => __( 'Projects list', 'jacob' ),
		'items_list_navigation' => __( 'Projects list navigation', 'jacob' ),
		'filter_items_list'     => __( 'Filter projects list', 'jacob' ),
	);
	$project_args = array(
		'label'                 => __( 'Project', 'jacob' ),
		'description'           => __( 'Completed site and construction projects', 'jacob' ),
		'labels'                => $project_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 7,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'project', $project_args );

	$quote_request_labels = array(
		'name'                  => _x( 'Quote Requests', 'Post Type General Name', 'jacob' ),
		'singular_name'         => _x( 'Quote Request', 'Post Type Singular Name', 'jacob' ),
		'menu_name'             => __( 'Quote Requests', 'jacob' ),
		'name_admin_bar'        => __( 'Quote Request', 'jacob' ),
		'archives'              => __( 'Quote Request Archives', 'jacob' ),
		'attributes'            => __( 'Quote Request Attributes', 'jacob' ),
		'parent_item_colon'     => __( 'Parent Quote Request:', 'jacob' ),
		'all_items'             => __( 'All Quote Requests', 'jacob' ),
		'add_new_item'          => __( 'Add New Quote Request', 'jacob' ),
		'add_new'               => __( 'Add New', 'jacob' ),
		'new_item'              => __( 'New Quote Request', 'jacob' ),
		'edit_item'             => __( 'Edit Quote Request', 'jacob' ),
		'update_item'           => __( 'Update Quote Request', 'jacob' ),
		'view_item'             => __( 'View Quote Request', 'jacob' ),
		'view_items'            => __( 'View Quote Requests', 'jacob' ),
		'search_items'          => __( 'Search Quote Request', 'jacob' ),
		'not_found'             => __( 'Not found', 'jacob' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'jacob' ),
		'items_list'            => __( 'Quote Requests list', 'jacob' ),
		'items_list_navigation' => __( 'Quote Requests list navigation', 'jacob' ),
		'filter_items_list'     => __( 'Filter quote requests list', 'jacob' ),
	);
	$quote_request_args = array(
		'label'                 => __( 'Quote Request', 'jacob' ),
		'description'           => __( 'Submissions from Get A Free Quote form', 'jacob' ),
		'labels'                => $quote_request_labels,
		'supports'              => array( 'title', 'editor', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 8,
		'menu_icon'             => 'dashicons-email-alt',
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'quote_request', $quote_request_args );
}
add_action( 'init', 'jacob_register_post_types', 0 );

// Add columns to Quote Requests admin list table
function jacob_set_quote_request_columns( $columns ) {
    $new_columns = array(
        'cb'       => $columns['cb'],
        'title'    => __( 'Name', 'jacob' ),
        'email'    => __( 'Email', 'jacob' ),
        'phone'    => __( 'Phone', 'jacob' ),
        'service'  => __( 'Service Needed', 'jacob' ),
        'location' => __( 'Project Location', 'jacob' ),
        'date'     => $columns['date'],
    );
    return $new_columns;
}
add_filter( 'manage_quote_request_posts_columns', 'jacob_set_quote_request_columns' );

// Populate the custom columns
function jacob_custom_quote_request_column( $column, $post_id ) {
    if ( $column === 'email' ) {
        $email = get_post_meta( $post_id, 'lead_email', true );
        echo $email ? '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>' : '—';
    }
    if ( $column === 'phone' ) {
        $phone = get_post_meta( $post_id, 'lead_phone', true );
        echo $phone ? '<a href="tel:' . esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a>' : '—';
    }
    if ( $column === 'service' ) {
        $service = get_post_meta( $post_id, 'lead_service', true );
        $service_post = get_page_by_path( $service, OBJECT, 'service' );
        echo $service_post ? esc_html( get_the_title( $service_post ) ) : esc_html( $service );
    }
    if ( $column === 'location' ) {
        $location = get_post_meta( $post_id, 'lead_location', true );
        echo $location ? esc_html( $location ) : '—';
    }
}
add_action( 'manage_quote_request_posts_custom_column', 'jacob_custom_quote_request_column', 10, 2 );

// Make columns sortable
function jacob_sortable_quote_request_columns( $columns ) {
    $columns['service'] = 'service';
    $columns['location'] = 'location';
    return $columns;
}
add_filter( 'manage_edit-quote_request_sortable_columns', 'jacob_sortable_quote_request_columns' );

// Register Meta Box for Quote Request details
function jacob_add_quote_request_meta_box() {
    add_meta_box(
        'quote_request_details',
        __( 'Quote Request Details', 'jacob' ),
        'jacob_render_quote_request_meta_box',
        'quote_request',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jacob_add_quote_request_meta_box' );

// Render Meta Box content
function jacob_render_quote_request_meta_box( $post ) {
    $phone       = get_post_meta( $post->ID, 'lead_phone', true );
    $email       = get_post_meta( $post->ID, 'lead_email', true );
    $location    = get_post_meta( $post->ID, 'lead_location', true );
    $service     = get_post_meta( $post->ID, 'lead_service', true );
    $attachments = get_post_meta( $post->ID, 'lead_attachments', true );

    $service_post = get_page_by_path( $service, OBJECT, 'service' );
    $service_title = $service_post ? get_the_title( $service_post ) : $service;
    ?>
    <table class="form-table">
        <tr>
            <th><label><?php esc_html_e( 'Phone Number', 'jacob' ); ?></label></th>
            <td>
                <?php if ( $phone ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>">
                        <strong><?php echo esc_html( $phone ); ?></strong>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label><?php esc_html_e( 'Email Address', 'jacob' ); ?></label></th>
            <td>
                <?php if ( $email ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>">
                        <strong><?php echo esc_html( $email ); ?></strong>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label><?php esc_html_e( 'Project Location', 'jacob' ); ?></label></th>
            <td><?php echo esc_html( $location ); ?></td>
        </tr>
        <tr>
            <th><label><?php esc_html_e( 'Service Requested', 'jacob' ); ?></label></th>
            <td><?php echo esc_html( $service_title ); ?></td>
        </tr>
        <?php if ( ! empty( $attachments ) && is_array( $attachments ) ) : ?>
            <tr>
                <th><label><?php esc_html_e( 'Uploaded Plans/Photos', 'jacob' ); ?></label></th>
                <td>
                    <ul style="margin: 0; padding-left: 20px; list-style-type: square;">
                        <?php foreach ( $attachments as $idx => $file_info ) : 
                            $filename = $file_info['name'] ?? '';
                            $download_url = add_query_arg(
                                array(
                                    'download_lead_file' => $post->ID,
                                    'file_index'         => $idx,
                                ),
                                home_url( '/' )
                            );
                            ?>
                            <li style="margin-bottom: 5px;">
                                <a href="<?php echo esc_url( $download_url ); ?>" target="_blank" class="button button-small">
                                    <?php echo esc_html( $filename ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endif; ?>
    </table>
    <?php
}

