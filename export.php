<?php if (!defined('OC_ADMIN') || OC_ADMIN !== true) exit('Access is not allowed.');
?>

    <div class="proheader ui-rounded-corners">
        <?php pro_xml_users_menu_bar("EXPORT") ?>
    </div>

    <div class="wrapper">

        <form id="export_form" class="form-horizontal" action="<?php
        echo osc_admin_render_plugin_url(basename(dirname(__FILE__)) . "/export_server.php"); ?>" method="post">

            <div class="grid-system">
                <div class="grid-row grid-first-row grid-100">


                    <div class="grid-row grid-50">
                        <div class="row-wrapper">
                            <div class="widget-box">
                                <div class="widget-box-title">
                                    <h3><?php echo __('Export Users options', 'pro_xml_users'); ?></h3>
                                </div>
                                <div class="widget-box-content">
                                    <div class="user_export">
                                            <div class="form-label"><?php echo __('Export Users', 'pro_xml_users'); ?></div>
                                            <div class="form-controls">
                                                <input class="custom_checkbox" name="check_export_users"
                                                       id="check_export_users" value="1" type="checkbox" checked>
                                            </div>
                                        <br>
                                        <div
                                            class="form-label"><?php echo __('Use Custom Tags', 'pro_xml_users'); ?></div>
                                        <div class="form-controls">
                                            <input class="custom_checkbox" name="users_default_tags"
                                                   id="users_default_tags" value="1" type="checkbox">
                                        </div>
                                        <br> <br>
                                        <div class="user_custom_tags">
                                            <h5> <?php echo __('Custom tags', 'pro_xml_users'); ?> </h5>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Name', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="name_tag" name="name_tag" type="text" placeholder="name"/>
                                                    >
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Username', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="username_tag" name="username_tag" type="text"
                                                           placeholder="username"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Email', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="email_tag" name="email_tag" type="text"
                                                           placeholder="email"/>
                                                    >
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Password', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="password_tag" name="password_tag" type="text"
                                                           placeholder="password"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div
                                                    class="form-label"> <?php echo __('Phone Land', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="phone_land_tag" name="phone_land_tag" type="text"
                                                           placeholder="land_phone"/>
                                                    >
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div
                                                    class="form-label"><?php echo __('Mobile Phone', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="mobile_phone_tag" name="mobile_phone_tag" type="text"
                                                           placeholder="mobile_phone"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('WebSite', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="website_tag" name="website_tag" type="text"
                                                           placeholder="website"/>
                                                    >
                                                </div>
                                            </div>



                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Country', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="country_tag" name="country_tag" type="text"
                                                           placeholder="country"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Region', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="region_tag" name="region_tag" type="text"
                                                           placeholder="region"/>
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
                                                <div
                                                    class="form-label"><?php echo __('City Area', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="area_tag" name="area_tag" type="text"
                                                           placeholder="area"/>
                                                    >
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Zip', 'pro_xml_ads'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="zip_tag" name="zip_tag" type="text" placeholder="zip"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Active', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="active_tag" name="active_tag" type="text" placeholder="active"/>
                                                    >
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div
                                                    class="form-label"><?php echo __('User Type', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="user_type_tag" name="user_type_tag" type="text"
                                                           placeholder="user_type"/>
                                                    >
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid-row grid-50">
                        <div class="row-wrapper">
                            <div class="widget-box">
                                <div class="widget-box-title">
                                    <h3><?php echo __('Export Admins options', 'pro_xml_users'); ?></h3>
                                </div>
                                <div class="widget-box-content">
                                    <div class="admin_export">

                                        <div
                                            class="form-label"><?php echo __('Export Admins', 'pro_xml_users'); ?></div>
                                        <div class="form-controls">
                                            <input class="export_admins" name="check_export_admins"
                                                   id="check_export_admins" value="1" type="checkbox" checked>
                                        </div>

                                        <br>

                                        <div
                                            class="form-label"><?php echo __('Use Custom Tags', 'pro_xml_users'); ?></div>
                                        <div class="form-controls">
                                            <input class="custom_checkbox" name="admins_default_tags"
                                                   id="admins_default_tags" value="1" type="checkbox">
                                        </div>
                                        <br> <br>
                                        <div class="admin_custom_tags">
                                            <h5> <?php echo __('Custom tags', 'pro_xml_users'); ?> </h5>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Name', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="admin_name_tag" name="admin_name_tag" type="text"
                                                           placeholder="name"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Username', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="admin_username_tag" name="admin_username_tag" type="text"
                                                           placeholder="Username"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Email', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="admin_email_tag" name="admin_email_tag" type="text"
                                                           placeholder="Email"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-label"><?php echo __('Password', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="admin_password_tag" name="admin_password_tag" type="text"
                                                           placeholder="password"/>
                                                    >
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div
                                                    class="form-label"><?php echo __('Moderator', 'pro_xml_users'); ?></div>
                                                <div class="form-controls">
                                                    <
                                                    <input id="admin_moderator_tag" name="admin_moderator_tag" type="text"
                                                           placeholder="moderator"/>
                                                    >
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="display: block; clear: both;"></div>

                    <div class="submit_div">
                        <input class="btn btn-green" value="<?php echo osc_esc_html(__('Export', 'pro_xml_users')); ?>" type="submit">
                    </div>
                </div>

            </div>

        </form>

    </div>

<?php
pro_xml_footer_users() ?>