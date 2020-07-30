<?php if (!defined('OC_ADMIN') || OC_ADMIN !== true) exit('Access is not allowed.');
?>

    <div class="proheader ui-rounded-corners">
        <?php pro_xml_users_menu_bar("IMPORT");
        ?>
    </div>

    <div class="wrapper">

        <div class="xml_options">

            <form id="xml_form" class="form-horizontal" action="<?php
            echo osc_admin_render_plugin_url(basename(dirname(__FILE__)) . "/import_server.php"); ?>" method="post">

                <div class="widget-box">
                    <div class="widget-box-title">
                        <h3><?php echo __('Import Options', 'pro_xml_users'); ?></h3>
                    </div>
                    <div class="widget-box-content">
                        <div class="form-row">
                            <div class="form-label"><?php echo __('What to import', 'pro_xml_users'); ?></div>
                            <div class="form-controls">
                                <select class="" id="import_type" name="import_type">
                                    <option value="0" selected><?php echo __('Users', 'pro_xml_users'); ?></option>
                                    <option value="1"><?php echo __('Admins', 'pro_xml_ads'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-label"><?php echo __('XML URL', 'pro_xml_users'); ?></div>
                            <div class="form-controls">
                                <input id="xml_feed" name="xml_feed" class="input-large" type="text"
                                       placeholder="XML url"/>*
                            </div>


                                                            <div class="xml_links_users">
                                                                <small>
                                                                    <a href="http://proxml-demo.algoritex.com/oc-content/plugins/pro_xml_users/examples/example_users.xml"
                                                                       target="_blank">
                                                                        http://proxml-demo.algoritex.com/oc-content/plugins/pro_xml_users/examples/example_users.xml
                                                                    </a>
                                                                    <br>
                                                                    <a href="http://proxml-demo.algoritex.com/oc-content/plugins/pro_xml_users/examples/example_users50.xml"
                                                                       target="_blank">
                                                                        http://proxml-demo.algoritex.com/oc-content/plugins/pro_xml_users/examples/example_users50.xml
                                                                    </a>
                                                                </small>
                                                            </div>
                                                            <div class="xml_links_admins">
                                                                <small>
                                                                    <a href="http://proxml-demo.algoritex.com/oc-content/plugins/pro_xml_users/examples/example_admins.xml"
                                                                       target="_blank">
                                                                        http://proxml-demo.algoritex.com/oc-content/plugins/pro_xml_users/examples/example_admins.xml
                                                                    </a>

                                                                </small>
                                                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-label"><?php echo __('Upload XML File', 'pro_xml_ads'); ?></div>
                            <div class="form-controls">
                                <input name="uploaded_xml" id="uploaded_xml" type="file"> *
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="widget-box">
                    <div class="widget-box-title">
                        <h3><?php echo __('Import File Tags', 'pro_xml_users'); ?></h3>
                    </div>
                    <div class="widget-box-content">
                        <div class="users">
                            <div class="user_title">
                                <b class="stats-title"><?php echo __('Users', 'pro_xml_users'); ?></b>
                            </div>
                            <div class="admin_title">
                                <b class="stats-title"><?php echo __('Admins', 'pro_xml_users'); ?></b>
                            </div>
                            <br>
                            <hr>
                            <br>

                            <div class="mandatory_tags">
                                <small class="stats-title"><?php echo __('Mandatory', 'pro_xml_users'); ?></small>
                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Name', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="name_tag" name="name_tag" type="text" placeholder="name" required/>
                                        >*
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Username', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="username_tag" name="username_tag" type="text"
                                               placeholder="username" required/>
                                        >*
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Email', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="email_tag" name="email_tag" type="text"
                                               placeholder="email" required/>
                                        >*
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Password', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="password_tag" name="password_tag" type="text"
                                               placeholder="password" required/>
                                        >*
                                    </div>
                                </div>

                            </div>


                            <div class="user_optional">
                                <small class="stats-title"><?php echo __('Optional', 'pro_xml_users'); ?></small>
                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Mobile Phone', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="mobile_phone_tag" name="mobile_phone_tag" type="text"
                                               placeholder="mobile"/>
                                        >
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-label"> <?php echo __('Land Phone', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="land_phone_tag" name="land_phone_tag" type="text"
                                               placeholder="landphone"/>
                                        >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label"><?php echo __('WebSite', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="website_tag" name="website_tag" type="text" placeholder="website"/>
                                        >
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Country', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="country_tag" name="country_tag" type="text" placeholder="country"/>
                                        >
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Region', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="region_tag" name="region_tag" type="text" placeholder="region"/>
                                        >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-label"><?php echo __('City', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="city_tag" name="city_tag" type="text" placeholder="city"/>
                                        >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label"><?php echo __('City Area', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="area_tag" name="area_tag" type="text" placeholder="area"/>
                                        >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Address', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="address_tag" name="address_tag" type="text" placeholder="address"/>
                                        >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Tag Zip', 'pro_xml_ads'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="zip_tag" name="zip_tag" type="text" placeholder="zip"/>
                                        >
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-label"><?php echo __('User Type', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="user_type_tag" name="user_type_tag" type="text"
                                               placeholder="user_type"/>
                                        >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Info', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="info_tag" name="info_tag" type="text"
                                               placeholder="info"/>
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="admin_optional">
                                <div class="form-row">
                                    <div class="form-label"><?php echo __('Moderator', 'pro_xml_users'); ?></div>
                                    <div class="form-controls">
                                        <
                                        <input id="admin_moderator_tag" name="admin_moderator_tag" type="text"
                                               placeholder="moderator"/>
                                        >
                                    </div>
                                </div>
                            </div>

                            <div style="display: block; clear: both;"></div>

                        </div>

                    </div>
                    <br>

                </div>
                <div class="submit_div">
                    <input class="btn btn-blue" value="<?php echo osc_esc_html(__('Import File', 'pro_xml_users')); ?>"
                           type="submit">
                </div>
            </form>
        </div>

    </div>


<?php

pro_xml_footer_users() ?>