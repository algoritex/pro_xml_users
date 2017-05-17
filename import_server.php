<?php

/**
 * Created by Algoritex.
 * User: Kike
 * Date: 12/09/2016
 * Time: 21:18
 */

if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');


if (Params::getParam('xml_feed') == "")
    $xml_feed = $_FILES['uploaded_xml']['tmp_name'];
else
    $xml_feed = trim(Params::getParam('xml_feed'));

$xml = loadXML($xml_feed);

if (!$xml) {
    osc_add_flash_error_message(__("Error, XML not found or wrong", 'admin'), 'admin');
    header('Location: ' . osc_admin_render_plugin_url(__DIR__) . "/import.php");
    exit;
}

if (Params::getParam('import_type') == "0")
    importUsers($xml);
else
    importAdmins($xml);




/**
 * Work out the right values for the ads regarding the tags provided
 *
 * @param string $key
 * @param string $tags
 *  @return array
 */

function getAdmin($key, $tags)
{

    // adding a new admin
    $sName = strval($key->$tags['admin_name_tag']) ? strval($key->$tags['name_tag']) : "";
    $sUserName = strval($key->$tags['admin_username_tag']) ?  osc_sanitize_username(strval($key->$tags['username_tag'])) : "";
    $sEmail = strval($key->$tags['admin_email_tag']) ? strval($key->$tags['email_tag']) : "";
    $sPassword = strval($key->$tags['admin_password_tag']) ? strval($key->$tags['password_tag']) : "";
    $bModerator = strval($key->$tags['admin_password_tag']) === "administrator" || strval($key->$tags['admin_password_tag']) === "0"
            ? 0 : 1;

    // cleaning parameters
    $sPassword = strip_tags($sPassword);
    $sPassword = trim($sPassword);
    $sName     = strip_tags($sName);
    $sName     = trim($sName);
    $sEmail    = strip_tags($sEmail);
    $sEmail    = trim($sEmail);
    $sUserName = strip_tags($sUserName);
    $sUserName = trim($sUserName);


    $array = array(
        's_secret' => osc_genRandomPassword(),
        's_password'    =>  osc_hash_password($sPassword),
        's_name'        =>  $sName,
        's_email'       =>  $sEmail,
        's_username'    =>  $sUserName,
        'b_moderator'   =>  $bModerator
    );

    return($array);

}

//add...
function saveAdmin($input)
{

    $error = "";
    if ($input['s_name'] == '')
        $error =  __("Error, name tag not found",'pro_xml_users');

    if (!osc_validate_email($input['s_email']))
        $error = __("Error, name tag not found",'pro_xml_users');

    $admin = Admin::newInstance()->findByEmail($input['s_email']);
    if ($admin != false) {
        osc_run_hook('register_email_taken', $input['s_email']);
        $error = __('The specified e-mail is already in use');
    }

    unset($user);
    if ($input['s_username'] != '') {
        $username_taken = Admin::newInstance()->findByEmail($input['s_username']);
        if (!$error && $username_taken != false)
            $error = __('The specified e-mail is already in use');

        if (osc_is_username_blacklisted($input['s_username']))
            $error = __('The specified e-mail is already in use');

    }
    $output['error'] = $error;


    if ( $error  === "") {
        $admin = Admin::newInstance();
        $admin->insert($input);
        $output['inserted_id'] = $admin->dao->insertedId();

    }
    else {
        $output['inserted_id'] = -1;
    }

    return $output;

}

/**
 * Main function which imports all ads from the xml feed
 *
 * @param string $xml
 * @param string $create_categories
 */
function importAdmins($xml)
{
    if (isset($xml)) {
        $current_ad = 1;
        $line_item = 3;
        $error = "";
        $totalads = countAds($xml);
        $success = 0;
        $tags = Params::getParamsAsArray();

        foreach ($xml as $key) {

            $item = getAdmin($key, $tags);

            $check = checkRequired($item);

            if ($check === "OK") {
                $result = saveAdmin($item);
                if ( $result['inserted_id'] != -1) {
                    $success++;
                }
                else {
                    $error[] = addError($line_item, $current_ad, $result['error']);
                }

            }
            else {
                $error[] = addError($line_item, $current_ad, $check);
            }
            $line_item += $key->count() + 2;
            $current_ad++;
            unset($item);
        }

        $results = array(
            'total_ads' => $totalads,
            'num_success' => $success,
            'num_failed' => $xml->count() - $success,
            'list_errors' => $error,
        );
        $message = "<strong>" . __('Total Ads:', 'pro_xml_users') . "</strong> " . " " . $results['total_ads'] . "<br><strong> " . __('Success:', 'pro_xml_users') . "</strong>" .
            " " . $results['num_success'] . "<br> <strong>" . __('Failed:', 'pro_xml_users') . " </strong>" . " " . $results['num_failed'];
        $message_error = "<br><br><h3>" . __('Errors:', 'pro_xml_users') . " <h3/>";

        if ($results["list_errors"] != "") {
            $message_error .= "<ul>";
            foreach ($results["list_errors"] as $error_item) {
                $message_error .= "<li>" . __('Item:', 'pro_xml_users') . "  " . $error_item['xml_item_error'] . __('Line:', 'pro_xml_users') . "  " .
                    $error_item['xml_line_error'] . "    . " . $error_item['error'] . "</li>";
            }
            $message_error .= "</ul>";
        }


        if ($results['total_ads'] == $results['num_success'])
            osc_add_flash_ok_message(__($message), 'admin');
        else if ($results['total_ads'] == $results['num_failed'])
            osc_add_flash_error_message(__($message) . $message_error, 'admin');
        else
            osc_add_flash_info_message(__($message . $message_error), 'admin');

        header('Location: ' . osc_admin_render_plugin_url(__DIR__) . "/import.php");

    } else {
        osc_add_flash_error_message(__("Error, XML not found or wrong", 'pro_xml_users'), 'admin');
        header('Location: ' . osc_admin_render_plugin_url(__DIR__) . "/import.php");
    }

}


/**
 * Main function which imports all ads from the xml feed
 *
 * @param string $xml
 * @param string $create_categories
 */
function importUsers($xml)
{
    if (isset($xml)) {
        $current_ad = 1;
        $line_item = 3;
        $error = "";
        $totalads = countAds($xml);
        $success = 0;
        $tags = Params::getParamsAsArray();

        foreach ($xml as $key) {

            $item = getUser($key, $tags);

            $check = checkRequired($item);

            if ($check === "OK") {
                $result = saveUser($item);
                if ( $result['inserted_id'] != -1) {
                    $info = isset($key->$tags['info']) ? strval($key->$tags['info']) : "";

                    $user = User::newInstance();
                    $user->updateDescription( $result['inserted_id'], osc_current_user_locale(), $info);

                    // update items with s_contact_email the same as new user email
                    $aItems = Item::newInstance()->findByEmail($item['s_email']);
                    foreach ($aItems as $aux) {
                        if (Item::newInstance()->update(array('fk_i_user_id' =>  $result['inserted_id'], 's_contact_name' => $item['s_name']), array('pk_i_id' => $aux['pk_i_id']))) {
                            $user->increaseNumItems( $result['inserted_id']);
                        }
                    }
                    $success++;
                }
                else {
                    $error[] = addError($line_item, $current_ad, $result['error']);
                }

            }
            else {
                $error[] = addError($line_item, $current_ad, $check);
            }
            $line_item += $key->count() + 2;
            $current_ad++;
            unset($item);
        }

        $results = array(
            'total_ads' => $totalads,
            'num_success' => $success,
            'num_failed' => $xml->count() - $success,
            'list_errors' => $error,
        );
        $message = "<strong>" . __('Total Ads:', 'pro_xml_users') . "</strong> " . " " . $results['total_ads'] . "<br><strong> " . __('Success:', 'pro_xml_users') . "</strong>" .
            " " . $results['num_success'] . "<br> <strong>" . __('Failed:', 'pro_xml_users') . " </strong>" . " " . $results['num_failed'];
        $message_error = "<br><br><h3>" . __('Errors:', 'pro_xml_users') . " <h3/>";

        if ($results["list_errors"] != "") {
            $message_error .= "<ul>";
            foreach ($results["list_errors"] as $error_item) {
                $message_error .= "<li>" . __('Item:', 'pro_xml_users') . "  " . $error_item['xml_item_error'] . __('Line:', 'pro_xml_users') . "  " .
                    $error_item['xml_line_error'] . "    . " . $error_item['error'] . "</li>";
            }
            $message_error .= "</ul>";
        }


        if ($results['total_ads'] == $results['num_success'])
            osc_add_flash_ok_message(__($message), 'admin');
        else if ($results['total_ads'] == $results['num_failed'])
            osc_add_flash_error_message(__($message) . $message_error, 'admin');
        else
            osc_add_flash_info_message(__($message . $message_error), 'admin');

        header('Location: ' . osc_admin_render_plugin_url(__DIR__) . "/import.php");

    } else {
        osc_add_flash_error_message(__("Error, XML not found or wrong", 'pro_xml_users'), 'admin');
        header('Location: ' . osc_admin_render_plugin_url(__DIR__) . "/import.php");
    }
}




/**
 * Work out the right values for the ads regarding the tags provided
 *
 * @param string $key
 * @param string $tags
 *  @return array
 */

function getUser($key, $tags)
{
    $input = array();
    $input['s_secret']    = osc_genRandomPassword();
    $input['dt_reg_date'] = date('Y-m-d H:i:s');
    $input['dt_mod_date'] = date('Y-m-d H:i:s');
    $input['s_name']      = strval($key->$tags['name_tag']) ? strval($key->$tags['name_tag']) : "";
    $input['s_username']  = strval($key->$tags['username_tag']) ?  osc_sanitize_username(strval($key->$tags['username_tag'])) : "";
    $input['s_email']     = strval($key->$tags['email_tag']) ? strval($key->$tags['email_tag']) : "";
    $input['s_password']  = strval($key->$tags['password_tag']) ? strval($key->$tags['password_tag']) : "";
    $input['s_phone_mobile'] =  strval($key->$tags['mobile_phone_tag']) ? strval($key->$tags['mobile_phone_tag']) : "";
    $input['s_phone_land']   =  strval($key->$tags['land_phone_tag']) ? strval($key->$tags['land_phone_tag']) : "";
    $input['s_website']      =  strval($key->$tags['website_tag']) ? strval($key->$tags['website_tag']) : "";
    $input['s_city_area']    = strval($key->$tags['area_tag'] ? strval($key->$tags['area_tag']) : "");
    $input['s_address']      = strval($key->$tags['address_tag']) ? strval($key->$tags['address_tag']) : "";
    $input['s_zip']          = strval($key->$tags['zip_tag']) ? strval($key->$tags['zip_tag']) : "";
    $input['b_company']      = strval($key->$tags['user_type_tag']) == "0" ? 1 : 0;
    $input['b_enabled']      = 1;
    $input['b_active']       = 1;

    //locations...
    $country = Country::newInstance()->findByName( trim(strval($key->$tags['country_tag'])));

    if(count($country) > 0) {
        $countryId   = $country['pk_c_code'];
        $countryName = $country['s_name'];
    } else {
        $countryId   = null;
        $countryName = trim(strval($key->$tags['country_tag']));
    }


    $region = Region::newInstance()->findByName(trim(strval($key->$tags['region_tag'])));
    if( count($region) > 0 ) {
            $regionId   = $region['pk_i_id'];
            $regionName = $region['s_name'];
    }
     else {
        $regionId   = null;
        $regionName = trim(strval($key->$tags['region_tag']));
    }


    $city = City::newInstance()->findByName(trim(strval($key->$tags['city_tag'])));
    if( count($city) > 0 ) {
        $cityId   = $city['pk_i_id'];
        $cityName = $city['s_name'];
    }
     else {
        $cityId   = null;
        $cityName = Params::getParam('city');
    }

    $input['fk_c_country_code'] = $countryId;
    $input['s_country'] = $countryName;
    $input['fk_i_region_id'] = $regionId;
    $input['s_region']       = $regionName;
    $input['fk_i_city_id']   = $cityId;
    $input['s_city']         = $cityName;

    return($input);

}

//add...
function saveUser($input)
{
    $error = "";
    if ($input['s_name'] == '')
        $error =  __("Error, name tag not found",'pro_xml_users');

    if (!osc_validate_email($input['s_email']))
       $error = __("Error, name tag not found",'pro_xml_users');

    $user = User::newInstance()->findByEmail($input['s_email']);
    if ($user != false) {
        osc_run_hook('register_email_taken', $input['s_email']);
        $error = __('The specified e-mail is already in use');
    }

    unset($user);
    if ($input['s_username'] != '') {
        $username_taken = User::newInstance()->findByEmail($input['s_username']);
        if (!$error && $username_taken != false)
            $error = __('The specified e-mail is already in use');

        if (osc_is_username_blacklisted($input['s_username']))
            $error = __('The specified e-mail is already in use');

    }
    $output['error'] = $error;
    if ( $error  === "") {
        $user = User::newInstance();
        $user->insert($input);
        $output['inserted_id'] = $user->dao->insertedId();

    }
    else {
        $output['inserted_id'] = -1;
    }

    return $output;
}


/**
 * Verify if all the item madatory tags are set for the item
 *
 * @param array $item
 *  @return string
 */
function checkRequired($user)
{

    if ($user['s_name'] === "")
        return __("Error, name tag not found",'pro_xml_users');
    else if ($user['s_username'] === "")
        return __("Error, username tag not found",'pro_xml_users');
    else if ($user['s_password'] === "")
        return __("Error, password",'pro_xml_users');
    else return __("OK",'pro_xml_users');
}


/**
 * Add error to errors list
 *
 * @param string $line_item
 * @param string $current_ad
 * @param string $save_result
 * @return array
 */
function addError($line_item, $current_ad, $save_result)
{
    return array(
        'xml_line_error' => $line_item,
        'xml_item_error' => $current_ad,
        'error' => $save_result
    );
}

/**
 * Check and load the XML if exits otherwise retun null
 *
 * @param $xml
 *  @return string
 */

function loadXML($xml)
{
    if(@fopen($xml,'r')) {
       @fclose($xml);
        return simplexml_load_file($xml);
    } else {
        return FALSE;
    }
}

/**
 * Counts the total items for the XML input file
 *
 * @param string $XML
 *  @return int
 */
function countAds($XML)
{
    return count($XML);
}