<?php

/**
Plugin Name: Words Count
Description: A super cool plugin
Version: 1.0
Author: Hovhannes Verdyan
 */

class WordCountPlugin {

    public function __construct(){
        add_action('admin_menu', [$this, 'adminPage']);
        add_action('admin_init', [$this, 'settings']);
    }

    public function settings()
    {

        //Where to show the texts
        add_settings_section(
            'wcp_first_section',
            null,
            null,
            'word-count-setting-page'
        );

        add_settings_field(
            'wcp_location',
            'Display Location',
            [$this, 'locationHTML'],
            'word-count-setting-page',
            'wcp_first_section'
        );

        register_setting(
            'wordCountPlugin',
            'wcp_location',
            ['sanitize_callback' => 'sanitize_text_field', 'default' => '0']
        );

    }

    public function locationHTML()
    { ?>
        <select name="wcp_location">
            <option value="0" <?php selected(get_option('wcp_location'), '0') ?>>Beginning of post</option>
            <option value="1" <?php selected(get_option('wcp_location'), '1') ?>>The end of post</option>
        </select>
    <?php }

    public function adminPage()
    {
        add_options_page( 'Words count settings', 'Word Count', 'manage_options', 'word-count-setting-page', [$this, 'settings_html']);
    }

    public function settings_html()
    { ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php">
                <?php
                settings_fields('wordCountPlugin');
                do_settings_sections('word-count-setting-page');
                submit_button();
                ?>
            </form>
        </div>
    <?php }

}

$wordCountAndTimePlugin = new WordCountPlugin();



