

$(window).on("load", function() {
    "use strict";





        $("#company_name").hide();
        $("#contact_first_name").hide();
        $("#contact_last_name").hide();
        $("#contact_email_address").hide();
        $("#cheque_payable_to").hide();
        $("#contact_telephone_number").hide();
        $("#contact_fax_number").hide();
        $("#contact_mailing_address").hide();
        $(".hide-reg").hide();




/*
client
mobilerotary
processserver
staff
*/



    $("#userRole").on("change", function(e){

            e.preventDefault();

        let userRole                     = $("#userRole").val();

        let company_name                 = $("#company_name").val();
        let contact_first_name           = $("#contact_first_name").val();
        let contact_last_name            = $("#contact_last_name").val();
        let contact_email_address        = $("#contact_email_address").val();
        let cheque_payable_to            = $("#cheque_payable_to").val();
        let contact_telephone_number     = $("#contact_telephone_number").val();
        let contact_fax_number           = $("#contact_fax_number").val();
        let contact_mailing_address      = $("#contact_mailing_address").val();


        if(userRole == 'staff'){
            $("#contact_first_name").show();
            $("#contact_last_name").show();
            $("#contact_email_address").show();
            $("#contact_telephone_number").show();

            $("#company_name").hide();
            $("#cheque_payable_to").hide();
            $("#contact_fax_number").hide();
            $("#contact_mailing_address").hide();
            $(".hide-reg").show();


        }else if(userRole == 'client'){
            $("#company_name").show();
            $("#contact_first_name").show();
            $("#contact_last_name").show();
            $("#contact_email_address").show();
            $("#cheque_payable_to").hide();
            $("#contact_telephone_number").show();
            $("#contact_fax_number").show();
            $("#contact_mailing_address").show();
            $(".hide-reg").show();



        }else if(userRole == 'mobilerotary'){

            $("#company_name").show();
            $("#contact_first_name").show();
            $("#contact_last_name").show();
            $("#contact_email_address").hide();
            $("#cheque_payable_to").show();
            $("#contact_telephone_number").hide();
            $("#contact_fax_number").hide();
            $("#contact_mailing_address").hide();
            $(".hide-reg").show();


        }else if(userRole == 'processserver'){

            $("#company_name").show();
            $("#contact_first_name").show();
            $("#contact_last_name").show();
            $("#contact_email_address").hide();
            $("#cheque_payable_to").show();
            $("#contact_telephone_number").hide();
            $("#contact_fax_number").hide();
            $("#contact_mailing_address").hide();
            $(".hide-reg").show();




        }else{


            $("#company_name").hide();
            $("#contact_first_name").hide();
            $("#contact_last_name").hide();
            $("#contact_email_address").hide();
            $("#cheque_payable_to").hide();
            $("#contact_telephone_number").hide();
            $("#contact_fax_number").hide();
            $("#contact_mailing_address").hide();
            $(".hide-reg").hide();




        }


            console.log(userRole);
    });


});