/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function(){
    function overlay(){
        jQuery("#main_content").append("<div id='background'></div><div id='loader'></div>");
    }
    jQuery("#show_rec").change(function(){
        var data_obj = {start:0,limit:jQuery("#show_rec").val()};
	data_obj = jQuery.toJSON(data_obj);
        jQuery("#process_data").hide();
        jQuery("#search").val("");
        jQuery("#sort_by").val("customer_id");
        overlay();
        jQuery.ajax({
                type: "POST",
                url: jQuery("#base_url").val() + "/paginate",
                cache: false,
                data: { args:data_obj}
        }).done(function( msg ) {
                jQuery("#main_content").html(msg);
        });	
    });	
    jQuery("#sort_by").change(function(){
        jQuery("#process_data").hide();
        jQuery("#search").val("");
        jQuery("#show_rec").val("all");
        overlay();
        jQuery.ajax({
                type: "POST",
                url: jQuery("#base_url").val() + "/sort_by",
                cache: false,
                data: { args:jQuery(this).val() }
        }).done(function( msg ) {
                jQuery("#main_content").html(msg);
        });	
    });	
    jQuery("#search_btn").click(function(){
        jQuery("#process_data").hide();
        jQuery("#sort_by").val("customer_id");
        jQuery("#show_rec").val("all");
        if(jQuery("#search").val() != ""){
            if(!/^[a-z0-9* ]+$/i.test(jQuery("#search").val())) {
                alert('Name can only be alpha numeric with space.');
            } else {
                var sr = jQuery("#search").val();
                overlay();
                jQuery.ajax({
                        type: "POST",
                        url: jQuery("#base_url").val() + "/search_customer",
                        cache: false,
                        data: { args:sr }
                }).done(function( msg ) {
                        jQuery("#main_content").html(msg);
                });	
            }
        } else {
            alert('Name is required for search.');
        }
    });	
    jQuery("#add_btn").click(function(){
        jQuery("#data_table").show();
        jQuery("#transactions").hide();
        jQuery("#cust_name").val("");
        jQuery("#cust_email").val("");
        jQuery("#cust_country").val("");
        jQuery("#process_data h1").html("Add New Customer");
        jQuery("#process_data").show();
        jQuery(".btn1").hide();
        jQuery("#save_btn").show();
        jQuery("#cust_name").focus();
    }); 
    jQuery("body").on('click','.edit', function(){
        jQuery("#data_table").show();
        jQuery("#transactions").hide();
        var ptr = jQuery(this).parents("tr");
        jQuery("#cust_name").val(jQuery(ptr).find('.c_name').eq(0).html());
        jQuery("#cust_email").val(jQuery(ptr).find('.c_email').eq(0).html());
        jQuery("#cust_country").val(jQuery(ptr).find('.c_country').eq(0).val());
        jQuery("#cust_id").val(jQuery(ptr).find('.c_id').eq(0).html());
        jQuery("#process_data h1").html("Update Customer");
        jQuery("#process_data").show();
        jQuery(".btn1").hide();
        jQuery("#update_btn").show();
        window.scrollTo('0px', '0px');
        jQuery("#cust_name").focus();
    }); 
    jQuery("body").on('click','.transactions', function(){
        var ptr = jQuery(this).parents("tr");
        var id = jQuery(ptr).find('.c_id').eq(0).html();
        jQuery("#cust_id_t").val(jQuery(ptr).find('.c_id').eq(0).html());
        jQuery("#cust_name_t").html(jQuery(ptr).find('.c_name').eq(0).html());
        jQuery("#cust_email_t").html(jQuery(ptr).find('.c_email').eq(0).html());
        jQuery("#cust_country_t").html(jQuery(ptr).find('.c_country').eq(0).val());
        jQuery("#process_data #tle").html("Transactions of " + jQuery(ptr).find('.c_name').eq(0).html());
        jQuery("#data_table").hide();
        jQuery("#transactions_t").html("<div style='color:red'>&nbsp;&nbsp;Loading transactions...<div>");
        jQuery("#transactions").show();
        jQuery("#process_data").show();
        jQuery.ajax({
                type: "POST",
                url: jQuery("#base_url").val() + "/view_transactions",
                cache: false,
                data: { args:id }
        }).done(function( msg ) {
                jQuery("#transactions_t").html(msg);
                window.scrollTo('0px', '0px');
        });
    }); 
    jQuery("body").on('click','#close', function(){
        jQuery("#data_table").hide();
        jQuery("#transactions_t").html("");
        jQuery("#transactions").hide();
        jQuery("#process_data").hide();
    }); 
    jQuery("body").on('click','.delete', function(){
        var ptr = jQuery(this).parents("tr");
        var c = jQuery(ptr).find('.c_name').eq(0).html();
        var id = jQuery(ptr).find('.c_id').eq(0).html();
        var r=confirm("You are about to delete customer "+c+".\nConfirm Delete?");
        if (r==true)
          {	
            overlay();  
            jQuery.ajax({
                    type: "POST",
                    url: jQuery("#base_url").val() + "/delete_customer",
                    cache: false,
                    data: { args:id }
            }).done(function( msg ) {
                    jQuery("#main_content").html(msg);
            });
          }
    }); 
    jQuery("body").on('mouseover','#main_table tr', function(){
        jQuery(".actions").hide();
        jQuery(this).find('.actions').eq(0).show();
        jQuery(this).find('.actions').eq(1).show();
    });
    jQuery("body").on('mouseout','#main_table', function(){
        jQuery(".actions").hide();
    });
    jQuery("#cancel_btn").click(function(){
        jQuery("#process_data").hide();
        jQuery("#process_data .cust_in,#process_data select").val("");
    });
    jQuery("#update_btn").click(function(){
        //validate date first
        var err = "";
        if(jQuery("#cust_name").val() == ""){
            err += "Customer Name is required.\n";
        }
        if(jQuery("#cust_email").val() == ""){
            err += "Customer Email is required.\n";
        } else {
            var input=$(this);
            var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var is_email=re.test(jQuery("#cust_email").val());
            if(is_email){}else{
                 err += "Customer Email is invalid.\n";
            }
        }
        if(jQuery("#cust_country").val() == ""){
            err += "Country is required.\n";
        }
        if(err != ""){
            alert(err);
        } else {        
            jQuery("#remarks").show();
            jQuery("#remarks").html("<span style='color:red'>Saving Data...</span>");
            overlay();
            var data_obj = {id:jQuery("#cust_id").val(), 
                            name: jQuery("#cust_name").val() , 
                            email: jQuery("#cust_email").val(),
                            country:jQuery("#cust_country").val()};
            data_obj = jQuery.toJSON(data_obj);
            jQuery.ajax({
                    type: "POST",
                    url: jQuery("#base_url").val() + "/update_customer",
                    cache: false,
                    data: { args:data_obj }
            }).done(function( msg ) {
                    jQuery("#remarks").html("");
                    jQuery("#remarks").hide();
                    jQuery("#main_content").html(msg);
            });
        }
    });	 
    jQuery("#save_btn").click(function(){
        //validate date first
        var err = "";
        if(jQuery("#cust_name").val() == ""){
            err += "Customer Name is required.\n";
        }
        if(jQuery("#cust_email").val() == ""){
            err += "Customer Email is required.\n";
        } else {
            var input=$(this);
            var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var is_email=re.test(jQuery("#cust_email").val());
            if(is_email){}else{
                 err += "Customer Email is invalid.\n";
            }
        }
        if(jQuery("#cust_country").val() == ""){
            err += "Country is required.\n";
        }
        if(err != ""){
            alert(err);
        } else {
            jQuery("#remarks").show();
            jQuery("#remarks").html("<span style='color:red'>Adding Record...</span>");
            overlay();
            var data_obj = {name: jQuery("#cust_name").val() , 
                            email: jQuery("#cust_email").val(),
                            country:jQuery("#cust_country").val()};
            data_obj = jQuery.toJSON(data_obj);
            jQuery.ajax({
                    type: "POST",
                    url: jQuery("#base_url").val() + "/add_customer",
                    cache: false,
                    data: { args:data_obj }
            }).done(function( msg ) {
                    jQuery("#remarks").html("");
                    jQuery("#remarks").hide();
                    jQuery("#main_content").html(msg);
                    jQuery("#process_data").hide();
                    jQuery("#process_data .cust_in,#process_data select").val("");
            });	
        }
    });	 
    jQuery("body").on("click","#send_email",function(){
        jQuery("#remarks_email").html("<span style='color:red'>Sending data to customer email...</span>");
        var data_obj = {id:jQuery("#cust_id_t").val(), 
                        name: jQuery("#cust_name_t").html() , 
                        email: jQuery("#cust_email_t").html(),
                        country:jQuery("#cust_country_t").html()};
        data_obj = jQuery.toJSON(data_obj);
        jQuery.ajax({
                type: "POST",
                url: jQuery("#base_url").val() + "/send_email",
                cache: false,
                data: { args:data_obj }
        }).done(function( msg ) {
                jQuery("#remarks_email").html("<span style='color:green;margin:5px 0px 20px 0px;'>Successfully sent data!</span>");
        });
    });
    jQuery('body').on('click','#next',function(){
	var data_obj = {start:parseInt(jQuery('#paginate_page').val()) + 1,limit:jQuery("#show_rec").val()};
	data_obj = jQuery.toJSON(data_obj);		
	overlay();
	jQuery.ajax({
                type: 'POST',
                url: jQuery("#base_url").val() + "/paginate",
                cache: false,
                data: { args: data_obj }
        }).done(function( msg ) {
                jQuery('#main_content').html(msg);
	});
    });
    jQuery('body').on('click','#prev',function(){
            var data_obj = {start:parseInt(jQuery('#paginate_page').val()) - 1,limit:jQuery("#show_rec").val()};
            data_obj = jQuery.toJSON(data_obj);	
            overlay();
            jQuery.ajax({
                    type: 'POST',
                    url: jQuery("#base_url").val() + "/paginate",
                    cache: false,
                    data: { args: data_obj }
            }).done(function( msg ) {
                    jQuery('#main_content').html(msg);
            });
    });                            
    jQuery('body').on('change','#paginate_page',function(){
            var data_obj = {start:jQuery(this).val(),limit:jQuery("#show_rec").val()};
            data_obj = jQuery.toJSON(data_obj);	
            overlay();
            jQuery.ajax({
                    type: 'POST',
                    url: jQuery("#base_url").val() + "/paginate",
                    cache: false,
                    data: { args: data_obj }
            }).done(function( msg ) {
                    jQuery('#main_content').html(msg);
            });
    });
});

