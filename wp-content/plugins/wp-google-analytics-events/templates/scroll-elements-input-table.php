<?php
if( ! class_exists( 'WPGAE_Tracking_Table' ) ) {
	require_once( GAE_PLUGIN_PATH . 'include/TrackingTable.php' );
}


class ScrollTracking_Table extends WPGAE_Tracking_Table {
	/** Class constructor */
	public function __construct() {

		parent::__construct( array(
			'singular' => __( 'ScrollEvent', 'sp' ), //singular name of the listed records
			'plural'   => __( 'ScrollEvent', 'sp' ), //plural name of the listed records
			'ajax'     => true //does this table support ajax?
		));

		$this->wpgae_post_type = WPGAEGScrollEvent::get_wpgae_post_type();
		$this->wpgae_post_columns = WPGAEGScrollEvent::get_wpgae_post_columns();
		$this->wpgae_first_column = "_wpgae_scroll_selector_meta_key";

	}

	function column__wpgae_scroll_selector_meta_key($item) {
		$actions = array(
			'edit'      => sprintf('<a id="%s" data-action="wpgae-edit-scroll-event" href="">Edit</a>',$item->ID),
			'delete'    => sprintf('<a id="%s" data-action="wpgae-delete-scroll-event" href="">Delete</a>',$item->ID),
		);

		return sprintf('%1$s %2$s', $this->getColumnData($item, "_wpgae_scroll_selector_meta_key"), $this->row_actions($actions) );
	}
}


$scrollTracking = new ScrollTracking_Table();
$wpgae_options = get_option('ga_events_options');

?>
<div class="wrap">
	<div id="icon-users" class="icon32"></div>
	<h2>Scroll Tracking <a href="#wpgae-add-scroll-event" rel="modal:open" class="page-title-action">Add New</a></h2>
	<?php
	$scrollTracking->prepare_items();
	?>
	<form method="post">
		<input type="hidden" name="page" value="my_list_test" />
		<?php $scrollTracking->search_box('search', 'search_id'); ?>
	</form>
	<form method="post">
		<?php
		$scrollTracking->display();
		?>
	</form>
</div>
	<div class="wrap ga_events_banner ga_events_top">
		<div class="ga_events_featurebox ga_events_box_general">
			<div class="ga_events_box_title">
				<span>
					Become a Pro
				</span>
			</div>
			<div class="ga_events_box_body">
				<ul class="ga_events_box_list">
					<li>
						<div class="ga_events_box_li_icon">
							<img src="<?php echo plugins_url( 'images/icon_block.png', dirname(__FILE__)) ?>" />
						</div>
						<div class="ga_events_box_li_content">
							<span class="ga_events_box_li_title">Link Tracking</span>
							<span class="ga_events_box_li_txt">Automatically track any link on your website</span>
						</div>
					</li>
					<li>
						<div class="ga_events_box_li_icon">
							<img src="<?php echo plugins_url( 'images/icon_block.png', dirname(__FILE__)) ?>" />
						</div>
						<div class="ga_events_box_li_content">
							<span class="ga_events_box_li_title">Placeholder Variables</span>
							<span class="ga_events_box_li_txt">Include dynamic information in your events</span>
						</div>
					</li>
					<li>
						<div class="ga_events_box_li_icon">
							<img src="<?php echo plugins_url( 'images/icon_block.png', dirname(__FILE__)) ?>" />
						</div>
						<div class="ga_events_box_li_content">
							<span class="ga_events_box_li_title">User Permissions</span>
							<span class="ga_events_box_li_txt">Allow non Administrators to manage the plugin</span>
						</div>
					</li>
				</ul>
			</div>
			<div>
				<a class="btn" target="_blank" href="https://wpflow.com/upgrade/?utm_source=wpadmin&utm_medium=banner&utm_campaign=btng">Go Pro</a>
			</div>
		</div>
		<div class="ga_events_featurebox ga_events_box_video">
			<div class="ga_events_box_title">
				<span>
					Track Videos like a Pro
				</span>
			</div>
			<div class="ga_events_box_body">
				<ul class="ga_events_box_list">
					<li>
						<div class="ga_events_box_li_icon">
							<img src="<?php echo plugins_url( 'images/icon_lock.png', dirname(__FILE__)) ?>" />
						</div>
						<div class="ga_events_box_li_content">
							<span class="ga_events_box_li_title">YouTube Video Tracking</span>
							<span class="ga_events_box_li_txt">Track all video play/stop events and make
smarter segments on how people watch your content.</span>
						</div>
					</li>
					<li>
						<div class="ga_events_box_li_icon" style="margin-top:10px">
							<img src="<?php echo plugins_url( 'images/icon_lock.png', dirname(__FILE__)) ?>" />
						</div>
						<div class="ga_events_box_li_content" style="margin-top:10px">
							<span class="ga_events_box_li_title">Vimeo Video support</span>
							<span class="ga_events_box_li_txt">And yes, you can also track Vimeo videos</span>
						</div>
					</li>
				</ul>
			</div>
			<a class="btn" target="_blank" href="https://wpflow.com/upgrade/?utm_source=wpadmin&utm_medium=banner&utm_campaign=btnv">Go Premium</a>
		</div>
		<div class="ga_events_featurebox ga_events_box_support">
			<div class="ga_events_box_title">
				<span>
					Product Support
				</span>
			</div>
			<div class="ga_events_box_body">
				<ul class="ga_events_box_list">
					<li>
						<div class="ga_events_box_li_content">
							<span class="ga_events_box_li_title" style="margin-left:40px;">Premium Support</span>
							<span class="ga_events_box_li_txt" style="margin-left:40px;">Direct super-fast help from our dedicated support team</span>
						</div>
					</li>
				</ul>
			</div>
			<a class="btn" target="_blank" href="https://wpflow.com/upgrade/?utm_source=wpadmin&utm_medium=banner&utm_campaign=btns">Get Pro Support</a>
		</div>
	</div>
<?php
require_once( GAE_PLUGIN_PATH . '/templates/scroll-tracking-modals.php' );

