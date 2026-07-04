<?php
/**
 * Jacob Theme Quote Form Submission Handler
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Helper to securely store quote status in a temporary cookie and redirect back to clean referrer.
 */
function jacob_quote_redirect_with_status( $status ) {
    setcookie( 'quote_status', $status, time() + 30, '/' );
    wp_safe_redirect( wp_get_referer() . '#quote-name' );
    exit;
}

/**
 * Handle front-end quote form submissions.
 */
function jacob_handle_quote_submission() {
    // Check if the form was submitted
    if ( ! isset( $_POST['action'] ) || $_POST['action'] !== 'submit_quote' ) {
        return;
    }

    // Verify security nonce
    if ( ! isset( $_POST['quote_nonce'] ) || ! wp_verify_nonce( $_POST['quote_nonce'], 'jacob_submit_quote_nonce' ) ) {
        jacob_quote_redirect_with_status( 'invalid_nonce' );
    }

    // Required fields verification
    $required_fields = array( 'name', 'phone', 'email', 'location', 'service' );
    $missing_field   = false;
    foreach ( $required_fields as $field ) {
        if ( empty( $_POST[$field] ) ) {
            $missing_field = true;
        }
    }
    if ( $missing_field ) {
        jacob_quote_redirect_with_status( 'missing_fields' );
    }

    // Validate name format (characters and spaces only)
    $name_to_validate = sanitize_text_field( $_POST['name'] );
    if ( ! preg_match( '/^[a-zA-Z\s]+$/', $name_to_validate ) ) {
        jacob_quote_redirect_with_status( 'invalid_name' );
    }

    // Validate email format (auto-clear spaces first)
    $email_raw = isset( $_POST['email'] ) ? str_replace( ' ', '', $_POST['email'] ) : '';
    $email     = sanitize_email( $email_raw );
    if ( ! is_email( $email ) ) {
        jacob_quote_redirect_with_status( 'invalid_email' );
    }

    // Validate phone number format (digits, spaces, and +, -, (, ) only)
    $phone_to_validate = sanitize_text_field( $_POST['phone'] );
    if ( ! preg_match( '/^[0-9\-\+\(\)\s]+$/', $phone_to_validate ) ) {
        jacob_quote_redirect_with_status( 'invalid_phone' );
    }

    // Sanitize other text inputs
    $name     = sanitize_text_field( $_POST['name'] );
    $phone    = sanitize_text_field( $_POST['phone'] );
    $location = sanitize_text_field( $_POST['location'] );
    $service  = sanitize_text_field( $_POST['service'] );
    $message  = sanitize_textarea_field( $_POST['message'] );

    // Resolve service display name
    $service_display = esc_html( $service );
    // Try to query the service CPT to get the real title
    $service_post = get_page_by_path( $service, OBJECT, 'service' );
    if ( ! empty( $service_post ) ) {
        $service_display = get_the_title( $service_post );
    }

    // Handle file uploads securely if present
    $uploaded_files = array();
    if ( ! empty( $_FILES['files'] ) && is_array( $_FILES['files']['name'] ) ) {
        require_once ABSPATH . 'wp-admin/includes/file.php';

        $file_count = count( $_FILES['files']['name'] );
        $file_keys  = array_keys( $_FILES['files'] );

        $allowed_mime_types = array(
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg',
            'image/png',
            'image/gif',
        );
        $max_file_size = 5 * 1024 * 1024; // 5MB limit

        // Prepare secure attachments directory
        $secure_dir = WP_CONTENT_DIR . '/secure_quote_requests/';
        if ( ! file_exists( $secure_dir ) ) {
            wp_mkdir_p( $secure_dir );
        }
        $htaccess_file = $secure_dir . '.htaccess';
        if ( ! file_exists( $htaccess_file ) ) {
            file_put_contents( $htaccess_file, "Deny from all\n" );
        }

        for ( $i = 0; $i < $file_count; $i++ ) {
            if ( empty( $_FILES['files']['name'][$i] ) ) {
                continue;
            }

            $restructured_file = array();
            foreach ( $file_keys as $key ) {
                $restructured_file[$key] = $_FILES['files'][$key][$i];
            }

            // Verify size limit
            if ( $restructured_file['size'] > $max_file_size ) {
                jacob_quote_redirect_with_status( 'file_too_large' );
            }

            // Double check file content integrity using WP core checking (prevents spoofing)
            $wp_filetype = wp_check_filetype_and_ext( $restructured_file['tmp_name'], $restructured_file['name'] );
            $ext  = empty( $wp_filetype['ext'] ) ? '' : $wp_filetype['ext'];
            $type = empty( $wp_filetype['type'] ) ? '' : $wp_filetype['type'];

            if ( ! in_array( $type, $allowed_mime_types, true ) || empty( $ext ) ) {
                jacob_quote_redirect_with_status( 'invalid_file_type' );
            }

            // Generate unique, unpredictable filename suffix to prevent URL guessing
            $file_ext   = pathinfo( $restructured_file['name'], PATHINFO_EXTENSION );
            $file_base  = pathinfo( $restructured_file['name'], PATHINFO_FILENAME );
            $unique_name = sanitize_file_name( $file_base ) . '-' . wp_generate_password( 12, false ) . '.' . $file_ext;
            $target_path = $secure_dir . $unique_name;

            if ( move_uploaded_file( $restructured_file['tmp_name'], $target_path ) ) {
                $uploaded_files[] = array(
                    'name' => $restructured_file['name'],
                    'path' => $target_path,
                );
            }
        }
    }

    // Save lead data as custom post type 'quote_request'
    $post_data = array(
        'post_title'   => wp_strip_all_tags( $name ),
        'post_content' => $message,
        'post_status'  => 'publish',
        'post_type'    => 'quote_request',
    );
    $lead_id = wp_insert_post( $post_data );

    if ( is_wp_error( $lead_id ) ) {
        jacob_quote_redirect_with_status( 'db_error' );
    }

    // Update post meta fields
    update_post_meta( $lead_id, 'lead_phone', $phone );
    update_post_meta( $lead_id, 'lead_email', $email );
    update_post_meta( $lead_id, 'lead_location', $location );
    update_post_meta( $lead_id, 'lead_service', $service );
    update_post_meta( $lead_id, 'lead_attachments', $uploaded_files );

    // Compile Attachments list HTML for the email
    $attachments_html = '';
    if ( ! empty( $uploaded_files ) ) {
        $attachments_html .= '<h2>Attachments</h2><ul class="attachments-list">';
        foreach ( $uploaded_files as $idx => $file_info ) {
            $file_num = $idx + 1;
            $download_url = add_query_arg(
                array(
                    'download_lead_file' => $lead_id,
                    'file_index'         => $idx,
                ),
                home_url( '/' )
            );
            $attachments_html .= '<li><a href="' . esc_url( $download_url ) . '" target="_blank">Download Attachment ' . $file_num . ' (' . esc_html( $file_info['name'] ) . ')</a></li>';
        }
        $attachments_html .= '</ul>';
    }

    // Compose HTML Email notification
    $to      = get_theme_mod( 'jacob_quote_recipient_email', get_option( 'admin_email' ) );
    $subject = 'New Quote Request: ' . $name . ' - ' . $service_display;
    
    // HTML Email Template
    $body = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Quote Request</title>
    <style>
        body { font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; background-color: #f4f4f5; color: #1f2937; margin: 0; padding: 20px; }
        .email-container { max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); margin: 0 auto; border: 1px solid #e5e7eb; }
        .email-header { background-color: #111827; padding: 30px; text-align: center; border-bottom: 4px solid #ff9f1c; }
        .email-header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 0.5px; }
        .email-body { padding: 40px 30px; }
        .email-body h2 { font-size: 18px; margin-top: 0; margin-bottom: 20px; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .info-table th { width: 30%; text-align: left; padding: 12px 10px; border-bottom: 1px solid #f3f4f6; color: #6b7280; font-size: 14px; font-weight: 600; }
        .info-table td { padding: 12px 10px; border-bottom: 1px solid #f3f4f6; color: #1f2937; font-size: 14px; }
        .message-box { background-color: #f9fafb; border-left: 4px solid #ff9f1c; padding: 20px; border-radius: 4px; font-size: 14px; line-height: 1.6; color: #4b5563; margin-bottom: 30px; }
        .attachments-list { list-style: none; padding: 0; margin: 0; }
        .attachments-list li { margin-bottom: 8px; font-size: 14px; }
        .attachments-list a { color: #ff9f1c; text-decoration: none; font-weight: 600; }
        .attachments-list a:hover { text-decoration: underline; }
        .email-footer { background-color: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Jacob General Construction</h1>
        </div>
        <div class="email-body">
            <h2>New Quote Request Received</h2>
            <table class="info-table">
                <tr>
                    <th>Full Name</th>
                    <td>' . esc_html( $name ) . '</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>' . esc_html( $phone ) . '</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>' . esc_html( $email ) . '</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>' . esc_html( $location ) . '</td>
                </tr>
                <tr>
                    <th>Service Needed</th>
                    <td>' . esc_html( $service_display ) . '</td>
                </tr>
            </table>

            <h2>Project Details</h2>
            <div class="message-box">
                ' . nl2br( esc_html( $message ) ) . '
            </div>

            ' . $attachments_html . '
        </div>
        <div class="email-footer">
            <p>This email was sent automatically from the Quote Request form on your website.</p>
        </div>
    </div>
</body>
</html>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Jacob General Construction <' . get_option( 'admin_email' ) . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    wp_mail( $to, $subject, $body, $headers );

    // Redirect to home page with success status
    jacob_quote_redirect_with_status( 'success' );
}
add_action( 'init', 'jacob_handle_quote_submission' );

/**
 * Handle secure attachment file downloads for administrators.
 */
function jacob_handle_secure_file_download() {
    if ( isset( $_GET['download_lead_file'] ) ) {
        if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Access denied. You must be logged in as an administrator to download this file.', 'Access Denied', array( 'response' => 403 ) );
        }

        $lead_id = intval( $_GET['download_lead_file'] );
        $file_index = isset( $_GET['file_index'] ) ? intval( $_GET['file_index'] ) : 0;

        $attachments = get_post_meta( $lead_id, 'lead_attachments', true );
        if ( ! empty( $attachments ) && is_array( $attachments ) && isset( $attachments[$file_index] ) ) {
            $file_info = $attachments[$file_index];
            $filepath = $file_info['path'] ?? '';
            $filename = $file_info['name'] ?? '';

            if ( $filepath && file_exists( $filepath ) ) {
                // Prevent path traversal attacks
                $secure_dir = WP_CONTENT_DIR . '/secure_quote_requests/';
                if ( strpos( realpath( $filepath ), realpath( $secure_dir ) ) === 0 ) {
                    // Send headers
                    header( 'Content-Description: File Transfer' );
                    header( 'Content-Type: application/octet-stream' );
                    header( 'Content-Disposition: attachment; filename="' . basename( $filename ) . '"' );
                    header( 'Expires: 0' );
                    header( 'Cache-Control: must-revalidate' );
                    header( 'Pragma: public' );
                    header( 'Content-Length: ' . filesize( $filepath ) );

                    // Clear output buffer
                    if ( ob_get_level() ) {
                        ob_end_clean();
                    }

                    readfile( $filepath );
                    exit;
                }
            }
        }
        wp_die( 'File not found.', 'Not Found', array( 'response' => 404 ) );
    }
}
add_action( 'init', 'jacob_handle_secure_file_download' );

/**
 * Configure PHPMailer to align Return-Path (Sender) with the From address.
 */
function jacob_clean_phpmailer_headers( $phpmailer ) {
    $phpmailer->Sender = $phpmailer->From;
}
add_action( 'phpmailer_init', 'jacob_clean_phpmailer_headers' );
