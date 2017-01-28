function show_confirm(del)
{
	var r=confirm("Are you sure that you want to delete this movement?");
	if (r)
		window.location.href=del;

}

$(document).ready(function(){
        $("#myTable").tablesorter({
			widgets: ['zebra'],
			headers: {3: { sorter: false }},
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


        //Name
        var name=$("#"+id).find("td").children(".editTextName");

        txt=name.text();
        name.hide();
        name.parent().append("<input type='text' value='"+ txt +"' />");

        //From Year
        var fromYear=$("#"+id).find("td").children(".editTextFromYear");

        txt=fromYear.text();
        fromYear.hide();
        fromYear.parent().append("<input type='text' size='4' value='"+ txt +"' />");

        //Until Year
        var untilYear=$("#"+id).find("td").children(".editTextUntilYear");

        txt=untilYear.text();
        untilYear.hide();
        untilYear.parent().append("<input type='text' size='4' value='"+ txt +"' />");


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

    //Name
    var tmp=$("#"+id).find("td").children(".editTextName");
    var name=tmp.parent().find("input").val();

    //From Year
    tmp=$("#"+id).find("td").children(".editTextFromYear");
    var fromYear=tmp.parent().find("input").val();

    //Until Year
    tmp=$("#"+id).find("td").children(".editTextUntilYear");
    var untilYear=tmp.parent().find("input").val();



    $.ajax({
        type: "POST",
        url: "movements_edit.php",
        dataType: "html",
        data: {
        	id: id,
            name : name,
            from_year: fromYear,
            until_year: untilYear
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
	//Name
    var name=$("#"+id).find("td").children(".editTextName");
    name.show();
    name.parent().find("input").remove();

    //Year
    var fromYear=$("#"+id).find("td").children(".editTextFromYear");
    fromYear.show();
    fromYear.parent().find("input").remove();

    //Year
    var untilYear=$("#"+id).find("td").children(".editTextUntilYear");
    untilYear.show();
    untilYear.parent().find("input").remove();   
}
