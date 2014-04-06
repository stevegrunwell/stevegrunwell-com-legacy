<?php
/*
Plugin Name: PayPal Donations
Plugin URI: http://johansteen.se/code/paypal-donations/
Description: Easy and simple setup and insertion of PayPal donate buttons with a shortcode or through a sidebar Widget. Donation purpose can be set for each button. A few other customization options are available as well.
Author: Johan Steen
Author URI: http://johansteen.se/
Version: 1.8.2
License: GPLv2 or later
Text Domain: paypal-donations

Copyright 2009-2014  Johan Steen  (email : artstorm [at] gmail [dot] com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/** Load all of the necessary class files for the plugin */
spl_autoload_register('PayPalDonations::autoload');

/**
 * Init Singleton Class for PayPal Donations.
 *
 * @package PayPal Donations
 * @author  Johan Steen <artstorm at gmail dot com>
 */
class PayPalDonations
{
    /** Holds the plugin instance */
    private static $instance = false;

    /** Define plugin constants */
    const MIN_PHP_VERSION  = '5.2.4';
    const MIN_WP_VERSION   = '3.0';
    const OPTION_DB_KEY    = 'paypal_donations_options';
    const TEXT_DOMAIN      = 'paypal-donations';
    const FILE             = __FILE__;


    // -------------------------------------------------------------------------
    // Define constant data arrays
    // -------------------------------------------------------------------------
    private $donate_buttons = array(
        'small' => 'https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif',
        'large' => 'https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif',
        'cards' => 'https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif'
    );
    private $currency_codes = array(
        'AUD' => 'Australian Dollars (A $)',
        'CAD' => 'Canadian Dollars (C $)',
        'EUR' => 'Euros (&euro;)',
        'GBP' => 'Pounds Sterling (&pound;)',
        'JPY' => 'Yen (&yen;)',
        'USD' => 'U.S. Dollars ($)',
        'NZD' => 'New Zealand Dollar ($)',
        'CHF' => 'Swiss Franc',
        'HKD' => 'Hong Kong Dollar ($)',
        'SGD' => 'Singapore Dollar ($)',
        'SEK' => 'Swedish Krona',
        'DKK' => 'Danish Krone',
        'PLN' => 'Polish Zloty',
        'NOK' => 'Norwegian Krone',
        'HUF' => 'Hungarian Forint',
        'CZK' => 'Czech Koruna',
        'ILS' => 'Israeli Shekel',
        'MXN' => 'Mexican Peso',
        'BRL' => 'Brazilian Real',
        'TWD' => 'Taiwan New Dollar',
        'PHP' => 'Philippine Peso',
        'TRY' => 'Turkish Lira',
        'THB' => 'Thai Baht'
    );
    private $localized_buttons = array(
        'en_AU' => 'Australia - Australian English',
        'de_DE/AT' => 'Austria - German',
        'nl_NL/BE' => 'Belgium - Dutch',
        'fr_XC' => 'Canada - French',
        'zh_XC' => 'China - Simplified Chinese',
        'fr_FR/FR' => 'France - French',
        'de_DE/DE' => 'Germany - German',
        'it_IT/IT' => 'Italy - Italian',
        'ja_JP/JP' => 'Japan - Japanese',
        'es_XC' => 'Mexico - Spanish',
        'nl_NL/NL' => 'Netherlands - Dutch',
        'pl_PL/PL' => 'Poland - Polish',
        'es_ES/ES' => 'Spain - Spanish',
        'de_DE/CH' => 'Switzerland - German',
        'fr_FR/CH' => 'Switzerland - French',
        'en_US' => 'United States - U.S. English'
    );
    private $checkout_languages = array(
        'AU' => 'Australia',
        'AT' => 'Austria',
        'BR' => 'Brazil',
        'CA' => 'Canada',
        'CN' => 'China',
        'FR' => 'France',
        'DE' => 'Germany',
        'IT' => 'Italy',
        'NL' => 'Netherlands',
        'ES' => 'Spain',
        'SE' => 'Sweden',
        'GB' => 'United Kingdom',
        'US' => 'United States',
    );

    /**
     * Singleton class
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor.
     * Initializes the plugin by setting localization, filters, and
     * administration functions.
     */
    private function __construct()
    {
        if (!$this->testHost()) {
            return;
        }

        add_action('init', array($this, 'textDomain'));
        register_uninstall_hook(__FILE__, array(__CLASS__, 'uninstall'));

        $admin = new PayPalDonations_Admin();
        $admin->setOptions(
            get_option(self::OPTION_DB_KEY),
            $this->currency_codes,
            $this->donate_buttons,
            $this->localized_buttons,
            $this->checkout_languages
        );

        add_shortcode('paypal-donation', array(&$this,'paypalShortcode'));
        add_action('wp_head', array($this, 'addCss'), 999);

        add_action(
            'widgets_init',
            create_function('', 'register_widget("PayPalDonations_Widget");')
        );
    }

    /**
     * PSR-0 compliant autoloader to load classes as needed.
     *
     * @param  string  $classname  The name of the class
     * @return null    Return early if the class name does not start with the
     *                 correct prefix
     */
    public static function autoload($className)
    {
        if (__CLASS__ !== mb_substr($className, 0, strlen(__CLASS__))) {
            return;
        }
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
            $fileName .= DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, 'src_'.$className);
        $fileName .='.php';

        require $fileName;
    }

    /**
     * Loads the plugin text domain for translation
     */
    public function textDomain()
    {
        $domain = self::TEXT_DOMAIN;
        $locale = apply_filters('plugin_locale', get_locale(), $domain);
        load_textdomain(
            $domain,
            WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo'
        );
        load_plugin_textdomain(
            $domain,
            false,
            dirname(plugin_basename(__FILE__)).'/lang/'
        );
    }

    /**
     * Fired when the plugin is uninstalled.
     */
    public function uninstall()
    {
        delete_option('paypal_donations_options');
        delete_option('widget_paypal_donations');
    }

    /**
     * Adds inline CSS code to the head section of the html pages to center the
     * PayPal button.
     */
    public function addCss()
    {
        $opts = get_option(self::OPTION_DB_KEY);
        if (isset($opts['center_button']) and $opts['center_button'] == true) {
            echo '<style type="text/css">'."\n";
            echo '.paypal-donations { text-align: center !important }'."\n";
            echo '</style>'."\n";
        }
    }

    /**
     * Create and register the PayPal shortcode
     */
    public function paypalShortcode($atts)
    {
        extract(
            shortcode_atts(
                array(
                    'purpose' => '',
                    'reference' => '',
                    'amount' => '',
                    'return_page' => '',
                    'button_url' => '',
                ),
                $atts
            )
        );

        return $this->generateHtml(
            $purpose,
            $reference,
            $amount,
            $return_page,
            $button_url
        );
    }

    /**
     * Generate the PayPal button HTML code
     */
    public function generateHtml(
        $purpose = null,
        $reference = null,
        $amount = null,
        $return_page = null,
        $button_url = null
    ) {
        $pd_options = get_option(self::OPTION_DB_KEY);

        // Set overrides for purpose and reference if defined
        $purpose = (!$purpose) ? $pd_options['purpose'] : $purpose;
        $reference = (!$reference) ? $pd_options['reference'] : $reference;
        $amount = (!$amount) ? $pd_options['amount'] : $amount;
        $return_page = (!$return_page) ? $pd_options['return_page'] : $return_page;
        $button_url = (!$button_url) ? $pd_options['button_url'] : $button_url;

        $data = array(
            'pd_options' => $pd_options,
            'return_page' => $return_page,
            'purpose' => $purpose,
            'reference' => $reference,
            'amount' => $amount,
            'button_url' => $button_url,
            'donate_buttons' => $this->donate_buttons,
        );

        return PayPalDonations_View::render('paypal-button', $data);
    }

    // -------------------------------------------------------------------------
    // Environment Checks
    // -------------------------------------------------------------------------

    /**
     * Checks PHP and WordPress versions.
     */
    private function testHost()
    {
        // Check if PHP is too old
        if (version_compare(PHP_VERSION, self::MIN_PHP_VERSION, '<')) {
            // Display notice
            add_action('admin_notices', array(&$this, 'phpVersionError'));
            return false;
        }

        // Check if WordPress is too old
        global $wp_version;
        if (version_compare($wp_version, self::MIN_WP_VERSION, '<')) {
            add_action('admin_notices', array(&$this, 'wpVersionError'));
            return false;
        }
        return true;
    }

    /**
     * Displays a warning when installed on an old PHP version.
     */
    public function phpVersionError()
    {
        echo '<div class="error"><p><strong>';
        printf(
            'Error: %3$s requires PHP version %1$s or greater.<br/>'.
            'Your installed PHP version: %2$s',
            self::MIN_PHP_VERSION,
            PHP_VERSION,
            $this->getPluginName()
        );
        echo '</strong></p></div>';
    }

    /**
     * Displays a warning when installed in an old Wordpress version.
     */
    public function wpVersionError()
    {
        echo '<div class="error"><p><strong>';
        printf(
            'Error: %2$s requires WordPress version %1$s or greater.',
            self::MIN_WP_VERSION,
            $this->getPluginName()
        );
        echo '</strong></p></div>';
    }

    /**
     * Get the name of this plugin.
     *
     * @return string The plugin name.
     */
    private function getPluginName()
    {
        $data = get_plugin_data(self::FILE);
        return $data['Name'];
    }
}

add_action('plugins_loaded', array('PayPalDonations', 'getInstance'));
