<?php
// If this file is called directly, abort. //
if (!defined('WPINC')) {
	die;
} // end if
function ogIframeEmbed($atts, $content = NULL)
{
	require_once(plugin_dir_path(__DIR__) . 'lib/opengrants-auth.php');
	if (is_user_logged_in()) {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$userInfo = get_user_meta($user_id);
		$userFirstName = $userInfo['first_name'][0];
		$userLastName = $userInfo['last_name'][0];
		$userEmail = $current_user->user_email;
		$key = get_option('wpt_api_key');
		if ($key) {
			$authResponse = authenticate($key, $userEmail);
			if (!$authResponse->token) {
				$registerResponse = register($key, $userEmail, $userFirstName, $userLastName);
				if (!$registerResponse->token) {
					echo 'Looks like you may already be a user, please login below.';
					// return;
				} else {
					$authResponse = authenticate($key, $userEmail);
				}
			}
			$userObj = array(
				'id' => $authResponse->id, 
				'token' => $authResponse->token
			);

			$primaryColor = get_option('wpt_primary_accent_color');
			$primaryColorWithoutHex = explode("#", $primaryColor);
			$secondaryColor = get_option('wpt_secondary_accent_color');
			$secondaryColorWithoutHex = explode("#", $secondaryColor);
			$logoUrl = wp_get_attachment_image_url(get_option('wpt_iframe_logo'), 'full');
			echo '
			<style>
			iframe {
				display: block;
				width: 100%;
				border: none;
				overflow-y: auto;
				overflow-x: hidden;
			}
			</style>';

			echo '<iframe src="https://sandbox.opengrants.io/embedded_auth?logo=' . $logoUrl . '&primary=' . $primaryColorWithoutHex[1] . '&secondary=' . $secondaryColorWithoutHex[1] . '&user=' . urlencode(json_encode($userObj)) . '" height="1000" width="1000" frameborder="0"></iframe>';
		} else {
			echo '<h1 class="text-center" style="font-weight:bold">Please enter valid API Key</h1>';
		}
	} else {
		$siteUrl = get_site_url();
		// server side redirects are not working, using client side redirect.
?>
<script>
window.location.href = "<?= $siteUrl; ?>";
</script>
<?php
	}
}

// Register All Shorcodes At Once
function register_shortcode()
{
	add_shortcode('opengrants_iframe', 'ogIframeEmbed');
};
add_action('init', 'register_shortcode');