<?php

/**
Plugin Name: Words Count
Description: A super cool plugin
Version: 1.0
Author: Hovhannes Verdyan
 */


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
            array($this, 'ourHTML')
        );
    }

    function settings() {
        add_settings_section(
                'wcp_first_section',
                null,
                null,
                'word-count-settings-page'
        );

        //Choosing the location of the texts in the post
        add_settings_field(
                'wcp_location',
                'Display Location',
                array($this, 'locationHTML'),
                'word-count-settings-page',
                'wcp_first_section'
        );

        register_setting(
                'wordcountplugin',
                'wcp_location',
                array('sanitize_callback' => 'sanitize_text_field',
                'default' => '0')
        );

        //Chosing the headline
        add_settings_field(
                'wcp_location',
                'Headline Location',
                array($this, 'headlineHTML'),
                'word-count-settings-page',
                'wcp_first_section'
        );

        register_setting(
                'wordcountplugin',
                'wcp_headline',
                array('sanitize_callback' => 'sanitize_text_field',
                'default' => 'Post Statistics')
        );

    }

    public function headlineHTML()
    {

    }

    public function locationHTML() { ?>
        <select name="wcp_location">
            <option value="0" <?php selected(get_option('wcp_location'), '0') ?>>Beginning of post</option>
            <option value="1" <?php selected(get_option('wcp_location'), '1') ?>>End of post</option>
        </select>
    <?php }


    public function ourHTML() { ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="POST">
                <?php
                settings_fields('wordcountplugin');
                do_settings_sections('word-count-settings-page');
                submit_button();
                ?>
            </form>
        </div>
    <?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();