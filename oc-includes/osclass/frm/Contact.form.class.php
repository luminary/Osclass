<?php if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    class ContactForm extends Form {

        static public function primary_input_hidden() {
            parent::generic_input_hidden("id", osc_item_id() ) ;
            return true;
        }

        static public function page_hidden() {
            parent::generic_input_hidden("page", 'item') ;
            return true;
        }

        static public function action_hidden() {
            parent::generic_input_hidden("action", 'contact_post') ;
            return true;
        }

        static public function your_name() {
            if( Session::newInstance()->_get("yourName") != "" ) {
                $name = Session::newInstance()->_get("yourName") ;
                Session::newInstance()->_drop("yourName") ;
                parent::generic_input_text("yourName", $name, null, false);
            } else {
                parent::generic_input_text("yourName", osc_logged_user_name(), null, false);
            }
            return true ;
        }

        static public function your_email() {
             if( Session::newInstance()->_get("yourEmail") != "" ) {
                $email = Session::newInstance()->_get("yourEmail") ;
                Session::newInstance()->_drop("yourEmail") ;
                parent::generic_input_text("yourEmail", $email, null, false);
            } else {
                parent::generic_input_text("yourEmail", osc_logged_user_email(), null, false);
            }
            return true ;
        }

        static public function your_phone_number() {
            if( Session::newInstance()->_get("phoneNumber") != "" ) {
                $phoneNumber = Session::newInstance()->_get("phoneNumber") ;
                Session::newInstance()->_drop("phoneNumber") ;
                parent::generic_input_text("phoneNumber", $phoneNumber, null, false);
            } else {
                parent::generic_input_text("phoneNumber", osc_logged_user_phone(), null, false);
            }
            return true ;
        }

        static public function the_subject() {
            if( Session::newInstance()->_get("subject") != "" ) {
                $subject = Session::newInstance()->_get("subject") ;
                Session::newInstance()->_drop("subject") ;
                parent::generic_input_text("subject", $subject, null, false);
            } else {
                parent::generic_input_text("subject", "", null, false);
            }
            return true ;
        }

        static public function your_message() {
            if( Session::newInstance()->_get("message_body") != "" ) {
                $message = Session::newInstance()->_get("message_body") ;
                Session::newInstance()->_drop("message_body") ;
                parent::generic_textarea("message", $message);
            } else {
                parent::generic_textarea("message", "");
            }
            return true ;
        }

        static public function your_attachment() {
            echo '<input type="file" name="attachment" />';
        }

        static public function js_validation() {
?>
<script type="text/javascript">
    $(document).ready(function(){
        // Code for form validation
        $("form[name=contact]").validate({
            rules: {
                message: {
                    required: true
                },
                yourEmail: {
                    required: true,
                    email: true
                }
            },
            messages: {
                yourEmail: {
                    required: "<?php _e("Email: this field is required"); ?>.",
                    email: "<?php _e("Invalid email address"); ?>."
                },
                message: {
                    required: "<?php _e("Message: this field is required"); ?>."
                }
            },
            errorLabelContainer: "#error_list",
            wrapper: "li",
            invalidHandler: function(form, validator) {
                $('html,body').animate({ scrollTop: $('h1').offset().top }, { duration: 250, easing: 'swing'});
            }
        });
    });
</script>
<?php 
        }
        

        
        static public function js_validation_old() { ?>
<script type="text/javascript">
    function validate_contact() {
        email = $("#yourEmail");
        message = $("#message");

        var pattern=/^([a-zA-Z0-9\_\.\-\+])+@([a-zA-Z0-9_\.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        var num_error = 0;

        if(!pattern.test(email.val())){
            email.css('border', '1px solid red');
            num_error = num_error + 1;
        }

        if(message.val().length < 1) {
            message.css('border', '1px solid red');
            num_error = num_error + 1;
        }

        if(num_error > 0) {
            return false;
        }

        return true;
    }

    $(document).ready(function(){
        $("#yourEmail").focus(function(){
            $(this).css('border', '');
        });

        $("#message").focus(function(){
            $(this).css('border', '');
        });
    });
</script>
        <?php }


    }

?>