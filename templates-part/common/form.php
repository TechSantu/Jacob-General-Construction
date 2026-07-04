<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>

                <div class="quote_form_container">
                    <p class="quote_label"><i class="fa-regular fa-file-lines"></i> GET A QUOTE</p>
                    <h2>Let's Build Something <span class="highlight">Great</span> Together</h2>
                    <p class="quote_desc">Tell us about your project and we'll provide a custom quote tailored to your
                        needs.</p>

                    <?php
                    $status = isset( $_COOKIE['quote_status'] ) ? sanitize_key( $_COOKIE['quote_status'] ) : '';
                    if ( $status === 'success' ) {
                        echo '<div class="alert alert_success"><i class="fa-solid fa-circle-check"></i> Thank you! Your quote request has been sent successfully.</div>';
                    }
                    if ( $status === 'invalid_nonce' ) {
                        echo '<div class="alert alert_danger"><i class="fa-solid fa-circle-xmark"></i> Security check failed. Please try again.</div>';
                    }
                    if ( $status === 'missing_fields' ) {
                        echo '<div class="alert alert_danger"><i class="fa-solid fa-circle-xmark"></i> Please fill in all required fields.</div>';
                    }
                    if ( $status === 'invalid_email' ) {
                        echo '<div class="alert alert_danger"><i class="fa-solid fa-circle-xmark"></i> Please enter a valid email address.</div>';
                    }
                    if ( $status === 'file_too_large' ) {
                        echo '<div class="alert alert_danger"><i class="fa-solid fa-circle-xmark"></i> Uploaded file is too large. Maximum size is 5MB.</div>';
                    }
                    if ( $status === 'invalid_file_type' ) {
                        echo '<div class="alert alert_danger"><i class="fa-solid fa-circle-xmark"></i> Invalid file type. Only PDF, DOC/DOCX, and images are allowed.</div>';
                    }
                    if ( $status === 'invalid_phone' ) {
                        echo '<div class="alert alert_danger"><i class="fa-solid fa-circle-xmark"></i> Please enter a valid phone number containing only digits, spaces, and standard symbols.</div>';
                    }
                    if ( $status === 'invalid_name' ) {
                        echo '<div class="alert alert_danger"><i class="fa-solid fa-circle-xmark"></i> Full Name must contain characters and spaces only.</div>';
                    }
                    if ( $status === 'db_error' ) {
                        echo '<div class="alert alert_danger"><i class="fa-solid fa-circle-xmark"></i> An error occurred while saving your request. Please try again.</div>';
                    }

                    if ( ! empty( $status ) ) {
                        setcookie( 'quote_status', '', time() - 3600, '/' );
                    }
                    ?>

                    <form class="quote_form" action="" method="POST" enctype="multipart/form-data">
                        <?php wp_nonce_field( 'jacob_submit_quote_nonce', 'quote_nonce' ); ?>
                        <input type="hidden" name="action" value="submit_quote">

                        <div class="form_row">
                            <div class="form_group has_icon">
                                <label for="quote-name">Full Name *</label>
                                <div class="input_wrapper">
                                    <input type="text" id="quote-name" name="name" placeholder="Full Name" pattern="[a-zA-Z\s]+" title="Please enter only letters and spaces." required>
                                    <i class="fa-regular fa-user field_icon"></i>
                                </div>
                            </div>
                            <div class="form_group has_icon">
                                <label for="quote-phone">Phone Number *</label>
                                <div class="input_wrapper">
                                    <input type="tel" id="quote-phone" name="phone" placeholder="Phone Number" pattern="[0-9\-\+\(\)\s]+" title="Please enter a valid phone number containing only numbers, spaces, or +, -, (, )" required>
                                    <i class="fa-solid fa-phone field_icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form_row">
                            <div class="form_group has_icon">
                                <label for="quote-email">Email Address *</label>
                                <div class="input_wrapper">
                                    <input type="email" id="quote-email" name="email" placeholder="Email Address"
                                        required>
                                    <i class="fa-regular fa-envelope field_icon"></i>
                                </div>
                            </div>
                            <div class="form_group has_icon">
                                <label for="quote-location">Project Location *</label>
                                <div class="input_wrapper">
                                    <input type="text" id="quote-location" name="location"
                                        placeholder="Project Location" required>
                                    <i class="fa-solid fa-location-dot field_icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form_group">
                            <label for="quote-service">Service Needed *</label>
                            <div class="select_wrapper">
                                <select id="quote-service" name="service" required>
                                    <option value="" disabled selected>Select a service</option>
                                    <?php
                                    $services_query = new WP_Query( array(
                                        'post_type'      => 'service',
                                        'posts_per_page' => -1,
                                        'post_status'    => 'publish',
                                    ) );
                                    if ( $services_query->have_posts() ) :
                                        while ( $services_query->have_posts() ) : $services_query->the_post();
                                            ?>
                                            <option value="<?php echo esc_attr( get_post_field( 'post_name', get_the_ID() ) ); ?>">
                                                <?php the_title(); ?>
                                            </option>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form_group has_icon textarea_group">
                            <label for="quote-message">Project Details</label>
                            <div class="input_wrapper">
                                <textarea id="quote-message" name="message" rows="4"
                                    placeholder="Please describe your project, include size, scope, timeline, or any specific requirements."></textarea>
                                <i class="fa-solid fa-pencil field_icon"></i>
                            </div>
                        </div>

                        <div class="file_upload_zone" onclick="document.getElementById('quote-files').click();">
                            <i class="fa-solid fa-cloud-arrow-up cloud_icon"></i>
                            <div class="upload_text">
                                <strong>Upload Plans or Photos <span class="opt_text">(Optional)</span></strong>
                                <p>Drag & drop files here or click to browse</p>
                            </div>
                            <input type="file" id="quote-files" name="files[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif" style="display: none;">
                        </div>
                        <div id="selected-files-list" class="selected_files_list"></div>

                        <div class="form_actions">
                            <button type="submit" class="send_request_btn">
                                <i class="fa-solid fa-paper-plane"></i> SEND REQUEST
                            </button>
                            <div class="privacy_note">
                                <i class="fa-solid fa-lock"></i>
                                <div class="privacy_text">
                                    <strong>We respect your privacy.</strong>
                                    <p>Your information is safe with us.</p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Phone validation and key blocking
                        var phoneInput = document.getElementById('quote-phone');
                        if (phoneInput) {
                            phoneInput.addEventListener('keypress', function(e) {
                                var char = String.fromCharCode(e.which);
                                if (!/[0-9\-\+\(\)\s]/.test(char)) {
                                    e.preventDefault();
                                }
                            });
                            phoneInput.addEventListener('paste', function(e) {
                                var clipboardData = e.clipboardData || window.clipboardData;
                                var pastedData = clipboardData.getData('Text');
                                if (/[^0-9\-\+\(\)\s]/.test(pastedData)) {
                                    e.preventDefault();
                                }
                            });
                        }

                        // Email auto space clear
                        var emailInput = document.getElementById('quote-email');
                        if (emailInput) {
                            emailInput.addEventListener('keypress', function(e) {
                                if (e.which === 32) {
                                    e.preventDefault();
                                }
                            });
                            emailInput.addEventListener('input', function(e) {
                                this.value = this.value.replace(/\s+/g, '');
                            });
                        }

                        // Name validation and key blocking (characters only)
                        var nameInput = document.getElementById('quote-name');
                        if (nameInput) {
                            nameInput.addEventListener('keypress', function(e) {
                                var char = String.fromCharCode(e.which);
                                if (!/[a-zA-Z\s]/.test(char)) {
                                    e.preventDefault();
                                }
                            });
                            nameInput.addEventListener('paste', function(e) {
                                var clipboardData = e.clipboardData || window.clipboardData;
                                var pastedData = clipboardData.getData('Text');
                                if (/[^a-zA-Z\s]/.test(pastedData)) {
                                    e.preventDefault();
                                }
                            });
                        }

                        // File management upload array & list UI
                        var fileInput = document.getElementById('quote-files');
                        var listContainer = document.getElementById('selected-files-list');
                        var filesArray = [];

                        if (fileInput && listContainer) {
                            fileInput.addEventListener('change', function(e) {
                                // Add selected files to array
                                for (var i = 0; i < fileInput.files.length; i++) {
                                    filesArray.push(fileInput.files[i]);
                                }
                                updateFileList();
                            });

                            function updateFileList() {
                                listContainer.innerHTML = '';
                                var dt = new DataTransfer();

                                filesArray.forEach(function(file, index) {
                                    dt.items.add(file);

                                    var fileRow = document.createElement('div');
                                    fileRow.className = 'uploaded_file_row';

                                    var infoSpan = document.createElement('span');
                                    infoSpan.className = 'uploaded_file_info';
                                    infoSpan.innerHTML = '<i class="fa-regular fa-file"></i> <strong>' + file.name + '</strong> (' + (file.size / 1024).toFixed(1) + ' KB) - <span class="upload_done_status">done</span>';

                                    var removeBtn = document.createElement('button');
                                    removeBtn.type = 'button';
                                    removeBtn.className = 'remove_file_btn';
                                    removeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                                    removeBtn.addEventListener('click', function() {
                                        filesArray.splice(index, 1);
                                        updateFileList();
                                    });

                                    fileRow.appendChild(infoSpan);
                                    fileRow.appendChild(removeBtn);
                                    listContainer.appendChild(fileRow);
                                });

                                fileInput.files = dt.files;
                            }
                        }
                    });
                    </script>
                </div>