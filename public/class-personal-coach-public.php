<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       victorcrespo.net
 * @since      1.0.0
 *
 * @package    Personal_Coach
 * @subpackage Personal_Coach/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Personal_Coach
 * @subpackage Personal_Coach/public
 * @author     Victor Crespo <hola@victorcrespo.net>
 */
class Personal_Coach_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

	}

	private function load_dependencies(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/models/class_pc_customer.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/models/class_pc_admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/models/class_pc_customer_registration.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/controllers/class_pc_customer_view_loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/controllers/class_pc_admin_view_loader.php';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Personal_Coach_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Personal_Coach_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style(
			$this->plugin_name . '_bootstrap',
			plugin_dir_url( __FILE__ ) . 'css/bootstrap.css',
			array(),
			$this->version,
			'all'
		);

		wp_register_style(
			$this->plugin_name . '_customer_view',
			plugin_dir_url( __FILE__ ) . 'css/customer_view.css',
			array(),
			$this->version,
			'all'
		);

		wp_register_style(
			$this->plugin_name . '_admin_view',
			plugin_dir_url( __FILE__ ) . 'css/admin_view.css',
			array(),
			$this->version,
			'all'
		);

		wp_register_style(
			$this->plugin_name . '_tab_theme',
			"//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
		);

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Personal_Coach_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Personal_Coach_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//Accordion
		wp_register_script(
			$this->plugin_name . '_accordion',
			plugin_dir_url( __FILE__ ) . 'js/accordion.js',
			array('jquery','jquery-ui-accordion'),
			$this->version,
			true
		);

		//Tabs
		wp_register_script(
			$this->plugin_name . '_tabs',
			plugin_dir_url( __FILE__ ) . 'js/tabs.js',
			array('jquery','jquery-ui-tabs'),
			$this->version,
			true
		);

		//DatePicker
		wp_register_script(
			$this->plugin_name . '_date_picker',
			plugin_dir_url( __FILE__ ) . 'js/date_picker.js',
			array('jquery','jquery-ui-datepicker'),
			$this->version,
			true
		);

		//Form validator (jqueryvalidation)
		wp_register_script(
			$this->plugin_name . '_form_validator',
			'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js',
			array('jquery'),
			$this->version,
			true
		);

		//User registration form validator
		wp_register_script(
			$this->plugin_name . '_pc_form_validator',
			plugin_dir_url( __FILE__ ) . 'js/pc_form_validator.js',
			array('jquery', $this->plugin_name . '_form_validator'),
			$this->version,
			true
		);

		//Calory calculator
		wp_register_script(
			$this->plugin_name . '_calory_calculator',
			plugin_dir_url( __FILE__ ) . 'js/calory_calculator.js',
			array('jquery'),
			$this->version,
			true
		);

		//Google charts
		wp_register_script(
			$this->plugin_name . '_google_charts',
			'https://www.gstatic.com/charts/loader.js',
			array(),
			'',
			true
		);

		wp_register_script(
			$this->plugin_name . '_pc_charts',
			plugin_dir_url( __FILE__ ) . 'js/custom_charts.js',
			array('jquery', $this->plugin_name . '_google_charts'),
			$this->version,
			true
		);

		//Ajax user registration script
		wp_register_script(
			$this->plugin_name . '_user_registration',
			plugin_dir_url( __FILE__ ) . 'js/user_registration.js',
			array('jquery'),
			$this->version,
			true
		);

		wp_localize_script(
			$this->plugin_name . '_user_registration',
			'ajax_user_registration_object',
			[
				'ajax_url' => admin_url( 'admin-ajax.php' )
			]
		);

		//Ajax get user information script
		wp_register_script(
			$this->plugin_name . '_admin_view_user_info',
			plugin_dir_url( __FILE__ ) . 'js/admin_view_user_info.js',
			array('jquery'),
			$this->version,
			true
		);

		wp_localize_script(
			$this->plugin_name . '_admin_view_user_info',
			'ajax_user_object',
			[
				'ajax_url' => admin_url( 'admin-ajax.php' )
			]
		);

		//Ajax get user follow up script
		wp_register_script(
			$this->plugin_name . '_admin_view_user_follow_up',
			plugin_dir_url( __FILE__ ) . 'js/admin_view_user_follow_up.js',
			array('jquery'),
			$this->version,
			true
		);

		wp_localize_script(
			$this->plugin_name . '_admin_view_user_follow_up',
			'ajax_user_object',
			[
				'ajax_url' => admin_url( 'admin-ajax.php' )
			]
		);

		//Ajax weekly follow up registration script
		wp_register_script(
			$this->plugin_name . '_weekly_follow_up_registration',
			plugin_dir_url( __FILE__ ) . 'js/weekly_follow_up_registration.js',
			array('jquery'),
			$this->version,
			true
		);

		wp_localize_script(
			$this->plugin_name . '_weekly_follow_up_registration',
			'ajax_user_object',
			[
				'ajax_url' => admin_url( 'admin-ajax.php' )
			]
		);

	}

	/**
	 * Register shortcodes for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		//Shortcodes
		$customer_view_file		= plugin_dir_url( __FILE__ ) . 'views/pc_customer_view.php';
		$admin_view_file 			= plugin_dir_url( __FILE__ ) . 'views/pc_admin_view.php';

		$pc_customer_view 		= new Personal_Coach_Customer_View(
																															$customer_view_file,
																															$this->plugin_name
																														);
		$pc_admin_view		 		= new Personal_Coach_Admin_View(
																													$admin_view_file,
																													$this->plugin_name
																											   );

		add_shortcode(
			 'personal_coach_customer_view',
			 array($pc_customer_view,
			 		'pc_create_customer_view'
			 )
		);

		add_shortcode(
			 'personal_coach_admin_view',
			 array($pc_admin_view,
					'pc_create_admin_view'
			 )
		);
	}

}
