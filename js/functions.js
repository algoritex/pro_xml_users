jQuery(document).ready(function(){$(".admins").hide();$(".xml_links_admins").hide();$(".xml_links_users").show();$(".users").show();$(".user_custom_tags").hide();$(".admin_custom_tags").hide();$("#import_type").change(function(){var selected=$("#import_type").val();if(selected=="0"){$(".admins").hide();$(".xml_links_admins").hide();$(".xml_links_users").show();$(".users").show()}
else{$(".users").hide();$(".xml_links_users").hide();$(".xml_links_admins").show();$(".admins").show()}});$("#users_default_tags").change(function(){var selected=$('#users_default_tags').is(':checked');if(selected==!0)
    $(".user_custom_tags").show();else $(".user_custom_tags").hide()});$("#admins_default_tags").change(function(){var selected=$("#admins_default_tags").is(':checked');if(selected==!0)
    $(".admin_custom_tags").show();else $(".admin_custom_tags").hide()})})