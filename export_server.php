<?php
/**
 * Created by Algoritex.
 * User: Kike
 * Date: 05/05/2017
 * Time: 11:32
 */
if (!defined('OC_ADMIN') || OC_ADMIN !== true) exit('Access is not allowed.');



$check_users = Params::getParam('check_export_users') == "1" ? true : false;
$check_admins = Params::getParam('check_export_admins') == "1" ? true : false;

if ($check_users) {
    $users = retrieveUsers();
    $default_users_tags = Params::getParam('users_default_tags') == "1" ? true : false;
    $tags_users = getUserTags($default_users_tags);
    doExportUsers($users, $tags_users);
}

if ($check_admins) {
    $admins = retrieveAdmins();
    $default_admins_tags = Params::getParam('admins_default_tags') == "1" ? true : false;
    $tags_users = getAdminTags($default_admins_tags);
    doExportAdmins($admins, $tags_users);
}

header('Location: ' . osc_admin_render_plugin_url(__DIR__) . "/export.php");
exit;



/**
 * Get all users
 *
 * @return array
 */
function retrieveUsers()
{
   return User::newInstance()->listAll();
}

/**
 * Get all users
 *
 * @return array
 */
function retrieveAdmins()
{
    return Admin::newInstance()->listAll();
}





/**
 * Export the ads tp the xml output file
 *
 * @param array $data
 * @param array $tags
 */
function doExportUsers($data, $tags)
{

    if (count($data) > 0) {
        $xml_output = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><listings></listings>');

        foreach ($data as $item) {

            $xml_item = $xml_output->addChild("listing");

            $xml_item->addChild($tags['name'] === "" ? "name" : $tags['name'], $item['s_name'] === null ? "" : $item['s_name']);
            $xml_item->addChild($tags['username'] === "" ? "username" : $tags['username'], $item['s_username'] === null ? "" : $item['s_username']);
            $xml_item->addChild($tags['email'] === "" ? "email" : $tags['email'], $item['s_email'] === null ? "" : $item['s_email']);
            $xml_item->addChild($tags['password'] === "" ? "password" : $tags['password'], $item['s_password'] === null ? "" : $item['s_password']);
            $xml_item->addChild($tags['mobile_phone'] === "" ? "mobile_phone" : $tags['mobile_phone'], $item['s_phone_mobile'] === null ? "" : $item['s_phone_mobile']);
            $xml_item->addChild($tags['land_phone'] === "" ? "land_phone" : $tags['land_phone'], $item['s_phone_land'] === null ? "" : $item['s_phone_land']);
            $xml_item->addChild($tags['country'] === "" ? "country" : $tags['country'], $item['s_country'] === null ? "" : $item['s_country']);
            $xml_item->addChild($tags['region'] === "" ? "region" : $tags['region'], $item['s_region'] === null ? "" : $item['s_region']);
            $xml_item->addChild($tags['city'] === "" ? "city" : $tags['city'], $item['s_city'] === null ? "" : $item['s_city']);
            $xml_item->addChild($tags['area'] === "" ? "area" : $tags['area'], $item['s_city_area'] === null ? null : $item['s_city_area']);
            $xml_item->addChild($tags['zip'] === "" ? "zip" : $tags['zip'], $item['zip'] === null ? "" : $item['zip']);
            $xml_item->addChild($tags['address'] === "" ? "address" : $tags['address'], $item['s_address'] === null ? "" : $item['s_address']);
            $xml_item->addChild($tags['company'] === "" ? "company" : $tags['company'], $item['b_company'] === null ? "" : $item['b_company']);
            $xml_item->addChild($tags['enabled'] === "" ? "enabled" : $tags['enabled'], $item['b_enabled'] === null ? "" : $item['b_enabled']);
            $xml_item->addChild($tags['active'] === "" ? "active" : $tags['active'], $item['b_active'] === null ? "" : $item['b_active']);

        }


        $name = osc_plugin_path(__DIR__) ."/exported_files/os_users_export.xml";
        $download_name = osc_plugin_url(__FILE__) . "exported_files/os_users_export.xml";
        $res = file_put_contents($name, $xml_output->asXML());
        if ( $res === FALSE) {
            $message = "<strong>". __("Error happened generating XML file", 'pro_xml_users'). "</strong>";
            osc_add_flash_error_message(__($message, 'pro_xml_users'), 'admin');
        }
        else {
            $message = "<strong>". __("XML Generated successfully:", 'pro_xml_users'). " " ."</strong><a href='$download_name' target='_blank'>" . basename($name) . "</a>";
            osc_add_flash_ok_message(__($message, 'pro_xml_users'), 'admin');
        }

    }
    else {
        osc_add_flash_error_message(__("No ads in the system", 'pro_xml_users'), 'admin');
    }
}


/**
 * Export the ads tp the xml output file
 *
 * @param array $data
 * @param array $tags
 */
function doExportAdmins($data, $tags)
{

    if (count($data) > 0) {
        $xml_output = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><listings></listings>');

        foreach ($data as $item) {

            $xml_item = $xml_output->addChild("listing");

            $xml_item->addChild($tags['name'] === "" ? "name" : $tags['name'], $item['s_name'] === null ? "" : $item['s_name']);
            $xml_item->addChild($tags['username'] === "" ? "username" : $tags['username'], $item['s_username'] === null ? "" : $item['s_username']);
            $xml_item->addChild($tags['email'] === "" ? "email" : $tags['email'], $item['s_email'] === null ? "" : $item['s_email']);
            $xml_item->addChild($tags['password'] === "" ? "password" : $tags['password'], $item['s_password'] === null ? "" : $item['s_password']);
            $xml_item->addChild($tags['moderator'] === "" ? "moderator" : $tags['password'], $item['b_moderator'] === null ? "" : $item['b_moderator']);
        }


        $name = osc_plugin_path(__DIR__) ."/exported_files/os_admins_export.xml";
        $download_name = osc_plugin_url(__FILE__) . "exported_files/os_admins_export.xml";
        $res = file_put_contents($name, $xml_output->asXML());
        if ( $res === FALSE) {
            $message = "<strong>". __("Error happened generating XML file", 'pro_xml_users'). "</strong>";
            osc_add_flash_error_message(__($message, 'pro_xml_users'), 'admin');
        }
        else {
            $message = "<strong>". __("XML Generated successfully:", 'pro_xml_users'). " " ."</strong><a href='$download_name' target='_blank'>" . basename($name) . "</a>";
            osc_add_flash_ok_message(__($message, 'pro_xml_users'), 'admin');
        }

    }
    else {
        osc_add_flash_error_message(__("No ads in the system", 'pro_xml_users'), 'admin');
    }

}


/**
 * Add error to errors list
 *
 * @param string $default_tags
 * @return array
 */
function getUserTags($default_tags)
{

    return array(
        "name" => $default_tags ? "name" : Params::getParam('name_tag'),
        "username" => $default_tags ? "username" : Params::getParam('username_tag'),
        "email" => $default_tags ? "email" : Params::getParam('email_tag'),
        "password" => $default_tags ? "password" : Params::getParam('password_tag'),
        "mobile_phone" => $default_tags ? "email" : Params::getParam('mobile_phone_tag'),
        "land_phone" => $default_tags ? "password" : Params::getParam('land_phone_tag'),
        "country" => $default_tags ? "country" : Params::getParam('country_tag'),
        "region" => $default_tags ? "region" : Params::getParam('region_tag'),
        "city" => $default_tags ? "city" : Params::getParam('city_tag'),
        "area" => $default_tags ? "area" : Params::getParam('area_tag'),
        "zip" => $default_tags ? "zip" : Params::getParam('zip_tag'),
        "address" => $default_tags ? "address" : Params::getParam('address_tag'),
        "company" => $default_tags ? "company" : Params::getParam('company_tag'),
        "enabled" => $default_tags ? "enabled" : Params::getParam('enabled_tag'),
        "active" => $default_tags ? "address" : Params::getParam('active_tag'),
    );
}

/**
 * Add error to errors list
 *
 * @param string $default_tags
 * @return array
 */
function getAdminTags($default_tags)
{

    return array(
        "name" => $default_tags ? "name" : Params::getParam('admin_name_tag'),
        "username" => $default_tags ? "name" : Params::getParam('admin_username_tag'),
        "email" => $default_tags ? "email" : Params::getParam('admin_email_tag'),
        "password" => $default_tags ? "password" : Params::getParam('admin_password_tag'),
        "moderator" => $default_tags ? "moderator" : Params::getParam('admin_moderator_tag'),
    );
}