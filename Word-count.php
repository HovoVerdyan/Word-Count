<?php

/**
Plugin Name: Words Count
Description: A super cool plugin
Version: 1.0
Author: Hovhannes Verdyan
 */

require_once "HtmlFunctions.php";

class WordCountAndTimePlugin {
    function __construct() {
        add_action('admin_menu', array($this, 'adminPage'));
        add_action('admin_init', array($this, 'settings'));
    }

    function adminPage() {
        add_options_page(
            'Word Count Settings',
            'Word Count',
            'manage_options',
            'word-count-settings-page',
            array('HtmlFunctions', 'ourHTML')
        );
    }

    function settings() {
        add_settings_section(
                'wcp_first_section',
                null,
                null,
                'word-count-settings-page'
        );

        /*
         * Choosing the location of the texts in the post
         */
        add_settings_field(
                'wcp_location',
                'Display Location',
                array('HtmlFunctions', 'locationHTML'),
                'word-count-settings-page',
                'wcp_first_section'
        );

        register_setting(
                'wordcountplugin',
                'wcp_location',
                array('sanitize_callback' => 'sanitize_text_field',
                'default' => '0')
        );

        /*
        * Choosing the headline
        */
        add_settings_field(
                'wcp_headline',
                'Headline Text',
                array('HtmlFunctions', 'headlineHTML'),
                'word-count-settings-page',
                'wcp_first_section'
        );

        register_setting(
                'wordcountplugin',
                'wcp_headline',
                array('sanitize_callback' => 'sanitize_text_field',
                'default' => 'Post Statistics')
        );

        /*
        * Enable Word Counting
        */
        add_settings_field(
                'wcp_wordcount',
                'Word Count',
                array('HtmlFunctions', 'checkboxFunctionsHtml'),
                'word-count-settings-page',
                'wcp_first_section',
                array('checkBoxName' => 'wcp_wordcount')
        );

        register_setting(
                'wordcountplugin',
                'wcp_wordcount',
                array('sanitize_callback' => 'sanitize_text_field',
                'default' => '1')
        );

        /*
        * Enable Character Count
        */
        add_settings_field(
                'wcp_charactercount',
                'Character Count',
                array('HtmlFunctions', 'checkboxFunctionsHtml'),
                'word-count-settings-page',
                'wcp_first_section',
                 array('checkBoxName' => 'wcp_charactercount')
        );

        register_setting(
                'wordcountplugin',
                'wcp_charactercount',
                array('sanitize_callback' => 'sanitize_text_field',
                'default' => '1')
        );

        /*
        * Enable Read Time
        */
        add_settings_field(
                'wcp_readcount',
                'Read Count',
                array('HtmlFunctions', 'checkboxFunctionsHtml'),
                'word-count-settings-page',
                'wcp_first_section',
                array('checkBoxName' => 'wcp_readcount')
        );

        register_setting(
                'wordcountplugin',
                'wcp_readcount',
                array('sanitize_callback' => 'sanitize_text_field',
                'default' => '1')
        );

    }

}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();