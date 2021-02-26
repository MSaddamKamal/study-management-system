  $(function() {
      $.validator.setDefaults({
          ignore: [] // DON'T IGNORE PLUGIN HIDDEN SELECTS, CHECKBOXES AND RADIOS!!!
      });

      $('#consent').on('click', function(e) {
          // alert(this.id);

          console.log(this.checked);

          if (this.checked) {
              if (!$(this).next('label').hasClass('error')) {
                  $("<label id='consent-error' class='error label-success' for='consent'>This field is required.</label>").insertAfter(this);
              } else {
                  $(this).next().addClass('label-success');
              }

          }



          if (!this.checked) {
              if (!$(this).next('label').hasClass('error')) {
                  $("<label id='consent-error' class='error' for='consent'>This field is required.</label>").insertAfter(this);
              } else {

                  $(this).next().removeClass('label-success');
              }

          }






          // if(!$(this).next('label').hasClass('error')){
          //     $(this).next().removeClass('label-success');
          // }

          // if($(this).next().hasClass('label-success')){
          //     $(this).next().removeClass('label-success');
          // }

      });

      $('#CloseLabelTop').on('click', function() {
          $('#form1 > label').remove();
          $(this).removeClass('ShowCloseMessage');
      });

      $('#CloseLabelBottom').on('click', function() {
          $('#form2 > label').remove();
          $(this).removeClass('ShowCloseMessage');
      });

      $('#CloseLabelPopUp').on('click', function() {
          $('#form3 > label').remove();
          $(this).removeClass('ShowCloseMessage');
      });



      var cus_rules = {
          validClass: "input-success",
          onkeyup: function(element) {
              $(element).next().remove();
              $(element).valid();
          },
          success: function(label, element) {

          },
          highlight: function(element, errorClass, validClass) {
              var a = "'#" + element.id + "-" + errorClass + "'";


              // $(element).addClass(errorClass).removeClass(validClass);
              $(element.form).find("label[id=" + element.id + "-" + errorClass + "]").addClass(errorClass);
          },
          unhighlight: function(element, errorClass, validClass) {

              $(element).addClass(validClass);
              $(element.form).find("label[id=" + element.id + "-" + errorClass + "]").addClass('label-success');
          },
          rules: {
              name: {
                  minlength: 2,
                  maxlength: 25,
                  required: true,
                  letterswithspace: true
              },

              number: {
                  required: true,
                  phoneUS: true, // <-- no such method called "matches"!
                  minlength: 11,
                  maxlength: 18
              },

              // msg:{
              //    required: true,
              //       minlength: 20,
              //       maxlength: 100,
              //       letterswithspace: true
              // }, 
              email: {
                  required: true,
                  cusEmail: true,

              },



          },
          // highlight: function (element) {
          //     $(element).closest('.form-group').addClass('has-error');
          // },
          messages: {
              name: {
                  minlength: "Name must be at least 2 characters",
                  maxlength: "Maximum number of characters - 25",
                  required: "This field is required",
              },

              //  msg:{
              //     required: "This field is required",
              //       minlength: "Name must be at least 10 characters",
              //       maxlength: "Maximum number of characters - 100",
              // },

              number: {
                  required: "This field is required",
                  // phoneUS: "Only numbers are allowed",
                  minlength: "Name must be at least 11 characters",
                  maxlength: "Maximum number of characters - 18",
              },
          },

      };


      jQuery.validator.addMethod("letterswithspace", function(value, element) {
          return this.optional(element) || /^[a-z][a-z\s]*$/i.test(value);
      }, "Only letters are accepted");


      jQuery.validator.addMethod("phoneUS", function(value, element) {
          return this.optional(element) || value == value.match(/^[\d+ ]*$/);
      }, "Specify a valid Number");





      jQuery.validator.addMethod("cusEmail", function(value, element) {
          return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
      }, "Specify a valid Email");


      $("#cus-top-form").validate(cus_rules);


      $('#cus-top-form').on('submit', function(e) {

          e.preventDefault();
          var current_form = $(this);



          var $form = $(this);
          var serializedData = $form.serialize();
          if (!$form.valid()) return false;
          current_form.addClass('loading');

          $(':input[type="submit"]').prop('disabled', true);

          $.ajax({
              type: 'post',
              url: 'cus_mail.php',
              data: serializedData,
              success: function(data) {
                  $("#cus-top-form").find('.input-success').removeClass("input-success");
                  $("#cus-top-form").find('.label-success').removeClass("label-success");
                  $("#cus-top-form").find('.error').removeClass("error");

                  $(':input[type="submit"]').prop('disabled', false);
                  $('#form1').append('<label><span>Awesome!</span> Thankyou for sharing your dream project <br>with us! One of our experts will get <br>back to you in no time.</label>');
                  $('#CloseLabelTop').addClass('ShowCloseMessage');
                  $('#cus-top-form')[0].reset();
                  $('#interest').val('');
                  current_form.removeClass('loading');
                  // setTimeout(function(){ 
                  //     $('#form1 > label').remove();


                  //    }, 1000);
              },
              error: function() {

                  $(':input[type="submit"]').prop('disabled', false);
                  $('#form1').append('<label> An Error Occured Try Resubmitting</label>');
                  $('#CloseLabelTop').addClass('ShowCloseMessage');
                  $('#cus-top-form')[0].reset();
                  current_form.removeClass('loading');
              }

          });

      });


      $("#cus-bot-form").validate(cus_rules);


      $('#cus-bot-form').on('submit', function(e) {

          e.preventDefault();
          var current_form = $(this);

          $('#bot-form').next('label').remove();

          var $form = $(this);
          var serializedData = $form.serialize();
          if (!$form.valid()) return false;

          $(':input[type="submit"]').prop('disabled', true);
          current_form.addClass('loading');

          $.ajax({
              type: 'post',
              url: 'cus_mail.php',
              data: serializedData,
              success: function(data) {

                  $("#cus-bot-form").find('.input-success').removeClass("input-success");
                  $("#cus-bot-form").find('.label-success').removeClass("label-success");
                  $("#cus-bot-form").find('.error').removeClass("error");

                  $(':input[type="submit"]').prop('disabled', false);

                  $('#form2').append('<label><span>Awesome!</span> Thankyou for sharing your dream project <br>with us! One of our experts will get <br>back to you in no time.</label>');
                  $('#CloseLabelBottom').addClass('ShowCloseMessage');
                  $('#cus-bot-form')[0].reset();

                  current_form.removeClass('loading');
                  // setTimeout(function(){ 
                  //  $('#form2 > label').remove()

                  // }, 1000);
              },
              error: function() {

                  $(':input[type="submit"]').prop('disabled', false);
                  $('#form2').append('<label> An Error Occured Try Resubmitting</label>');
                  $('#CloseLabelBottom').addClass('ShowCloseMessage');
                  $('#cus-bot-form')[0].reset();
                  current_form.removeClass('loading');
              }
          });

      });


      /*pop up form*/

      var popup_form_rules = {
          validClass: "input-success",
          onkeyup: function(element) {
              $(element).parent().find('.error.label-success').remove();
              $(element).valid();
          },

          success: function(label, element) {

              console.log(label);
              console.log(element);
          },

          highlight: function(element, errorClass, validClass) {
              var a = "'#" + element.id + "-" + errorClass + "'";


              // $(element).addClass(errorClass).removeClass(validClass);
              $(element.form).find("label[id=" + element.id + "-" + errorClass + "]").addClass(errorClass);
          },
          unhighlight: function(element, errorClass, validClass) {

              $(element).addClass(validClass);
              $(element.form).find("label[id=" + element.id + "-" + errorClass + "]").addClass('label-success');
          },
          rules: {

              name: {
                  minlength: 2,
                  maxlength: 25,
                  required: true,
                  letterswithspace: true
              },

              number: {
                  required: true,
                  phoneUS: true, // <-- no such method called "matches"!
                  minlength: 11,
                  maxlength: 18
              },

              // msg:{
              //    required: true,
              //     minlength: 20,
              //     maxlength: 100,
              //     letterswithspace: true
              // },

              // interest:{
              //   required: true,
              // },

              //  budget:{
              //   required: true,
              // }, 

              consent: {
                  required: true,
              },
              company: {
                  required: true,
              },

              email: {
                  required: true,
                  cusEmail: true,
              },


          },
          // highlight: function (element) {
          //     $(element).closest('.form-group').addClass('has-error');
          // },
          messages: {
              name: {
                  minlength: "Name must be at least 2 characters",
                  maxlength: "Maximum number of characters - 25",
                  required: "This field is required",
              },

              //  msg:{
              //     required: "This field is required",
              //       minlength: "Name must be at least 10 characters",
              //       maxlength: "Maximum number of characters - 100",
              // },

              number: {
                  required: "This field is required",
                  // phoneUS: "Only numbers are allowed",
                  minlength: "Name must be at least 11 characters",
                  maxlength: "Maximum number of characters - 18",
              },
          },

      };

      $("#cus-pop-form").validate(popup_form_rules);

      $('#cus-pop-form').on('submit', function(e) {

          e.preventDefault();
          var current_form = $(this);
          $('#pop-sub-div').next('label').remove();

          var $form = $(this);
          var serializedData = $form.serialize();
          if (!$form.valid()) return false;
          $("#cus-pop-form").find('.input-success').removeClass("input-success");
          $("#cus-pop-form").find('.label-success').removeClass("label-success");
          $("#cus-pop-form").find('.error').removeClass("error");
          $("#cus-pop-form").find('#consent-error').remove();
          
          $("#cus-pop-form").find(".noempty").each(function() {
            $( this ).removeClass( "noempty" );
          });

          $(':input[type="submit"]').prop('disabled', true);

          current_form.addClass('loading');

          $.ajax({
              type: 'post',
              url: 'mail_popup.php',
              data: serializedData,
              success: function(data) {
                  // $("#cus-pop-form").find('.input-success').removeClass("input-success");
                  // $("#cus-pop-form").find('.label-success').removeClass("label-success");
                  // $("#cus-pop-form").find('.error').removeClass("error");
                  $(':input[type="submit"]').prop('disabled', false);
                  $('#form3').append('<label><span>Awesome!</span> Thankyou for sharing your dream project <br>with us! One of our experts will get <br>back to you in no time.</label>');
                  $('#CloseLabelPopUp').addClass('ShowCloseMessage');
                  $('#cus-pop-form')[0].reset();
                  $('#interest').val('');
                  $('#budget').val('');
                  $('#hear').val('');
                  $("#interest").selectpicker('refresh');
                  $("#budget").selectpicker('refresh');
                  $("#hear").selectpicker('refresh');
                  current_form.removeClass('loading');
                  current_form.removeClass('loading');
                  setTimeout(function() {
                      // $('#form3 > label').remove();
                      // $('select').siblings('button').first().removeClass('btn-light');
                      $("select").each(function() {
                          $(this).siblings('button').first().removeClass('btn-light');
                      });

                  }, 1000);
              },
              error: function() {

                  $(':input[type="submit"]').prop('disabled', false);
                  $('#form3').append('<label> An Error Occured Try Resubmitting</label>');
                  $('#CloseLabelPopUp').addClass('ShowCloseMessage');
                  $('#cus-pop-form')[0].reset();
                  current_form.removeClass('loading');
              }
          });

      });


  });