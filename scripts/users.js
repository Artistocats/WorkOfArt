function show_confirm(del)
{
    var r=confirm("Are you sure that you want to delete this user?");
    if (r)
        window.location.href=del;
}

$(document).ready(function(){
        $("#myTable").tablesorter({
			widgets: ['zebra'],
			headers: {2: { sorter: false }},
            sortList: [[0,0]]
        	
    	});
});

var editRow=0;

$(document).ready(function(){
    $(".edit").click(function(){

    	if(editRow!=0)
        {
            var id = editRow.parent().parent().attr('id');
            hide_editing(id);
            editRow.siblings(".confirm").remove();
            editRow.siblings(".cancel").remove();
            editRow.siblings(".delete").show();
            editRow.show();
        }

        editRow=$(this);


        var id = $(this).parent().parent().attr('id');


        //UserName
        var name=$("#"+id).find("td").children(".editTextUsername");

        var txt=name.text();
        name.hide();
        name.parent().append("<input type='text' value='"+ txt +"' />");

        //Email
        var email=$("#"+id).find("td").children(".editTextEmail");

        txt=email.text();
        email.hide();
        email.parent().append("<input type='text' value='"+ txt +"' />");


        $(this).hide();
        $(this).siblings(".delete").hide();
        $(this).parent().append("<input type='button' class='confirm'/><input type='button' class='cancel'/>");

    });
});


$(document).on('click', '.cancel', function()
{
    var id = $(this).parent().parent().attr('id');
    hide_editing(id);
    $(this).siblings(".confirm").remove();
    $(this).siblings(".edit").show();
    $(this).siblings(".delete").show();
    $(this).remove();

});


$(document).on('click', '.confirm', function()
{
    var id = $(this).parent().parent().attr('id');

    //UserName
    var tmp=$("#"+id).find("td").children(".editTextUsername");
    name=tmp.parent().find("input").val();

    //Email
    tmp=$("#"+id).find("td").children(".editTextEmail");
    var email=tmp.parent().find("input").val();

    old=$("#"+id).find("td").children(".editTextUsername").text();

    $.ajax({
        type: "POST",
        url: "users_edit.php",
        dataType: "html",
        data: {
            oldName:old,
            name : name,
            email: email,
        },
        success: function(response){
            window.location.reload();
        }

    });

    hide_editing(id);
    $(this).siblings(".cancel").remove();
    $(this).siblings(".edit").show();
    $(this).siblings(".delete").show();
    $(this).remove();
});

function hide_editing(id)
{
	//UserName
    var name=$("#"+id).find("td").children(".editTextUsername");
    name.show();
    name.parent().find("input").remove();

    //Email
    var email=$("#"+id).find("td").children(".editTextEmail");
    email.show();
    email.parent().find("input").remove();

}