<?php if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');

?>

<div class="proheader">
    <?php pro_xml_users_menu_bar("HELP") ?>
</div>

<div class="wrapper">

    <div class="widget-box">
        <div class="widget-box-title">
            <h3><?php echo __('Import', 'pro_xml_users'); ?></h3>
        </div>
        <div class="widget-box-content">
        <div class="import">

            <p>
                <?php echo __('The import feature allows you to import ads from a XML file to your system.', 'pro_xml_users'); ?>
            </p>

            <p>
            <h4><?php echo __('Steps:', 'pro_xml_users'); ?> </h4>
            <table>
                <tr>
                    <td>
                        <ul>
                            <li> <?php echo __('1) Load from an url or from your HD', 'pro_xml_users'); ?></li>
                            <li> <?php echo __('2) Set the corresponding xml tags from your file', 'pro_xml_users'); ?></li>
                            <li> <?php echo __('3) Make sure the tags name you set match with the ones of the XML file', 'pro_xml_users'); ?></li>
                            <li> <?php echo __('4) Execute the import', 'pro_xml_users'); ?></li>
                        </ul>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <img src="<?php echo osc_esc_html(osc_plugin_url(__FILE__))?>/images/help_admins_import.png">
                    </td>
                </tr>
            </table>


            </p>
            <h4><?php echo __('Notes:', 'pro_xml_users'); ?></h4>
            <table>
                <tr>
                    <td>
                        <ul>
                            <li> <?php echo __("- Categories that do not exist in the system will be skipped by default. To create non existent categories mark, the checkbox Create non existent categories", 'pro_xml_users'); ?></li>
                            <li> <?php echo __('- When executing the import, in case mandatory tag is not found or found with a wrong value, the ad will be skiped from the importation', 'pro_xml_users'); ?>
                            </li>
                            <li> <?php echo __('Default Data Help', 'pro_xml_users'); ?></li>
                            <li> <?php echo __('Mandatories attributes', 'pro_xml_users'); ?>
                            </li>
                        </ul>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <img src="<?php echo osc_esc_html(osc_plugin_url(__FILE__))?>/images/help_users_import.png">
                    </td>
                </tr>
            </table>

        </div>
        </div>
    </div>

    <br>
    <div class="widget-box">
        <div class="widget-box-title">
            <h3><?php echo __('Export', 'pro_xml_users'); ?></h3>
        </div>
        <div class="widget-box-content">
            <div class="export">
                <p>
                    <?php echo __('Export feature', 'pro_xml_users'); ?>
                </p>
                <h4><?php echo __('Notes:', 'pro_xml_users'); ?></h4>
                <ul>
                    <li> <?php echo __('Default tags', 'pro_xml_users'); ?></li>
                    <li> <?php echo __('Tags not defined', 'pro_xml_users'); ?></li>
                </ul>

            </div>
        </div>
    </div>

</div>


<?php pro_xml_footer_users() ?>


