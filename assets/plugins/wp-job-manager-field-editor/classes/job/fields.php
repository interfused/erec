<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class WP_Job_Manager_Field_Editor_Job_Fields
 *
 * @since 1.1.9
 *
 */
class WP_Job_Manager_Field_Editor_Job_Fields extends WP_Job_Manager_Field_Editor_Integration {

	private $validate_errors = false;
	private $force_validate = false;
	private $original_submit_handler;

	function __construct() {

		add_filter( 'submit_job_form_fields', array( $this, 'init_fields' ), 100 );
		add_filter( 'submit_job_form_fields_get_job_data', array( $this, 'get_job_data' ), 100, 2 );
		add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_fields' ), 100 );
		add_filter( 'job_manager_save_job_listing', array( $this, 'save_admin_fields' ), 100, 2 );
		add_action( 'job_manager_update_job_data', array( $this, 'save_fields' ), 100, 2 );
		// add_filter( 'submit_job_steps', array( $this, 'steps' ), 100 );
		add_filter( 'submit_job_wp_handle_upload_overrides', array( $this, 'upload_overrides' ), 100 );
		add_filter( 'submit_job_form_fields_get_user_data', array( $this, 'get_user_data' ), 100, 2 );
		add_filter( 'submit_job_form_required_label', array( $this, 'custom_required_label' ), 100, 2 );
		add_filter( 'submit_job_form_submit_button_text', array( $this, 'custom_submit_button' ), 100 );
		add_action( 'submit_job_form_job_fields_start', array( $this, 'job_package_field' ) );

		add_filter( 'submit_job_form_validate_fields', array( $this, 'check_uploads' ), 9999, 3 );
		add_filter( 'job_manager_upload_file_pre_upload', array( $this, 'test_upload' ), 9999, 3 );

		// Called only from class-wp-job-manager-form-submit-job
		// add_filter( 'submit_job_form_fields_get_user_data', array( $this, 'new_job_fields' ), 100, 2 );
	}

	function test_upload( $file, $args, $allowed_mime_types ){

		//return new WP_Error( 'upload', 'not while im in charge' );

		return $file;
	}


	/**
	 * Get Job Field Data
	 *
	 * Called by submit() in both edit and submit form classes and includes all
	 * fields with the value set in the field array config.
	 *
	 * Submit form class calls this method when editing a listing already previewed (so the listing is draft)
	 * Edit form class class this method when editing a listing to populate the values
	 *
	 *
	 * @since 1.3.6
	 *
	 * @param $fields
	 * @param $job
	 *
	 * @return mixed
	 */
	function get_job_data( $fields, $job ){

		$fields = $this->new_job_fields( $fields );
		$fields = $this->remove_invalid_fields( $fields );
		$fields = WP_Job_Manager_Field_Editor_Fields_Date::convert_fields( $fields );

		return $fields;

	}

	/**
	 * WPJM Step Filtering
	 *
	 *
	 * @since 1.1.9
	 *
	 * @param $steps
	 *
	 * @return mixed
	 */
	function steps( $steps ){

		// Cache the original default handler so we can call it after our submit handler
		$this->original_submit_handler = $steps[ 'submit' ][ 'handler' ];

		$steps[ 'submit' ][ 'handler' ] = array( $this, 'submit_handler' );

		return $steps;

	}

	/**
	 * WPJM Submit Handler Override
	 *
	 *
	 * @since 1.1.9
	 *
	 */
	function submit_handler(){

		$this->force_validate = true;
		$this->validate_errors = $this->wpjm()->validation_errors();

		// Call original cached submit handler
		call_user_func( $this->original_submit_handler );

	}

	/**
	 * Update Custom Job and Company Field Post Meta
	 *
	 * Called after WPJM updates job_listing post meta with default fields
	 *
	 * @since 1.1.9
	 *
	 * @param $job_id
	 * @param $values
	 *
	 */
	function save_fields( $job_id, $values ) {

		$this->save_custom_fields( 'job', $job_id, $values );
		$this->save_custom_fields( 'company', $job_id, $values );

	}

	/**
	 * Output Job and Company fields in Admin
	 *
	 * Called by WP Job Manager filter on admin side to return
	 * job and company fields with user customization.
	 *
	 * @since 1.1.9
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function admin_fields( $fields ) {

		return $this->prep_admin_fields( array( 'job', 'company' ), $fields );

	}

	/**
	 * Add a hidden field with product id to form
	 *
	 *
	 * @since 1.2.2
	 *
	 */
	function job_package_field(){

		if( WP_Job_Manager_Field_Editor_reCAPTCHA::is_enabled() ) wp_enqueue_script( 'jmfe-recaptcha' );

		$product_id  = isset( $_REQUEST[ 'wcpl_jmfe_product_id' ] ) ? intval( $_REQUEST[ 'wcpl_jmfe_product_id' ] ) : false;
		$package = isset( $_REQUEST[ 'job_package' ] ) ? sanitize_text_field( $_REQUEST[ 'job_package' ] ) : $product_id;

		if( $package ){
			$package = WP_Job_Manager_Field_Editor_Package_WC::get_product_id( $package );
			echo "<input type=\"hidden\" name=\"wcpl_jmfe_product_id\" value=\"{$package}\" />";
		}

	}

	/**
	 * Initialize Job and Company Fields
	 *
	 * Called by WP Job Manager filter in init_fields() to return job and
	 * company fields with user customization.
	 *
	 * Will return ALL fields including disabled fields
	 *
	 * @since 1.1.9
	 *
	 * @param array $fields
	 *
	 * @return mixed
	 */
	function init_fields( $fields ) {

		if ( ! $this->was_filter_forced() ) {

			$fields = $this->merge_with_custom_fields( $fields );

			// Remove resume fields after merge
			if( isset( $fields['resume_fields'] ) ) unset( $fields['resume_fields'] );

			$product_id = isset( $_REQUEST['wcpl_jmfe_product_id'] ) ? intval($_REQUEST['wcpl_jmfe_product_id']) : '';
			$job_package = isset( $_REQUEST['job_package'] ) ? sanitize_text_field( $_REQUEST['job_package'] ) : $product_id;
			$action = isset( $_REQUEST['action'] ) ? sanitize_text_field( $_REQUEST['action'] ) : false;
			$job_id = isset( $_REQUEST['job_id' ] ) ? intval( $_REQUEST['job_id'] ) : false;

			// Admin only filter
			$fields = $this->admin_only_fields( $fields );

			// Product/Package Handling, get job_package from post meta
			if( $job_id && empty( $job_package ) ) $job_package = WP_Job_Manager_Field_Editor_Package_WC::get_post_package_id( $job_id );

			// If listing is tied to package, filter so only fields for that package are shown
			if ( $job_package ) $fields = WP_Job_Manager_Field_Editor_Package_WC::filter_fields( $fields, $job_package );

			// If fields not init by preview, or save, return standard fields ( customizations returned in new_job_fields )
			if ( $this->validate_errors || ! empty( $job_package ) || ! $job_id || ( isset($_POST['submit_job']) && ! empty( $_POST['submit_job'] ) ) ) $fields = $this->new_job_fields( $fields );

			// If called by force validation, set fields equal to field config for validation
			if ( $this->force_validate ) $fields = $this->validation_fields( $fields );

			$fields = apply_filters( 'job_manager_field_editor_job_init_fields', $fields );

		}

		return $fields;

	}

	/**
	 * Format fields to work with test vaidation
	 *
	 * In order to return all fields even those disabled we must test validation to determine
	 * fields to return.  To prevent errors when running through core validation, we have to
	 * customize some of the fields.
	 *
	 *
	 * @since 1.2.2
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function validation_fields( $fields ){

		$fields[ 'job' ]     = array_map( array( $this, 'set_required_false' ), $fields[ 'job' ] );
		$fields[ 'company' ] = array_map( array( $this, 'set_required_false' ), $fields[ 'company' ] );

		if ( version_compare( JOB_MANAGER_VERSION, '1.14.0', 'le' ) ) {
			// Version 1.14.0 and earlier do not have filter for upload test, so we have to remove file fields
			// to prevent error when testing validation.
			$fields[ 'job' ]     = $this->fields_list_filter( $fields[ 'job' ], array( 'type' => 'file' ), 'NOT' );
			$fields[ 'company' ] = $this->fields_list_filter( $fields[ 'company' ], array( 'type' => 'file' ), 'NOT' );

		}

		return $fields;
	}

	/**
	 * Set wp_handle_upload Arguments
	 *
	 * When testing validation on form we need to set upload validation test
	 * form to TRUE in order to prevent actually uploading the file.
	 *
	 * @since 1.1.12
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	function upload_overrides( $args ) {

		// If filter wasn't forced don't set test form true
		//
		// Check for parent force validate for WPRM >= 1.9.1 which removes the resumes
		// filter for uploads and now uses core WPJM upload.
		if ( ! $this->force_validate && ! parent::$force_validate_resumes ) return $args;

		$this->force_validate = FALSE;
		parent::$force_validate_resumes = FALSE;
		$args[ 'test_form' ]  = TRUE;

		return $args;
	}

	/**
	 * Validate file uploads based on configurations
	 *
	 * This method checks file uploads for max uploads, etc, and returns a WP_Error
	 * if all conditions are not met.
	 *
	 *
	 * @since 1.5.0
	 *
	 * @param $no_errors
	 * @param $fields
	 * @param $values
	 *
	 * @return bool|\WP_Error
	 */
	function check_uploads( $no_errors, $fields, $values ){

		$job_uploads = false;
		$company_uploads = false;

		/**
		 * Filter out all fields except for file upload fields
		 */
		$job_fields = isset( $fields['job'] ) && ! empty( $fields['job'] ) ? $this->fields_list_filter( $fields['job'], array('type' => 'file'), 'AND' ) : array();
		$company_fields = isset( $fields['company'] ) && ! empty( $fields['company'] ) ? $this->fields_list_filter( $fields['company'], array('type' => 'file'), 'AND' ) : array();

		if( ! empty( $job_fields ) && isset( $values[ 'job' ] ) && ! empty( $values[ 'job' ] ) ) {
			$job_uploads = $this->check_max_upload( $job_fields, $values['job'] );
		}

		if( is_wp_error( $job_uploads ) ) {
			return $job_uploads;
		}

		if( ! empty( $company_fields ) && isset( $values[ 'company' ] ) && ! empty( $values[ 'company' ] ) ) {
			$company_uploads = $this->check_max_upload( $company_fields, $values[ 'company' ] );
		}

		if( is_wp_error( $company_uploads ) ){
			return $company_uploads;
		}

		return $no_errors;
	}

	/**
	 * Output Job and Company Fields for Template
	 *
	 * Called by WP Job Manager filter in submit() to return job and
	 * company fields with user customization for output in template.
	 *
	 * Any disabled fields are NOT included in the return $fields
	 *
	 * @since 1.1.9
	 *
	 * @param array $fields
	 *
	 * @return mixed
	 */
	function new_job_fields( $fields ) {

		// Fields were initialized to output form, removed disabled fields from array
		$fields[ 'job' ]     = wp_list_filter( $fields[ 'job' ], array( 'status' => 'disabled' ), 'NOT' );
		$fields[ 'company' ] = wp_list_filter( $fields[ 'company' ], array( 'status' => 'disabled' ), 'NOT' );

		return $fields;

	}

	/**
	 * Filter out Admin Only fields
	 *
	 * If configuration value is set for field to be admin only
	 * this function will remove those fields from the array.
	 *
	 *
	 * @since 1.2.5
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function admin_only_fields( $fields ){

		$fields[ 'job' ]     = wp_list_filter( $fields[ 'job' ], array('admin_only' => '1'), 'NOT' );
		$fields[ 'company' ] = wp_list_filter( $fields[ 'company' ], array('admin_only' => '1'), 'NOT' );

		return $fields;

	}

	/**
	 * Return Custom Required Label
	 *
	 *
	 * @since 1.1.14
	 *
	 * @param $label
	 * @param $field
	 *
	 * @return string
	 */
	function custom_required_label( $label, $field = false ){

		// Required Field
		if ( $label === '' ) {
			$custom_req_label = get_option( 'jmfe_required_label' );
			if( get_option( 'jmfe_enable_required_label' ) && $custom_req_label ){
				$custom_req_label= html_entity_decode( $custom_req_label);
				$label = ' ' . __( $custom_req_label, 'wp-job-manager-field-editor' );
			}

		}

		// Optional Field
		$defaultOptional = ' <small>' . __( '(optional)', 'wp-job-manager' ) . '</small>';

		$skip_field_types = apply_filters( 'field_editor_job_required_label_field_types', array('header', 'html', 'actionhook') );
		if( isset( $field, $field['type'] ) && in_array( $field['type'], $skip_field_types ) ) return '';

		if( $label === $defaultOptional ){
			$custom_opt_label = get_option( 'jmfe_optional_label' );
			if( get_option( 'jmfe_enable_optional_label' ) && $custom_opt_label ){
				$custom_opt_label= html_entity_decode( $custom_opt_label);
				$label = ' ' . __( $custom_opt_label, 'wp-job-manager-field-editor' );
			} elseif( get_option( 'jmfe_enable_required_label' ) ) {
				$label = '';
			}
		}

		return $label;
	}

	/**
	 *  Return Custom Submit Button
	 *
	 *
	 * @since 1.1.14
	 *
	 * @param $label
	 *
	 * @return mixed|void
	 */
	function custom_submit_button( $label ) {

		$custom_submit_button = get_option( 'jmfe_job_submit_button' );
		if ( get_option( 'jmfe_enable_job_submit_button' ) && $custom_submit_button ) {
			$label = __( $custom_submit_button, 'wp-job-manager-field-editor' );
		}

		return $label;
	}

}