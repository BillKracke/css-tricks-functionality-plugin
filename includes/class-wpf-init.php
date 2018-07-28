<?php
/**
 * Main Init Class
 *
 * @package     WPF
 * @subpackage  WPF/includes
 * @copyright   Copyright (c) 2014, Jason Witt
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 */

class WPF_Init {

	/**
	 * Initialize the class
	 */
	public function __construct() {

		$register_post_types     = new CFT_Register_Post_Types();
		$register_taxonomies     = new WPF_Register_Taxonomies();
		$remove_admin_bar 	     = new WPF_Remove_Admin_Bar();
		$clean_up_head		     = new WPF_Clean_Up_Head();
		$close_coments		     = new WPF_Close_Comments();
		$custom_feed_link	     = new WPF_Custom_Feed_Link();
		$insert_figure		     = new WPF_Insert_Figure();
		$auto_renew			     = new WPF_RCP_Auto_Renew();
		$long_url_spam		     = new WPF_Long_URL_Spam();
		$remove_jetpack_bar      = new WPF_Remove_Jetpack_Bar();
		$add_mime_types		     = new WPF_Add_Mime_Types();
		$remove_markdown_support = new WPF_Remove_Markdown_Support();
		$add_email_feed			 = new WPF_Add_Email_Feed();
		$increase_form_limit	 = new WPF_Increase_Postmeta_Form_Limit();
		$limit_users_delete		 = new WPF_Limit_Users_Delete();
		$remove_post_author_url  = new WPF_Remove_Post_Author_Url();
		$allowed_tags			 = new WPF_Allowed_Tags();
		
	}

}