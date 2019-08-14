<?php
/*
Plugin Name: Amelia Calendar Essential Shortcodes
Plugin URI: https://github.com/husin-sajjadi/amelia-essential-shortcodes
Description: The amelia hasn't any shortcodes for calendar view in front end. This plugin have a couple of essential shortcodes for amelia
Version: 1.0
Author: Husin Sajjadi
Author URI: https://www.linkedin.com/in/mohammad-husin-sajjadi-39324862/
Text Domain: wpamelia
Domain Path: https://github.com/husin-sajjadi
License: GPLv2 or later
*/
use AmeliaBooking\Infrastructure\WP\Translations\BackendStrings;
use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Infrastructure\WP\SettingsService\SettingsStorage;

function amelia_calendar( $atts ){

    if ( ! function_exists( 'is_plugin_active' ) )
        require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

    if ( !is_plugin_active( 'ameliabooking/ameliabooking.php' ) ) {
        return "Amelia Plugin isn't install or active";
        exit();
    }


    echo '<style>.v-modal{z-index: 1 !important;}</style>';
    $page = $atts['type'];
    $settingsService = new SettingsService(new SettingsStorage());


    wp_enqueue_script(
        'amelia_booking_scripts',
        AMELIA_URL . 'public/js/backend/amelia-booking.js',
        [],
        AMELIA_VERSION
    );


    if ($page === 'wpamelia-locations' || $page === 'wpamelia-settings') {
        $gmapApiKey = $settingsService->getSetting('general', 'gMapApiKey');

        wp_enqueue_script(
            'google_maps_api',
            "https://maps.googleapis.com/maps/api/js?key={$gmapApiKey}&libraries=places"
        );
    }

    // Enqueue Styles
    wp_enqueue_style(
        'amelia_booking_styles',
        AMELIA_URL . 'public/css/backend/amelia-booking.css',
        [],
        AMELIA_VERSION
    );

    // WordPress enqueue
    wp_enqueue_media();

    // Strings Localization
    switch ($page) {
        case ('wpamelia-locations'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getLocationStrings(),
                    BackendStrings::getCommonStrings()
                )
            );

            break;
        case ('wpamelia-services'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getServiceStrings(),
                    BackendStrings::getCommonStrings()
                )
            );

            break;
        case ('wpamelia-employees'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getUserStrings(),
                    BackendStrings::getEmployeeStrings(),
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getScheduleStrings()
                )
            );

            break;
        case ('wpamelia-customers'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getUserStrings(),
                    BackendStrings::getCustomerStrings(),
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getScheduleStrings()
                )
            );

            break;
        case ('wpamelia-finance'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getFinanceStrings(),
                    BackendStrings::getPaymentStrings(),
                    BackendStrings::getEventStrings()
                )
            );

            break;
        case ('wpamelia-appointments'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getUserStrings(),
                    BackendStrings::getCustomerStrings(),
                    BackendStrings::getAppointmentStrings(),
                    BackendStrings::getPaymentStrings()
                )
            );

            break;

        case ('wpamelia-events'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getUserStrings(),
                    BackendStrings::getCustomerStrings(),
                    BackendStrings::getAppointmentStrings(),
                    BackendStrings::getEventStrings()
                )
            );

            break;

        case ('wpamelia-dashboard'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getAppointmentStrings(),
                    BackendStrings::getUserStrings(),
                    BackendStrings::getCustomerStrings(),
                    BackendStrings::getDashboardStrings(),
                    BackendStrings::getPaymentStrings()
                )
            );

            break;
        case ('wpamelia-calendar'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getEntityFormStrings(),
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getAppointmentStrings(),
                    BackendStrings::getUserStrings(),
                    BackendStrings::getCustomerStrings(),
                    BackendStrings::getCalendarStrings(),
                    BackendStrings::getPaymentStrings(),
                    BackendStrings::getEventStrings()
                )
            );

            break;
        case ('wpamelia-notifications'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getNotificationsStrings()
                )
            );

            break;

        case ('wpamelia-smsnotifications'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getNotificationsStrings()
                )
            );

            break;
        case ('wpamelia-settings'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getCommonStrings(),
                    BackendStrings::getScheduleStrings(),
                    BackendStrings::getSettingsStrings()
                )
            );

            break;
        case ('wpamelia-customize'):
            wp_localize_script(
                'amelia_booking_scripts',
                'wpAmeliaLabels',
                array_merge(
                    BackendStrings::getCustomizeStrings(),
                    BackendStrings::getCommonStrings()
                )
            );

            break;
    }

    wp_localize_script(
        'amelia_booking_scripts',
        'wpAmeliaSettings',
        $settingsService->getFrontendSettings()
    );

    wp_localize_script(
        'amelia_booking_scripts',
        'localeLanguage',
        AMELIA_LOCALE
    );


    include AMELIA_PATH . '/view/backend/view.php';


}
add_shortcode( 'amelia_calendar', 'amelia_calendar' );
