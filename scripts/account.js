$(document).ready(function(){
    $(".edit").click(function(){




        //Email
        var email=$(this).siblings("#email");


        var txt=email.text();
        email.hide();
        email.parent().append("<input type='email' maxlength='50' value='"+ txt +"' />");


        $(this).hide();
        $(this).siblings(".delete").hide();
        $(this).parent().append("<span id='buttons'>&nbsp;&nbsp;&nbsp;<input type='button' class='confirm'/><input type='button' class='cancel'/></span>");

    });
});


$(document).on('click', '.cancel', function()
{
    
    $(this).parent().parent().find("input").hide();
    $(this).parent().siblings("#email").show();
    $(this).parent().siblings(".edit").show();
    $(this).parent().remove();

});

$(document).on('click', '.confirm', function()
{
    //Email
    var email=$(this).parent().parent().find("input").val();

    $.ajax({
        type: "POST",
        url: "update_email.php",
        dataType: "html",
        data: {
        	new_email: email
        },
        success: function(response){
            window.location.reload();
        }

    });


});


