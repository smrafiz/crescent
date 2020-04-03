<?php
/**
 * Admin Page Plugin List Class.
 *
 * @package 	Crescent
 * @since 		1.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Admin Plugin List Class.
 * This Class renders the Admin Page Recommended Plugin List.
 *
 * @since v1.0
 */
class Crescent_Plugins {

    /**
     * Refers to a single instance of this class.
     *
     * @static
     * @access public
     * @var null|object
     * @since  1.0
     */
    public static $instance = null;

    /**
     * Access the single instance of this class.
     *
     * @static
     * @access public
     * @return Crescent_Plugins
     * @since  1.0
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Render Required Plugin Page.
     *
     * @access public
     * @since  1.0
     */
    public function render() {

        // Plugins.
        if ( ! function_exists( 'get_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        // Plugins API.
        if ( ! function_exists( 'plugins_api' ) ) {
            include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
        }

        $plugins                = TGM_Plugin_Activation::$instance->plugins;
        $registered_plugins     = $this->get_theme_plugins();
        $installed_plugins      = get_plugins();
        $plugins_api            = get_site_transient( 'crescent_wp_org_plugins' );

        if ( ! $plugins_api ) {
            $wp_org_plugins = array(
                'crescent-companion'    => 'crescent-companion/crescent-companion.php',
                'kirki'                 => 'kirki/kirki.php',
                'kirki'                 => 'meta-box/meta-box.php',
                'elementor'             => 'elementor/elementor.php',
                'contact-form-7'        => 'contact-form-7/wp-contact-form-7',
            );
            $plugins_api = array();
            foreach ( $wp_org_plugins as $slug => $path ) {
                $plugins_api[ $slug ] = array();
                $plugins_api[ $slug ] = (array) plugins_api( 'plugin_information', array(
                    'slug' => $slug,
                 ) );
            }
            set_site_transient( 'crescent_wp_org_plugins', $plugins_api, 15 * MINUTE_IN_SECONDS );
        }

        $render = '';
        ob_start();
        ?>
        <div class="theme-plugins">
            <div class="row">
            <?php
            foreach( $plugins as $plugin ) {
                if ( array_key_exists( $plugin['slug'], $registered_plugins ) ) {
                    continue;
                }

                $class = '';
                $plugin_status = '';
                $file_path = $plugin['file_path'];
                $plugin_action = $this->plugin_link( $plugin );

                if ( ! $plugin['version'] ) {
                    $plugin['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $plugin['slug'] );
                }

                if ( is_plugin_active( $file_path ) ) {
                    $plugin_status = 'active';
                    $class = 'active';
                }

                if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) {
                    $class .= ' update';
                }
                ?>
                <div class="col col-4">
                    <div class="plugins-wrapper <?php echo esc_attr( $class ); ?>">
                        <div class="plugin-thumbnail">
                            <img src="<?php echo esc_url_raw( $plugin['image_url'] ); ?>" alt="Plugin Thumbnail" />
                        </div>
                        <?php
                        if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) {
                            echo '<div class="update-message notice-warning">';
                                echo '<p>' . sprintf( esc_attr__( 'New Version Available: %s', 'crescent' ), esc_attr( $plugin['version'] ) ) . '</p>';
                            echo '</div>';
                        }
                        ?>
                        <h3 class="plugin-info">
                            <?php
                            if ( 'active' === $plugin_status ) {
                                echo '<span>' . sprintf( esc_attr__( 'Active: %s', 'crescent' ), esc_attr( $plugin['name'] ) ) . '</span>';
                            } else {
                                echo esc_attr( $plugin['name'] );
                            }
                            ?>

                            <div class="plugin-info">
                                <?php
                                if ( isset( $installed_plugins[ $plugin['file_path'] ] ) ) {
                                    printf(
                                        __( 'Version: %1$s | <a href="%2$s" target="_blank">%3$s</a>', 'crescent' ),
                                        esc_attr( $installed_plugins[ $plugin['file_path'] ]['Version'] ),
                                        esc_url_raw( $installed_plugins[ $plugin['file_path'] ]['AuthorURI'] ),
                                        esc_attr( $installed_plugins[ $plugin['file_path'] ]['Author'] )
                                    );
                                } else {
                                    $version = ( isset( $plugin['version'] ) ) ? $plugin['version'] : false;
                                    $version = ( isset( $plugins_api[ $plugin['slug'] ] ) && isset( $plugins_api[ $plugin['slug'] ]['version'] ) ) ? $plugins_api[ $plugin['slug'] ]['version'] : $version;

                                    $author  = ( isset( $plugin['Author'] ) && isset( $plugin['AuthorURI'] ) ) ? "<a href='{$plugin['AuthorURI']}' target='_blank'>{$plugin['Author']}</a>" : false;
                                    $author  = ( isset( $plugins_api[ $plugin['slug'] ] ) && isset( $plugins_api[ $plugin['slug'] ]['author'] ) ) ? $plugins_api[ $plugin['slug'] ]['author'] : $author;

                                    if ( $version && $author ) {
                                        printf( __( 'Version: %1$s | %2$s', 'crescent' ), $version, $author ); // WPCS: XSS ok.
                                    }
                                }
                                ?>
                            </div>
                        </h3>
                        <div class="user-actions">
                            <?php
                            foreach ( $plugin_action as $action ) {
                                echo $action; // WPCS: XSS ok.
                            }
                            ?>
                        </div>
                        <?php
                        if ( isset( $plugin['required'] ) && $plugin['required'] ) {
                        ?>
                            <div class="required-badge">
                                <?php echo esc_html__( 'Required', 'crescent' ); ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="recommended-badge">
                                <?php echo esc_html__( 'Recommended', 'crescent' ); ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>

        <?php
        $render .= ob_get_clean();

        return $render;
    }

    /**
     * List of required and recommended plugins.
     *
     * @access private
     * @since  1.0
     */
    private function get_theme_plugins() {
		$plugins = array(
			array(
				'name'                  => esc_html__( 'Crescent Companion', 'crescent' ),
				'slug'                  => 'crescent-companion',
				'source'                => esc_url( 'https://themeitems.com/wp/plugins/codexin-core.zip' ),
				'required'              => true,
                'version'               => '1.0',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
                'image_url'             => Crescent_Base::get_instance()->get_images_uri() . 'admin/thumbnails/fusion_core.png',
                'Author'                => 'Aurora WP Themes',
                'AuthorURI'             => 'https://aurorawpthemes.com',
            ),

			array(
				'name'                  => esc_html__( 'Kirki', 'crescent' ),
				'slug'                  => 'kirki',
                'required'              => false,
                'image_url'             => Crescent_Base::get_instance()->get_images_uri() . 'admin/thumbnails/contact_form_7.png',
            ),

			array(
				'name'                  => esc_html__( 'Meta Box', 'crescent' ),
				'slug'                  => 'meta-box',
                'required'              => false,
                'image_url'             => Crescent_Base::get_instance()->get_images_uri() . 'admin/thumbnails/contact_form_7.png',
            ),

			array(
				'name'                  => esc_html__( 'Elementor Page Builder', 'crescent' ),
				'slug'                  => 'elementor',
                'required'              => false,
                'image_url'             => Crescent_Base::get_instance()->get_images_uri() . 'admin/thumbnails/woocommerce.png',
            ),

			array(
				'name'                  => esc_html__( 'Contact Form 7', 'crescent' ),
				'slug'                  => 'contact-form-7',
                'required'              => false,
                'image_url'             => Crescent_Base::get_instance()->get_images_uri() . 'admin/thumbnails/contact_form_7.png',
            ),
        );

        return $plugins;
    }

    /**
     * TGMPA configuration.
     *
     * @access private
     * @since  1.0
     */
    private function plugins_config() {

        // Change this to your theme text domain.
        $theme_text_domain = 'crescent';

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'domain'        	=> $theme_text_domain,
            'id'                => 'crescent_tgmpa',
            'default_path'  	=> '',
            'parent_slug' 		=> 'themes.php',
            'menu'            	=> 'crescent-plugins',
            'capability'        => 'edit_theme_options',
            'has_notices'     	=> true,
            'is_automatic'    	=> true,
            'message'         	=> '',
            'strings'           => array(
                'page_title'                      => __( 'Install Required Plugins', 'crescent' ),
                'menu_title'                      => __( 'Install Plugins', 'crescent' ),
                /* translators: %s: plugin name. */
                'installing'                      => __( 'Installing Plugin: %s', 'crescent' ),
                /* translators: %s: plugin name. */
                'updating'                        => __( 'Updating Plugin: %s', 'crescent' ),
                'oops'                            => __( 'Something went wrong with the plugin API.', 'crescent' ),
                'notice_can_install_required'     => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'Crescent Theme requires the following plugin: %1$s.',
                    'Crescent Theme requires the following plugins: %1$s.',
                    'crescent'
                ),
                'notice_can_install_recommended'  => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'Crescent Theme recommends the following plugin: %1$s.',
                    'Crescent Theme recommends the following plugins: %1$s.',
                    'crescent'
                ),
                'notice_ask_to_update'            => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with Crescent Theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with Crescent Theme: %1$s.',
                    'crescent'
                ),
                'notice_ask_to_update_maybe'      => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'crescent'
                ),
                'notice_can_activate_required'    => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'crescent'
                ),
                'notice_can_activate_recommended' => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'crescent'
                ),
                'install_link'                    => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'crescent'
                ),
                'update_link' 					  => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'crescent'
                ),
                'activate_link'                   => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'crescent'
                ),
                'return'                          => __( 'Return to Plugins Installer', 'crescent' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'crescent' ),
                'activated_successfully'          => __( 'The following plugin was activated successfully:', 'crescent' ),
                /* translators: 1: plugin name. */
                'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'crescent' ),
                /* translators: 1: plugin name. */
                'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'crescent' ),
                /* translators: 1: dashboard link. */
                'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'crescent' ),
                'dismiss'                         => __( 'Dismiss this notice', 'crescent' ),
                'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'crescent' ),
                'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'crescent' ),

                'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
            ),
        );

        return $config;
    }

    /**
     * Register all plugins with TGMPA.
     *
     * @access private
     * @since  1.0
     */
    public function register_plugins() {

        // Plugin list.
        $plugins    = $this->get_theme_plugins();

        // Plugin Configuration.
        $config     = $this->plugins_config();

        tgmpa( $plugins, $config );
    }

	/**
	 * Get the Plugin link.
	 *
	 * @access public
	 * @param  array $item The plugin.
	 * @return array
     * @since  1.0
	 */
	public function plugin_link( $item ) {
		$installed_plugins = get_plugins();

		$item['sanitized_plugin'] = $item['name'];

		$actions = array();

		// Plugin update check.
		if ( ! $item['version'] ) {
			$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
		}

		// Install link.
		if ( ! isset( $installed_plugins[ $item['file_path'] ] ) ) {
            $url = esc_url(
                wp_nonce_url(
                    add_query_arg(
                        array(
                            'page'          => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
                            'plugin'        => rawurlencode( $item['slug'] ),
                            'plugin_name'   => rawurlencode( $item['sanitized_plugin'] ),
                            'tgmpa-install' => 'install-plugin',
                            'return_url'    => 'crescent_plugins',
                        ),
                        TGM_Plugin_Activation::$instance->get_tgmpa_url()
                    ),
                    'tgmpa-install',
                    'tgmpa-nonce'
                )
            );
            $actions = array(
                'install' => '<a href="' . $url . '" class="button button-primary" title="' . sprintf( esc_attr__( 'Install %s', 'crescent' ), $item['sanitized_plugin'] ) . '">' . esc_attr__( 'Install', 'crescent' ) . '</a>',
            );

		} elseif ( is_plugin_inactive( $item['file_path'] ) ) {
			// Activate link.
            $url = esc_url(
                wp_nonce_url(
                    add_query_arg(
                        array(
                            'page'              => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
                            'plugin'            => rawurlencode( $item['slug'] ),
                            'plugin_name'       => rawurlencode( $item['sanitized_plugin'] ),
                            'tgmpa-activate'    => 'activate-plugin',
                            'return_url'        => 'crescent_plugins',
                        ),
                        admin_url( 'themes.php?page=' . esc_attr( Crescent_Base::get_instance()->theme_slug ) )
                    ),
                    'tgmpa-activate',
                    'tgmpa-nonce'
                )
            );

			$actions = array(
				'activate' => '<a href="' . $url . '" class="button button-primary" title="' . sprintf( esc_attr__( 'Activate %s', 'crescent' ), $item['sanitized_plugin'] ) . '">' . esc_attr__( 'Activate' , 'crescent' ) . '</a>',
            );
		} elseif ( version_compare( $installed_plugins[ $item['file_path'] ]['Version'], $item['version'], '<' ) ) {
			// Update link.
			$url = wp_nonce_url(
				add_query_arg(
					array(
						'page'          => rawurlencode( TGM_Plugin_Activation::$instance->menu ),
						'plugin'        => rawurlencode( $item['slug'] ),
						'tgmpa-update'  => 'update-plugin',
						'version'       => rawurlencode( $item['version'] ),
						'return_url'    => 'crescent_plugins',
                    ),
					TGM_Plugin_Activation::$instance->get_tgmpa_url()
				),
				'tgmpa-update',
				'tgmpa-nonce'
			);

			$actions = array(
				'update' => '<a href="' . $url . '" class="button button-primary" title="' . sprintf( esc_attr__( 'Update %s', 'crescent' ), $item['sanitized_plugin'] ) . '">' . esc_attr__( 'Update', 'crescent' ) . '</a>',
            );
		} elseif ( is_plugin_active( $item['file_path'] ) ) {
			$actions = array(
				'deactivate' => '<button class="button disabled">Activated</button>',
            );
		} // End if().

		return $actions;
    }

	/**
	 * Custom button for TGMPA notice.
	 *
     * @access public
	 * @param  array $action_links The action link(s) for a required plugin.
	 * @return array The action link(s) for a required plugin.
     * @since  1.0
	 */
	public function edit_tgmpa_notice_action_links( $action_links ) {

        $link_template = '<a id="manage-plugins" class="button-primary" style="margin-top:15px;margin-bottom:0;" href="' . esc_url( TGM_Plugin_Activation::$instance->get_tgmpa_url() ) . '">' . esc_attr__( 'Manage Plugins', 'crescent' ) . '</a>';
        $action_links  = array(
            'install' => $link_template,
        );

		return $action_links;
	}
}
