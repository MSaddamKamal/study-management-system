 $(function() { 

   $.validator.setDefaults({
          ignore: [] // DON'T IGNORE PLUGIN HIDDEN SELECTS, CHECKBOXES AND RADIOS!!!
        });

   $('.add_form').on('click', function(e) {

    window.history.replaceState(null, null, window.location.pathname);
    $('.alert-danger').remove();
    $('.alert-success').remove();

    e.preventDefault();

    var cus_rules = {
      rules: {
        name: {
          required: true,
        },





      },
    };




    var $form = $("#add_form");

    $("#add_form").validate(cus_rules);

    if (!$form.valid()) return false;





    $form.submit();






  });


   $('#submit_btn_add_form').on('click', function(e) {


    window.history.replaceState(null, null, window.location.pathname);
    $('.alert-danger').remove();
    $('.alert-success').remove();

    e.preventDefault();

    var cus_rules = {
      rules: {
        full_name: {
          required: true,
        },
        date_of_birth: {
          required: true,
        },
        telephone: {
          required: true,
          digits: true
        }, 
        email: {
          required: true,
          cusEmail: true,
        }, 
        country_id: {
          required: true,

        },
        'courses[]': {
          required: true,

        },  
        file: {
          required: true,
         

        },






      },
    };


    jQuery.validator.addMethod("cusEmail", function(value, element) {
      return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
    }, "Specify a valid Email");

    var $form = $("#add_student_form");

    $form.validate(cus_rules);

    if (!$form.valid()) return false;





    $form.submit();






  });



   $('#submit_btn_edit_form').on('click', function(e) {



    e.preventDefault();

    var cus_rules = {
      rules: {
        full_name: {
          required: true,
        },
        date_of_birth: {
          required: true,
        },
        telephone: {
          required: true,
          digits: true
        }, 
        email: {
          required: true,
          cusEmail: true,
        }, 
        country_id: {
          required: true,

        },







      },
    };


    jQuery.validator.addMethod("cusEmail", function(value, element) {
      return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
    }, "Specify a valid Email");

    var $form = $("#edit_student_form");

    $form.validate(cus_rules);

    if (!$form.valid()) return false;





    $form.submit();






  });









 });