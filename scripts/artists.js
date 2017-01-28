function show_confirm(del)
{
	var r=confirm("Are you sure that you want to delete this artist?");
	if (r)
		window.location.href=del;

}

$(document).ready(function(){
        $("#myTable").tablesorter({
			widgets: ['zebra'],
            headers: {4: { sorter: false }},
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

        var txt=name.text();
        name.hide();
        name.parent().append("<input type='text' value='"+ txt +"' />");

        //Year of Birth
        var birthYear=$("#"+id).find("td").children(".editTextBirthYear");

        txt=birthYear.text();
        birthYear.hide();
        birthYear.parent().append("<input type='text' size='4' value='"+ txt +"' />");


        //Year of Death
        var deathYear=$("#"+id).find("td").children(".editTextDeathYear");

        txt=deathYear.text();
        deathYear.hide();
        deathYear.parent().append("<input type='text'  size='4' value='"+ txt +"' />");

        //Place of Birth
        var birthPlace=$("#"+id).find("td").children(".dropDownBirthPlace");
        var btxt=birthPlace.text();
        birthPlace.hide();

 

        $.ajax({
            url: "country_list.html",
            success: function (data) 
            { 
                birthPlace.parent().append("<span class='dd'>" +data+"</span>");
                birthPlace.parent().find("select").val(btxt).change();
            },
            dataType: "html"
        });


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
    name=tmp.parent().find("input").val();

    //Year of Birth
    tmp=$("#"+id).find("td").children(".editTextBirthYear");
    var birthYear=tmp.parent().find("input").val();

    //Year of Death
    tmp=$("#"+id).find("td").children(".editTextDeathYear");
    var deathYear=tmp.parent().find("input").val();

    //Place of Birth
    tmp=$("#"+id).find("td").children(".dropDownBirthPlace");
    var birthPlace=tmp.parent().find("select").val();




    $.ajax({
        type: "POST",
        url: "artists_edit.php",
        dataType: "html",
        data: {
        	id: id,
            name : name,
            birthYear: birthYear,
            deathYear: deathYear,
            birthPlace: birthPlace
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

    //Year of Birth
    var birthYear=$("#"+id).find("td").children(".editTextBirthYear");
    birthYear.show();
    birthYear.parent().find("input").remove();

    //Year of Death
    var deathYear=$("#"+id).find("td").children(".editTextDeathYear");
    deathYear.show();
    deathYear.parent().find("input").remove();

    //Place of Birth
    var birthPlace=$("#"+id).find("td").children(".dropDownBirthPlace");
    birthPlace.show();
    birthPlace.parent().find(".dd").remove();
}
