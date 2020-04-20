var SnippetLogin=function()
{
	$('#email').focus();
	var e=$("#m_login"),
	i=function(e,i,a)
	{
		var l=$('<div class="alert alert-'+i+' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
            e.find(".alert").remove(),
             l.prependTo(e),
             mUtil.animateClass(l[0],
             "fadeIn animated"),
             l.find("span").html(a)},
             a=function(){e.removeClass("m-login--forget-password"),
             e.removeClass("m-login--signup"),e.addClass("m-login--signin"),
            mUtil.animateClass(e.find(".m-login__signin")[0],"flipInX animated")},
             l=function(){$("#m_login_forget_password").click(function(i){
             	i.preventDefault(),
             	e.removeClass("m-login--signin"),
             	e.removeClass("m-login--signup"),
             	e.addClass("m-login--forget-password"),
             	mUtil.animateClass(e.find(".m-login__forget-password")[0],
             	"flipInX animated")}),
                $("#m_login_forget_password_cancel").click(function(e){
                e.preventDefault(),a()}),
                $("#m_login_signup").click(function(i){
                i.preventDefault(),
                e.removeClass("m-login--forget-password"),
                e.removeClass("m-login--signin"),
                e.addClass("m-login--signup"),
                mUtil.animateClass(e.find(".m-login__signup")[0],
                "flipInX animated")}),
                $("#m_login_signup_cancel").click(function(e){
                	e.preventDefault(),a()})};
                   return{init:function(){l(),
                   	$("#m_login_signin_submit").click(function(e){
                   	e.preventDefault();
                   	var a=$(this),l=$(this).closest("form");
                   	l.validate({rules:{email:{required:!0,email:!0},
                   	password:{required:!0}}}),
                   	l.valid()&&(a.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),
                   		l.ajaxSubmit({url:"loginMe",success:function(data){setTimeout(function(){
                        if(data.indexOf("ok") != -1)
                   			{
                   				window.open('/login','_self');
                   			} else if(data.indexOf("accessno") != -1)
                   			{
                     			a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),
                     			i(l,"danger","Access disabled. please contact support.");
                        } else
                        {
                          a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),
                          i(l,"danger","Email address or password is incorrect. Please try again.");
                        }
                      },
                   			2e3)
                   			}}))}),
                   	       $("#m_login_signup_submit").click(function(l){
                            l.preventDefault();
                            var t=$(this);
                            r=$(this).closest("form");
                            r.validate(
                              {rules:{fullname:{required:!0},
                                      email:{required:!0,email:!0},
                                      password:{required:!0},
                                      rpassword:{required:!0},
                                      agree:{required:!0}}}),
                                      r.valid()&&(t.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),
                                      //AjaxSubmit()..... FormDataPost
                                      r.ajaxSubmit(
                                        {url:"addNewLoginPage",
                                            success:function(data)
                                            { 
                                              setTimeout(function(){
                                              t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1);
                                              if(data == "success")
                                              {
                                                  toastr.success("It was registered as a result.","success");
                                                  setTimeout(function(){ window.open('/login','_self'); }, 1500);
                                              } else if(data == "validation_error")
                                              {
                                                  toastr.warning("Validation Error!.","Notice");
                                              } 
                                              else if(data == "exist")
                                              {
                                                  toastr.warning("The current user already exists.","Notice");
                                               } else 
                                              {
                                                 toastr.error("Registration failed.","Notice");
                                               }
                                            });  
                                          }
                                      })  
                                      /////  
                                      );
                           }),
                   	       $("#m_login_forget_password_submit").click(function(l){l.preventDefault();
                   	       	  var t=$(this),
                   	       	  r=$(this).closest("form");
                   	       	  r.validate({rules:{email:{required:!0,email:!0}}}),
                   	       	  r.valid()&&(t.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),
                   	       	  	r.ajaxSubmit({url:"loginMe",success:function(l,s,n,o){setTimeout(function(){t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),
                   	       	  		r.clearForm(),r.validate().resetForm(),
                   	       	  		a();
                   	       	  		var l=e.find(".m-login__signin form");
                   	       	  		l.clearForm(),l.validate().resetForm(),
                   	       	  		i(l,"success","Cool! Password recovery instruction has been sent to your email.")},2e3)}}))})}}}();
                   	     jQuery(document).ready(function(){SnippetLogin.init()});