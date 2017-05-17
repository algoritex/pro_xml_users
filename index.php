<?php

/*
Plugin Name: Pro Users Backup
Plugin URI: pro-xml-users
Description: Import/Export all users/administrators from a XML file
Version: 1.0.0
Author: Algoritex
Author URI: http://www.algoritex.com
Short Name: pro_xml_users
Plugin update URI:
*/

if ( !defined('ABS_PATH') ) {
    exit('ABS_PATH is not loaded. Direct access is not allowed.');
}



function pro_users_configure()
{
    osc_admin_render_plugin('pro_xml_users/import.php');
}


function admin_header_users()
{
    echo '<link href="' . osc_plugin_url(__FILE__) . 'css/style.min.css'. '" rel="stylesheet" type="text/css">' . PHP_EOL;
}

function admin_footer_users()
{
    echo '<script src="' . osc_plugin_url(__FILE__) . 'js/functions.js'.'"></script>' . PHP_EOL;
}


function pro_xml_users_menu()
{
    $import = osc_admin_render_plugin_url(__DIR__) . "/import.php";
    $export = osc_admin_render_plugin_url(basename(dirname(__FILE__)) . "/export.php");
    $help = osc_admin_render_plugin_url(basename(dirname(__FILE__)) . "/help.php");
    echo '<h3><a href="#">' . __('Pro XML Users', 'pro_xml_users') . '</a></h3>';
    echo '<ul>
            <li><a class="admin_menu_proxml" href="' . $import . '"><strong>' . __('- Import', 'pro_xml_users') . '</strong></a></li>
             <li><a class="admin_menu_proxml" href="' . $export . '"><strong>' . __('- Export', 'pro_xml_users') . '</strong></a></li>
            <li><a class="admin_menu_proxml" href="' . $help . '"><strong>' . __('- Help', 'pro_xml_users') . '</strong></a></li>
         </ul>';
}



function pro_xml_users_menu_bar($active)
{

    $import = osc_admin_render_plugin_url(__DIR__) . "/import.php";
    $export = osc_admin_render_plugin_url(basename(dirname(__FILE__)) . "/export.php");
    $help = osc_admin_render_plugin_url(basename(dirname(__FILE__)) . "/help.php");
    $title =  __('Pro XML Users Import/Export Users', 'pro_xml_users');
    if ($active == "IMPORT") {
        echo '<ul>
            <li><a class="logo" href="#">' . $title . '</a></li>
            <li><a class="active" href="' . $import . '">' . __('Import', 'pro_xml_users') . '</a></li>
             <li><a href="' . $export . '">' . __('Export', 'pro_xml_users') . '</a></li>
            <li><a href="' . $help . '">' . __('Help', 'pro_xml_users') . '</a></li>
         </ul>';
    } else if ($active == "EXPORT") {
        echo '<ul>
            <li><a class="logo" href="#">' . $title . '</a></li>
            <li><a href="' . $import . '">' . __('Import', 'pro_xml_users') . '</a></li>
             <li><a class="active" href="' . $export . '">' . __('Export', 'pro_xml_users') . '</a></li>
            <li><a href="' . $help . '">' . __('Help', 'pro_xml_users') . '</a></li>
         </ul>';
    } else if ($active == "HELP") {
        echo '<ul>
            <li><a class="logo" href="#">' . $title . '</a></li>
            <li><a href="' . $import . '">' . __('Import', 'pro_xml_users') . '</a></li>
             <li><a href="' . $export . '">' . __('Export', 'pro_xml_users') . '</a></li>
            <li><a class="active" href="' .  $help . '">' . __('Help', 'pro_xml_users') . '</a></li>
         </ul>';
    }
}


function pro_xml_footer_users()
{
    $link = "http://www.algoritex.com";
    echo '<section>
            <footer class="text-center">
            <br>
                ' . __('Pro XML Users 1.0 | Copyright © 2017 | Created by', 'pro_xml_users') .'
                    <a class="link_footer" target="_blank"
                            href="' . $link . '"><strong>' . __("Algoritex") .'</strong></a>
               <br><br>
            </footer>
        </section>';
}

function load_pro_xml_users_files() {

    if (Params::getParam('page') == 'plugins' && Params::getParam('action') == 'renderplugin' &&
        (Params::getParam('file') == 'pro_xml_users/export.php' ||
            Params::getParam('file') == 'pro_xml_users/help.php' ||
            Params::getParam('file') == 'pro_xml_users/import.php')
    ) {
        osc_add_hook('admin_header', 'admin_header_users');
        osc_add_hook('admin_footer', 'admin_footer_users');
    }
}


osc_add_hook('init_admin', 'load_pro_xml_users_files');
osc_add_hook('admin_menu', 'pro_xml_users_menu');
osc_add_hook(osc_plugin_path(__FILE__) . "_configure", 'pro_users_configure');