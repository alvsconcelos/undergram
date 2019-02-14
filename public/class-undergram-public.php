<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://underbits.com.br
 * @since      1.0.0
 *
 * @package    Undergram
 * @subpackage Undergram/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Undergram
 * @subpackage Undergram/public
 * @author     Underbits <alvaro@underbits.com.br>
 */

use InstagramScraper\Instagram;

class Undergram_Public {

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
		 * defined in Undergram_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Undergram_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/undergram.css', array(), $this->version, 'all' );

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
		 * defined in Undergram_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Undergram_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/undergram-public.js', array( 'jquery' ), $this->version, false );

	}

	public function photos()
	{
		$user = 'youngthegiant';
		$instagram = new Instagram();
		$account = $instagram->getAccount($user);
		$avatar = $account->getProfilePicUrl();
		$medias = $instagram->getMedias($user, 3);
		$photos = "";

		foreach ($medias as $index => $media) {
			$url = $media->getLink();
			$img = $media->getsquareImages()[0];
			$photo = sprintf('
				<div class="col">
					<a href="%s">
						<div class="pt-100" style="background:url(%s);"></div>
					</a>
				</div>
			', $url, $img);
			if(($index + 1)%2 == 0) $photo .= '</div><div class="row no-gutters">';
			$photos .= $photo;
		}
		printf('
		<div class="instagram-gallery">
			<div class="row no-gutters">
				%1$s
				<div class="col d-flex justify-content-center align-items-center" style="background: #E6E2CC;">
					<a class="full-link" href="https://instagram.com/%3$s"></a>
					<div class="follow-box">
						<div class="content">
							<img src="%2$s" class="avatar" alt="%3$s">
							<p class="name">@%3$s</p>
							<p class="follow">Seguir</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		', $photos, $avatar, $user);
	}
	// 
	public function register_shortcode() {
		add_shortcode('display_todays_date', 'photos');
	}

}
