<?php
/*
 * Plugin Name:       WP SmartAuth
 * Plugin URI:        https://github.com/MD-ANIKS/wp-smartauth
 * Description:       WP SmartAuth allows you to easily customize your WordPress login page with a modern tabbed Sign In & Sign Up layout, smart design elements, and full customization options.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            anikwpstudio
 * Author URI:        https://github.com/MD-ANIKS
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpsa
 */


// plugin option page function 
function wpsa_add_theme_page()
{
  // $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $callback:callable, $icon_url:string, $position:integer|float|null 
  add_menu_page('WP SmartAuth Login Option', 'WP SmartAuth', 'manage_options', 'wpsa-login-option', 'wpsa_create_page', 'dashicons-id', 101);
};
add_action('admin_menu', 'wpsa_add_theme_page');

// plugin option page style 
function wpsa_admin_theme_css()
{
  wp_enqueue_style('wpsa_admin_style', plugins_url('/assets/css/wpsa-admin-style.css', __FILE__), false, '1.0.0');
};
add_action('admin_enqueue_scripts', 'wpsa_admin_theme_css');

// login Option Menu Callback Function 
function wpsa_create_page()
{
?>
  <section id="wpsa_login_area">
    <div class="wpsa_container">
      <div class="wpsa_login_area_wrapper">
        <div class="wpsa_login_content">
          <h3 class="wpsa_login_title"><?php print esc_attr('Login Page Customizer') ?></h3>
          <form action="options.php" method="post">
            <?php wp_nonce_field('update-options'); ?>

            <div class="wpsa_colors_palate">
              <div>
                <label for="wpsa_primary_color" class="wpsa_primary_color"><?php echo esc_attr('Primary Color'); ?></label>
                <input type="color" name="wpsa_primary_color" id="wpsa_primary_color" value="<?php echo get_option('wpsa_primary_color'); ?>">
              </div>

              <div>
                <label for="wpsa_login_panel_bg" class="wpsa_login_panel_bg"><?php echo esc_attr('Panel Background'); ?></label>
                <input type="color" name="wpsa_login_panel_bg" id="wpsa_login_panel_bg" value="<?php echo get_option('wpsa_login_panel_bg'); ?>">
              </div>

              <div>
                <label for="wpsa_text_color" class="wpsa_text_color"><?php echo esc_attr('Text Color'); ?></label>
                <input type="color" name="wpsa_text_color" id="wpsa_text_color" value="<?php echo get_option('wpsa_text_color'); ?>">
              </div>

              <div>
                <label for="wpsa_hover_color" class="wpsa_primary_hover_color"><?php echo esc_attr('Hover Color'); ?></label>
                <input type="color" name="wpsa_hover_color" id="wpsa_hover_color" value="<?php echo get_option('wpsa_hover_color'); ?>">
              </div>
            </div>


            <div>
              <label for="wpsa_logo" class="wpsa_logo"><?php echo esc_attr('Upload Your Logo'); ?></label>
              <small>Paste Your Logo URL Here, 80x80 Recommended</small>
              <input type="text" name="wpsa_logo" id="wpsa_logo" placeholder="Paste Your Logo URL Here" value="<?php echo get_option('wpsa_logo'); ?>">
            </div>

            <div>
              <label for="wpsa_bg" class="wpsa_bg"><?php echo esc_attr('Upload Your Background Image'); ?></label>
              <small>Paste Your Background Image URL Here</small>
              <input type="text" name="wpsa_bg" id="wpsa_bg" placeholder="Paste Your Background Image URL Here" value="<?php echo get_option('wpsa_bg'); ?>">
            </div>

            <div>
              <label for="wpsa_bg_brightness" class="wpsa_bg_brightness"><?php echo esc_attr('Background Brightness (Between 0.1 to 0.9) '); ?></label>
              <small>Set Your Background Brightness Here. Number Only (Between 0.1 to 0.9)</small>
              <input type="text" name="wpsa_bg_brightness" id="wpsa_bg_brightness" placeholder="0.1 to 0.9" value="<?php echo get_option('wpsa_bg_brightness'); ?>">
            </div>


            <input type="hidden" name="action" value="update">
            <input type="hidden" name="page_options" value="wpsa_primary_color,wpsa_login_panel_bg,wpsa_text_color,wpsa_hover_color,wpsa_logo,wpsa_bg,wpsa_bg_brightness">
            <input type="submit" class="button button-primary" name="submit" value="<?php _e('Save Changes', 'wpsa'); ?>">
          </form>
        </div>
        <div class="wpsa_sidebar">
          <div class="wpsa_author-box">
            <h3 class="wpsa_login_title"><?php print esc_attr('About Author') ?></h3>
            <div class="wpsa_profile">
              <img src="<?php echo plugin_dir_url(__FILE__) . '/assets/images/author.png'; ?>" alt="author">
            </div>
            <a class="wpsa_donate_link" href="https://www.buymeacoffee.com/wpinnovator/" target="_blank" rel="noopener noreferrer">
              <img width="140px" src="<?php echo plugin_dir_url( __FILE__ ) . '/assets/images/blue-button.png' ?>" alt="Donate">
            </a>
            <p class="wpsa_desc"><strong>anikwpstudio</strong> is a passionate WordPress developer specializing in custom themes, plugins, and Elementor-based designs. With expertise in PHP, WooCommerce, and WordPress optimization, they help businesses build high-performance websites.</p>
            <p>Explore more projects on <a href="https://github.com/MD-ANIKS" target="_blank">GitHub</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php
};

// loading css file 
function wpsa_login_enqueue_register()
{
  wp_enqueue_style('wpsa_login_enqueue', plugins_url('/assets/css/wpsa-style.css', __FILE__), false, '1.1.1');
};
add_action('login_enqueue_scripts', 'wpsa_login_enqueue_register');



// changing login form logo 
function wpsa_login_panel()
{
?>
  <style>
    body.login {
      background-image: url(<?php echo get_option('wpsa_bg'); ?>) !important;
    }

    body.login::after {
      opacity: <?php echo get_option('wpsa_bg_brightness') ?> !important;
    }

    body.login #login {
      background: <?php echo get_option('wpsa_login_panel_bg'); ?> !important;
    }

    body.login #login h1 a {
      background-image: url(<?php echo get_option('wpsa_logo'); ?>) !important;
    }

    body.login #login #loginform label,
    body.login #login #loginform input {
      border-color: <?php echo get_option('wpsa_primary_color'); ?> !important;
      color: <?php echo get_option('wpsa_text_color'); ?> !important;
    }

    input[type='submit'] {
      background: <?php echo get_option('wpsa_primary_color'); ?> !important;
    }

    body.login #login #loginform input[type='submit']:hover {
      border-color: <?php echo get_option('wpsa_hover_color'); ?> !important;
      background: <?php echo get_option('wpsa_hover_color') ?> !important;
    }

    .login #backtoblog a,
    .login #nav a {
      color: <?php echo get_option('wpsa_text_color'); ?> !important;
    }
  </style>
<?php
};

add_action('login_enqueue_scripts', 'wpsa_login_panel');


// plugin redirect feature 
// Trigger function when the plugin is activated.
register_activation_hook(__FILE__, 'wpsa_plugin_activation');
function wpsa_plugin_activation() {
  // Add an option to track activation for redirecting after activation.
  add_option('wpsa_plugin_do_activation_redirect', true);
}

// Hook into admin initialization to check for redirection.
add_action('admin_init', 'wpsa_plugin_redirect');

function wpsa_plugin_redirect() {
  // Check if the activation redirect flag exists.
  if (get_option('wpsa_plugin_do_activation_redirect', false)) {
    
    // Remove the flag to ensure the redirect happens only once.
    delete_option('wpsa_plugin_do_activation_redirect');

    // Prevent redirection if multiple plugins were activated at once.
    if (!isset($_GET['active_multi'])) {
      // Redirect to the plugin settings page.
      wp_safe_redirect(admin_url('admin.php?page=wpsa-plugin-option'));
      exit; // Stop further execution after redirect.
    }
  }
}




// login logo url change
function wpsa_login_logo_url_change()
{
  return home_url();
};

add_filter('login_headerurl', 'wpsa_login_logo_url_change');


?>