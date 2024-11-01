<?php
/*
Plugin Name: WC Address Fields on User Registration (LITE)
Plugin URI: https://www.southdevondigital.com/documentation/wc-afour
Description: This lightweight plugin allows you to enable the Billing and/or Shipping fields to the Customer Registration Form. For this plugin to work <strong>you must have customer registration enabled</strong>. You can do this in <a href="/wp-admin/admin.php?page=wc-settings&tab=account">WooCommerce -> Settings -> Accounts</a>. For more advanced features and customisation, <a href="https://www.southdevondigital.com/shop/wc-afour-pro" target="_blank">upgrade to the PRO version</a>.
Author: South Devon Digital
Author URI: https://www.southdevondigital.com
Version: 1.0.2
Text Domain: wc-afour
*/

global $woocommerce;

// set up billing options
function wc_afour_create_billing_options_group() {
    add_settings_section("wc_afour_options_section", "", null, "wc-afour");
    add_settings_field("wc_afour_billing_header", "<h3>Billing Address Fields Settings</h3>", "", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_billing_prefix", "<label for='wc_afour_billing_prefix'>Billing field prefix <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_billing_prefix_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_show_billing_names", "<label for='wc_afour_show_billing_names'>Make billing name fields visible</label>", "wc_afour_show_billing_names_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_billing_names_required", "<label for='wc_afour_billing_names_required'>Make billing name fields required</label>", "wc_afour_billing_names_required_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_show_billing_company", "<label for='wc_afour_show_billing_company'>Make billing company field visible <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_show_billing_company_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_billing_company_required", "<label for='wc_afour_billing_company_required'>Make billing company field required <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_billing_company_required_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_show_billing_address", "<label for='wc_afour_show_billing_address'>Make billing address fields visible</label>", "wc_afour_show_billing_address_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_billing_address_required", "<label for='wc_afour_billing_address_required'>Make billing address fields required</label>", "wc_afour_billing_address_required_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_billing_county_text", "<label for='wc_afour_billing_county_text'>Billing County/State Text <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_billing_county_text_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_billing_postcode_text", "<label for='wc_afour_billing_postcode_text'>Billing Postcode/Zip Code Text <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_billing_postcode_text_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_show_billing_phone", "<label for='wc_afour_show_billing_phone'>Make billing phone number field visible <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_show_billing_phone_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_billing_phone_required", "<label for='wc_afour_billing_phone_required'>Make billing phone field required <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_billing_phone_required_display", "wc-afour", "wc_afour_options_section");
    register_setting("wc_afour_options_section", "wc_afour_show_billing_names");
    register_setting("wc_afour_options_section", "wc_afour_billing_names_required");
    register_setting("wc_afour_options_section", "wc_afour_show_billing_address");
    register_setting("wc_afour_options_section", "wc_afour_billing_address_required");
    add_settings_field("wc_afour_shipping_header", "<h3>Shipping Address Fields Settings</h3>", "", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_shipping_prefix", "<label for='wc_afour_shipping_prefix'>Shipping field prefix <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_shipping_prefix_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_show_shipping_names", "<label for='wc_afour_show_shipping_names'>Make shipping name fields visible</label>", "wc_afour_show_shipping_names_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_shipping_names_required", "<label for='wc_afour_shipping_names_required'>Make shipping name fields required</label>", "wc_afour_shipping_names_required_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_show_shipping_company", "<label for='wc_afour_show_shipping_company'>Make shipping company field visible <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_show_shipping_company_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_shipping_company_required", "<label for='wc_afour_shipping_company_required'>Make shipping company field required <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_shipping_company_required_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_show_shipping_address", "<label for='wc_afour_show_shipping_address'>Make shipping address fields visible</label>", "wc_afour_show_shipping_address_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_shipping_address_required", "<label for='wc_afour_shipping_address_required'>Make shipping address fields required</label>", "wc_afour_shipping_address_required_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_shipping_county_text", "<label for='wc_afour_shipping_county_text'>Shipping County/State Text <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_shipping_county_text_display", "wc-afour", "wc_afour_options_section");
    add_settings_field("wc_afour_shipping_postcode_text", "<label for='wc_afour_shipping_postcode_text'>Shipping Postcode/Zip Code Text <span class='wc-afour-pro-tag'>(PRO)</span></label>", "wc_afour_shipping_postcode_text_display", "wc-afour", "wc_afour_options_section");
    register_setting("wc_afour_options_section", "wc_afour_show_shipping_names");
    register_setting("wc_afour_options_section", "wc_afour_shipping_names_required");
    register_setting("wc_afour_options_section", "wc_afour_show_shipping_address");
    register_setting("wc_afour_options_section", "wc_afour_shipping_address_required");
}
add_action( 'admin_init', 'wc_afour_create_billing_options_group' );

// function to write billing address prefix input
function wc_afour_billing_prefix_display() { ?>
        <input type="text" name="wc_afour_billing_prefix" id="wc_afour_billing_prefix" value="<?php echo esc_html(get_option('wc_afour_billing_prefix', 'Billing')); ?>" />
<?php }

// function to write billing names visibility option
function wc_afour_show_billing_names_display() { ?>
        <input type="checkbox" name="wc_afour_show_billing_names" id="wc_afour_show_billing_names" value="1" <?php checked(1, esc_html(get_option('wc_afour_show_billing_names')), true); ?> />
<?php }

// function to write billing names required option
function wc_afour_billing_names_required_display() { ?>
        <input type="checkbox" name="wc_afour_billing_names_required" id="wc_afour_billing_names_required" value="1" <?php checked(1, esc_html(get_option('wc_afour_billing_names_required')), true); ?> />
<?php }

// function to write billing address visibility option
function wc_afour_show_billing_address_display() { ?>
        <input type="checkbox" name="wc_afour_show_billing_address" id="wc_afour_show_billing_address" value="1" <?php checked(1, esc_html(get_option('wc_afour_show_billing_address')), true); ?> />
<?php }

// function to write billing address required option
function wc_afour_billing_address_required_display() { ?>
        <input type="checkbox" name="wc_afour_billing_address_required" id="wc_afour_billing_address_required" value="1" <?php checked(1, esc_html(get_option('wc_afour_billing_address_required'), true)); ?> />
<?php }

// function to write billing address company visibility option
function wc_afour_show_billing_company_display() { ?>
        <input type="checkbox" name="wc_afour_show_billing_company" id="wc_afour_show_billing_company" value="1" />
<?php }

// function to write billing county/state text field
function wc_afour_billing_county_text_display() { ?>
        <input type="text" name="wc_afour_billing_county_text" id="wc_afour_billing_county_text" value="County" />
<?php }

// function to write billing postcode/zipcode text field
function wc_afour_billing_postcode_text_display() { ?>
        <input type="text" name="wc_afour_billing_postcode_text" id="wc_afour_billing_postcode_text" value="Postcode" />
<?php }

// function to write billing company required option
function wc_afour_billing_company_required_display() { ?>
        <input type="checkbox" name="wc_afour_billing_company_required" id="wc_afour_billing_company_required" value="1" />
<?php }

// function to write billing address phone visibility option
function wc_afour_show_billing_phone_display() { ?>
        <input type="checkbox" name="wc_afour_show_billing_phone" id="wc_afour_show_billing_phone" value="1" />
<?php }

// function to write billing phone required option
function wc_afour_billing_phone_required_display() { ?>
        <input type="checkbox" name="wc_afour_billing_phone_required" id="wc_afour_billing_phone_required" value="1" />
<?php }

// function to write shipping address prefix input
function wc_afour_shipping_prefix_display() { ?>
        <input type="text" name="wc_afour_shipping_prefix" id="wc_afour_shipping_prefix" value="Shipping" />
<?php }

// function to write shipping names visibility option
function wc_afour_show_shipping_names_display() { ?>
        <input type="checkbox" name="wc_afour_show_shipping_names" id="wc_afour_show_shipping_names" value="1" <?php checked(1, esc_html(get_option('wc_afour_show_shipping_names')), true); ?> />
<?php }

// function to write shipping names required option
function wc_afour_shipping_names_required_display() { ?>
        <input type="checkbox" name="wc_afour_shipping_names_required" id="wc_afour_shipping_names_required" value="1" <?php checked(1, esc_html(get_option('wc_afour_shipping_names_required')), true); ?> />
<?php }

// function to write shipping address visibility option
function wc_afour_show_shipping_address_display() { ?>
        <input type="checkbox" name="wc_afour_show_shipping_address" id="wc_afour_show_shipping_address" value="1" <?php checked(1, esc_html(get_option('wc_afour_show_shipping_address')), true); ?> />
<?php }

// function to write shipping address required option
function wc_afour_shipping_address_required_display() { ?>
        <input type="checkbox" name="wc_afour_shipping_address_required" id="wc_afour_shipping_address_required" value="1" <?php checked(1, esc_html(get_option('wc_afour_shipping_address_required')), true); ?> />
<?php }

// function to write shipping county/state text field
function wc_afour_shipping_county_text_display() { ?>
        <input type="text" name="wc_afour_shipping_county_text" id="wc_afour_shipping_county_text" value="County" />
<?php }

// function to write shipping postcode/zipcode text field
function wc_afour_shipping_postcode_text_display() { ?>
        <input type="text" name="wc_afour_shipping_postcode_text" id="wc_afour_shipping_postcode_text" value="Postcode" />
<?php }

// function to write shipping address company visibility option
function wc_afour_show_shipping_company_display() { ?>
        <input type="checkbox" name="wc_afour_show_shipping_company" id="wc_afour_show_shipping_company" value="1" />
<?php }

// function to write shipping company required option
function wc_afour_shipping_company_required_display() { ?>
        <input type="checkbox" name="wc_afour_shipping_company_required" id="wc_afour_shipping_company_required" value="1" />
<?php }

// function to write custom css input
function wc_afour_custom_css_display() { ?>
        <textarea name="wc_afour_custom_css" id="wc_afour_custom_css"><?php echo esc_html(get_option('wc_afour_custom_css','')); ?></textarea>
<?php }

// function to write the options page
function wc_afour_writeOptionsPage() { ?>
    <div class="wc-afour-upgrade-alert"><?php _e('This is a PRO feature, <a href="https://www.southdevondigital.com/shop/wc-afour-pro" target="_blank">upgrade now to unlock</a>!</div>', 'wc-afour'); ?>
    <div class="wrap">
        <h2><?php _e('WC Address Fields on User Registration (LITE)', 'wc-afour'); ?></h2>
        <form method="post" action="options.php">
            <?php settings_fields('wc_afour_options_section'); ?>
            <?php do_settings_sections('wc-afour'); ?>
            <?php submit_button(); ?>
            <div class="wc-afour-sidebar">
                <h2><?php _e('Finding this plugin useful?'); ?></h2>
                <p><?php _e('It\'d be really appreciated if you could <a href="https://wordpress.org/plugins/wc-afour/#reviews" target="_blank">leave a ★★★★★ review for WC AFOUR</a> on the WordPress plugin repository.'); ?></p>
                <p><?php _e('You might also want to consider upgrading to the PRO version, which unlocks access to all the extra features and a year of free updates & support directly from the developer.'); ?></p>
                <p><a href="https://www.southdevondigital.com/shop/wc-afour-pro" target="_blank"class="button button-primary" id="wc-afour-upgrade-button"><?php _e('Upgrade now'); ?></a></p>
                <h2><?php _e('Custom CSS'); ?></h2>
                <textarea id="wc_afour_custom_css_dummy" name="wc_afour_custom_css_dummy" rows="10" cols="60" placeholder="Upgrade to the pro version to enable custom CSS for the registration form front end." disabled><?php echo esc_html(get_option('wc_afour_custom_css','')); ?></textarea>
            </div>
            <div class="wc-afour-fb-box">
                <h2><?php _e('Keep up to date!'); ?></h2>
                <p>Follow <a href="https://southdevondigital.com" target="_blank">South Devon Digital</a> on Facebook for updates about our latest offers, plugins, products, services, articles & more.</p>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.0&appId=759596830864125&autoLogAppEvents=1';
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-page" data-href="https://www.facebook.com/SouthDevonDigital/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                    <blockquote cite="https://www.facebook.com/SouthDevonDigital/" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/SouthDevonDigital/">South Devon Digital</a>
                    </blockquote>
                </div>
            </div>
        </form>
    </div>
<?php }

// add the admin menu options page under WooCommerce
function wc_afour_optionsPage() {
    $adminPage = add_submenu_page('woocommerce', 'Address Fields on User Registration (LITE)', 'Address Fields on User Registration (LITE)', 'manage_options', 'wc-afour', 'wc_afour_writeOptionsPage');

    // load js/css on admin page
    add_action( 'load-' . $adminPage, 'wc_afour_load_admin_scripts' );
}
add_action('admin_menu', 'wc_afour_optionsPage');

// function to call js/css loader function when on admin page
function wc_afour_load_admin_scripts(){
    add_action( 'admin_enqueue_scripts', 'wc_afour_enqueue_admin_js_css' );
}

//function to load js/css
function wc_afour_enqueue_admin_js_css(){
    wp_enqueue_script( 'wc-afour-script', plugin_dir_url(__FILE__) . 'wc-afour-script.js', array( 'jquery' ) );
    wp_enqueue_style( 'wc-afour-styles', plugin_dir_url(__FILE__) . 'wc-afour-styles.css' );
}

// add the 'settings' link on the plugins page
function plugin_add_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=wc-afour">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );

// function to add billing/shipping address fields to the customer registration form (front-end)
function wc_afour_write_address_fields(){

    $wc_afour_address_fields_output;
    $wc_afour_show_billing_names = get_option('wc_afour_show_billing_names');
    $wc_afour_show_billing_address = get_option('wc_afour_show_billing_address');
    $wc_afour_billing_names_required = get_option('wc_afour_billing_names_required');
    $wc_afour_billing_address_required = get_option('wc_afour_billing_address_required');
    $wc_afour_show_shipping_names = get_option('wc_afour_show_shipping_names');
    $wc_afour_shipping_names_required = get_option('wc_afour_shipping_names_required');
    $wc_afour_show_shipping_address = get_option('wc_afour_show_shipping_address');
    $wc_afour_shipping_address_required = get_option('wc_afour_shipping_address_required');

    $countries_obj = new WC_Countries();
    $countries = $countries_obj->get_allowed_countries();

    if ($wc_afour_show_billing_names == 1){

        $wc_afour_address_fields_output .= '<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first"><label for="reg_billing_first_name">' . esc_html( get_option('wc_afour_billing_prefix', 'Billing') ) . ' First name';

        if ($wc_afour_billing_names_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '<input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="';

        if ( ! empty( $_POST['billing_first_name'] ) ) { $wc_afour_address_fields_output .=  esc_html( $_POST['billing_first_name'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last"><label for="reg_billing_last_name">' . esc_html( get_option('wc_afour_billing_prefix', 'Billing') ) . ' Last name';

        if ($wc_afour_billing_names_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="';

        if ( ! empty( $_POST['billing_last_name'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['billing_last_name'] ); }

        $wc_afour_address_fields_output .= '" /></p>';

    }

    if ($wc_afour_show_billing_address == 1){

        $wc_afour_address_fields_output .= '<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_billing_address_1">' . esc_html( get_option('wc_afour_billing_prefix', 'Billing') ) . ' Address Line 1';

        if ($wc_afour_billing_address_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="billing_address_1" id="reg_billing_address_1" value="';

        if ( ! empty( $_POST['billing_address_1'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['billing_address_1'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_billing_address_2">' . esc_html( get_option('wc_afour_billing_prefix', 'Billing') ) . ' Address Line 2</label><input type="text" class="input-text" name="billing_address_2" id="reg_billing_address_2" value="';

        if ( ! empty( $_POST['billing_address_2'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['billing_address_2'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_billing_city">' . esc_html( get_option('wc_afour_billing_prefix', 'Billing') ) . ' Town/City';

        if ($wc_afour_billing_address_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="billing_city" id="reg_billing_city" value="';

        if ( ! empty( $_POST['billing_city'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['billing_city'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_billing_state">' . esc_html( get_option('wc_afour_billing_prefix', 'Billing') ) . ' County</label><input type="text" class="input-text" name="billing_state" id="reg_billing_state" value="';

        $wc_afour_address_fields_output .= esc_html( $_POST['billing_state'] );

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_billing_postcode">' . esc_html( get_option('wc_afour_billing_prefix', 'Billing') ) . ' Postcode';

        if ($wc_afour_billing_address_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="billing_postcode" id="reg_billing_postcode" value="';

        if ( ! empty( $_POST['billing_postcode'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['billing_postcode'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="billing_country">' . esc_html( get_option('wc_afour_billing_prefix', 'Billing') ) . ' Country';

        if ($wc_afour_billing_address_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><select name="billing_country" id="billing_country"><option disabled selected value="">Select a country...</option>';

        foreach($countries as $country){
            $wc_afour_address_fields_output .= '<option value="' . esc_html( $country ) . '">' . esc_html( $country ) . '</option>' ;
        }

        $wc_afour_address_fields_output .= '</select></p>';

    }

    if ($wc_afour_show_shipping_names == 1){

        $wc_afour_address_fields_output .= '<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first"><label for="reg_shipping_first_name">' . esc_html( get_option('wc_afour_shipping_prefix', 'Shipping') ) . ' First name';

         if ($wc_afour_shipping_names_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

         $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="shipping_first_name" id="reg_shipping_first_name" value="';

         if ( ! empty( $_POST['shipping_first_name'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['shipping_first_name'] ); }

         $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last"><label for="reg_shipping_last_name">' . esc_html( get_option('wc_afour_shipping_prefix', 'Shipping') ) . ' Last name';

         if ($wc_afour_shipping_names_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

         $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="shipping_last_name" id="reg_shipping_last_name" value="';

         if ( ! empty( $_POST['shipping_last_name'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['shipping_postcode'] ); }

         $wc_afour_address_fields_output .= '" /></p>';

    }

    if ($wc_afour_show_shipping_address == 1){

         $wc_afour_address_fields_output .= '<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_shipping_address_1">' . esc_html( get_option('wc_afour_shipping_prefix', 'Shipping') ) . ' Line 1';

        if ($wc_afour_shipping_address_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="shipping_address_1" id="reg_shipping_address_1" value="';

        if ( ! empty( $_POST['shipping_address_1'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['shipping_address_1'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_shipping_address_2">' . esc_html( get_option('wc_afour_shipping_prefix', 'Shipping') ) . ' Line 2</label><input type="text" class="input-text" name="shipping_address_2" id="reg_shipping_address_2" value="';

        if ( ! empty( $_POST['shipping_address_2'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['shipping_address_2'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_shipping_city">' . esc_html( get_option('wc_afour_shipping_prefix', 'Shipping') ) . ' Town/City';

        if ($wc_afour_shipping_address_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="shipping_city" id="reg_shipping_city" value="';

        if ( ! empty( $_POST['shipping_city'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['shipping_city'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_shipping_state">' . esc_html( get_option('wc_afour_shipping_prefix', 'Shipping') ) . ' County</label><input type="text" class="input-text" name="shipping_state" id="reg_shipping_state" value="';

        $wc_afour_address_fields_output .= esc_html( $_POST['shipping_state'] );

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="reg_shipping_postcode">' . esc_html( get_option('wc_afour_shipping_prefix', 'Shipping') ) . ' Postcode';

        if ($wc_afour_shipping_address_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><input type="text" class="input-text" name="shipping_postcode" id="reg_shipping_postcode" value="';

        if ( ! empty( $_POST['shipping_postcode'] ) ) { $wc_afour_address_fields_output .= esc_html( $_POST['shipping_postcode'] ); }

        $wc_afour_address_fields_output .= '" /></p><p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"><label for="shipping_country">' . esc_html( get_option('wc_afour_shipping_prefix', 'Shipping') ) . ' Country';

        if ($wc_afour_shipping_address_required == 1){ $wc_afour_address_fields_output .= '<span class="required"> *</span>'; }

        $wc_afour_address_fields_output .= '</label><select name="shipping_country" id="shipping_country"><option disabled selected value="">Select a country...</option>';

        foreach($countries as $country){
            $wc_afour_address_fields_output .= '<option value="' . esc_html( $country ) . '">' . esc_html( $country ) . '</option>' ;
        }

        $wc_afour_address_fields_output .= '</select></p>';

    }
    echo $wc_afour_address_fields_output;
}
add_action( 'woocommerce_register_form_start', 'wc_afour_write_address_fields' );

// Validate address fields
function wc_afour_validate_address_fields( $username, $email, $validation_errors ) {
    $wc_afour_show_billing_names = get_option('wc_afour_show_billing_names');
    $wc_afour_billing_names_required = get_option('wc_afour_billing_names_required');
    $wc_afour_show_billing_address = get_option('wc_afour_show_billing_address');
    $wc_afour_billing_address_required = get_option('wc_afour_billing_address_required');
    $wc_afour_show_billing_names = get_option('wc_afour_show_billing_names');
    $wc_afour_shipping_names_required = get_option('wc_afour_shipping_names_required');
    $wc_afour_show_billing_address = get_option('wc_afour_show_billing_address');
    $wc_afour_shipping_address_required = get_option('wc_afour_shipping_address_required');

    // VALIDATE INPUT

    // Check that names don't contain numbers
    if (1 === preg_match('/\\d/',$_POST['billing_first_name']) || 1 === preg_match('/\\d/',$_POST['billing_last_name']) || 1 === preg_match('/\\d/',$_POST['shipping_first_name']) || 1 === preg_match('/\\d/',$_POST['shipping_last_name'])) {
        $validation_errors->add( 'name_field_number_error', __( 'You can\'t have numbers in your name!', 'woocommerce' ) );
    }

    // Validate post/zip code format
    $billing_country_code = $_POST['billing_country'];
    $billing_zip_postal = $_POST['billing_postcode'];
    $shipping_country_code = $_POST['shipping_country'];
    $shipping_zip_postal = $_POST['shipping_postcode'];
    $ZIPREG=array(
     "United States (US)"=>"^\d{5}([\-]?\d{4})?$",
     "United Kingdom (UK)"=>"^(GIR|[A-Z]\d[A-Z\d]??|[A-Z]{2}\d[A-Z\d]??)[ ]??(\d[A-Z]{2})$",
     "Germany"=>"\b((?:0[1-46-9]\d{3})|(?:[1-357-9]\d{4})|(?:[4][0-24-9]\d{3})|(?:[6][013-9]\d{3}))\b",
     "Canada"=>"^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$",
     "France"=>"^(F-)?((2[A|B])|[0-9]{2})[0-9]{3}$",
     "Italy"=>"^(V-|I-)?[0-9]{5}$",
     "Australia"=>"^(0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2})$",
     "Netherlands"=>"^[1-9][0-9]{3}\s?([a-zA-Z]{2})?$",
     "Spain"=>"^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$",
     "Denmark"=>"^([D-d][K-k])?( |-)?[1-9]{1}[0-9]{3}$",
     "Sweden"=>"^(s-|S-){0,1}[0-9]{3}\s?[0-9]{2}$",
     "Belgium"=>"^[1-9]{1}[0-9]{3}$"
    );

    if (isset($ZIPREG[$billing_country_code])) {
        if (!preg_match("/".$ZIPREG[$billing_country_code]."/i",$billing_zip_postal)){
            $validation_errors->add( 'billing_postcode_error', __( 'Please enter a valid billing post code!', 'woocommerce' ) );
        }
    }

    if (isset($ZIPREG[$shipping_country_code])) {
        if (!preg_match("/".$ZIPREG[$shipping_country_code]."/i",$shipping_zip_postal)){
            $validation_errors->add( 'shipping_postcode_error', __( 'Please enter a valid shipping post code!', 'woocommerce' ) );
        }
    }

    // Check required
    if ($wc_afour_billing_names_required == 1) {
      if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
          $validation_errors->add( 'billing_first_name_error', __( 'First name is required!', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
          $validation_errors->add( 'billing_last_name_error', __( 'Last name is required!.', 'woocommerce' ) );
      }
    }
    if ($wc_afour_billing_address_required == 1) {
      if ( isset( $_POST['billing_address_1'] ) && empty( $_POST['billing_address_1'] ) ) {
          $validation_errors->add( 'billing_address_1_error', __( 'Billing Address Line 1 is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_city'] ) && empty( $_POST['billing_city'] ) ) {
          $validation_errors->add( 'billing_city_error', __( 'Billing City is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['billing_postcode'] ) && empty( $_POST['billing_postcode'] ) ) {
          $validation_errors->add( 'billing_postcode_error', __( 'Billing Postcode is required!.', 'woocommerce' ) );
      }
      if ( $_POST['billing_country'] == '' ) {
          $validation_errors->add( 'billing_country_error', __( 'Billing Country is required!.', 'woocommerce' ) );
      }
    }
    if ($wc_afour_shipping_names_required == 1) {
      if ( isset( $_POST['shipping_first_name'] ) && empty( $_POST['shipping_first_name'] ) ) {
          $validation_errors->add( 'shipping_first_name_error', __( 'Shipping First name is required!', 'woocommerce' ) );
      }
      if ( isset( $_POST['shipping_last_name'] ) && empty( $_POST['shipping_last_name'] ) ) {
          $validation_errors->add( 'shipping_last_name_error', __( 'Shipping Last name is required!.', 'woocommerce' ) );
      }
    }
    if ($wc_afour_shipping_address_required == 1) {
      if ( isset( $_POST['shipping_address_1'] ) && empty( $_POST['shipping_address_1'] ) ) {
          $validation_errors->add( 'shipping_address_1_error', __( 'Shipping Line 1 is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['shipping_city'] ) && empty( $_POST['shipping_city'] ) ) {
          $validation_errors->add( 'shipping_city_error', __( 'Shipping City is required!.', 'woocommerce' ) );
      }
      if ( isset( $_POST['shipping_postcode'] ) && empty( $_POST['shipping_postcode'] ) ) {
          $validation_errors->add( 'shipping_postcode_error', __( 'Shipping Postcode is required!.', 'woocommerce' ) );
      }
      if ( $_POST['shipping_country'] == '' ) {
          $validation_errors->add( 'shipping_country_error', __( 'Shipping Country is required!.', 'woocommerce' ) );
      }
    }
    return $validation_errors;
}
add_action( 'woocommerce_register_post', 'wc_afour_validate_address_fields', 10, 3 );

// Save Address Fields
function wc_afour_save_address_fields( $customer_id ) {
   if ( isset( $_POST['billing_first_name'] ) ) {
       // WordPress
       update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
       // WooCommerce
       update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
   }
   if ( isset( $_POST['billing_last_name'] ) ) {
       // WordPress
       update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
       // WooCommerce
       update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
   }
   if ( isset( $_POST['billing_address_1'] ) ) {
       update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
   }
   if ( isset( $_POST['billing_address_2'] ) ) {
       update_user_meta( $customer_id, 'billing_address_2', sanitize_text_field( $_POST['billing_address_2'] ) );
   }
   if ( isset( $_POST['billing_city'] ) ) {
       update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
   }
   if ( isset( $_POST['billing_state'] ) ) {
       update_user_meta( $customer_id, 'billing_state', sanitize_text_field( $_POST['billing_state'] ) );
   }
   if ( isset( $_POST['billing_postcode'] ) ) {
       update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );
   }
   if ( isset( $_POST['billing_country'] ) ) {
       update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );
   }
   if ( isset( $_POST['shipping_first_name'] ) ) {
       update_user_meta( $customer_id, 'shipping_first_name', sanitize_text_field( $_POST['shipping_first_name'] ) );
   }
   if ( isset( $_POST['shipping_last_name'] ) ) {
       update_user_meta( $customer_id, 'shipping_last_name', sanitize_text_field( $_POST['shipping_last_name'] ) );
   }
   if ( isset( $_POST['shipping_address_1'] ) ) {
       update_user_meta( $customer_id, 'shipping_address_1', sanitize_text_field( $_POST['shipping_address_1'] ) );
   }
   if ( isset( $_POST['shipping_address_2'] ) ) {
       update_user_meta( $customer_id, 'shipping_address_2', sanitize_text_field( $_POST['shipping_address_2'] ) );
   }
   if ( isset( $_POST['shipping_city'] ) ) {
       update_user_meta( $customer_id, 'shipping_city', sanitize_text_field( $_POST['shipping_city'] ) );
   }
   if ( isset( $_POST['shipping_state'] ) ) {
       update_user_meta( $customer_id, 'shipping_state', sanitize_text_field( $_POST['shipping_state'] ) );
   }
   if ( isset( $_POST['shipping_postcode'] ) ) {
       update_user_meta( $customer_id, 'shipping_postcode', sanitize_text_field( $_POST['shipping_postcode'] ) );
   }
   if ( isset( $_POST['shipping_country'] ) ) {
       update_user_meta( $customer_id, 'shipping_country', sanitize_text_field( $_POST['shipping_country'] ) );
   }
}
add_action( 'woocommerce_created_customer', 'wc_afour_save_address_fields' );

// function to notify the user if wc_afour is activated but WooCommerce isn't
function wc_afour_noWcWarning() {
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php _e( 'The <cite>WC Address fields on User Registration</cite> plugin requires WooCommerce to be activated in order to work.', 'wc_afour' ); ?></p>
        </div>
    <?php }
}
add_action( 'admin_notices', 'wc_afour_noWcWarning' );

// function to rewrite the pro options data on plugin activation (for when a user is downgrading)
function wc_afour_rewriteProOptions() {
    update_option('wc_afour_billing_prefix','Billing');
    update_option('wc_afour_show_billing_company','');
    update_option('wc_afour_billing_company_required','');
    update_option('wc_afour_show_billing_phone','');
    update_option('wc_afour_billing_phone_required','');
    update_option('wc_afour_billing_county_text','County');
    update_option('wc_afour_billing_postcode_text','Postcode');
    update_option('wc_afour_shipping_prefix','Shipping');
    update_option('wc_afour_show_shipping_company','');
    update_option('wc_afour_shipping_company_required','');
    update_option('wc_afour_shipping_county_text','County');
    update_option('wc_afour_shipping_postcode_text','Postcode');
}
register_activation_hook( __FILE__, 'wc_afour_rewriteProOptions' );
