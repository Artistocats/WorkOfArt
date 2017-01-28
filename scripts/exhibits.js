function show_confirm(del)
{
	var r=confirm("Are you sure that you want to delete this exhibit?");
	if (r)
		window.location.href=del;

}

$(document).ready(function(){
        $("#myTable").tablesorter({
			widgets: ['zebra'],
        	headers: {
        		6: { sorter: false },
        		7: { sorter: false }
        	},
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


        //Year
        var year=$("#"+id).find("td").children(".editTextYear");

        var txt=year.text();
        year.hide();
        year.parent().append("<input type='text' size='4' value='"+ txt +"' />");


        //Exhibition
        var exhibition=$("#"+id).find("td").children(".dropDownExhibition");
        txt=exhibition.text();
        exhibition.hide();

        $.ajax({
        type: "GET",
        url: "exhibitions_fetch.php",
        dataType: "html",
        data: {
            name : txt
        },
        success: function(response){
            exhibition.parent().append(response);
        }

        });



        //Movement
        var movement=$("#"+id).find("td").children(".dropDownMovement");
        txt=movement.text();
        movement.hide();

        $.ajax({
        type: "GET",
        url: "artmovements_fetch.php",
        dataType: "html",
        data: {
            name : txt
        },
        success: function(response){
            movement.parent().append(response);
        }

        });


        //Exhibit
        var exhibit=$("#"+id).find("td").children(".editTextExhibit");

        txt=exhibit.text();
        exhibit.hide();
        exhibit.parent().append("<input type='text' required value='"+ txt +"' />");


        //Artists
        var artist=$("#"+id).find("td").children(".dropDownArtist");
        artist.hide();

        $.ajax({
        type: "GET",
        url: "artists_fetch.php",
        dataType: "html",
        data: {
            exhibit : txt
        },
        success: function(response){
            artist.parent().append("<span class='dd'>" + response + "</span>");
        }

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

    //Exhibit
    var tmp=$("#"+id).find("td").children(".editTextExhibit");
    var exhibit=tmp.parent().find("input").val();

    //Year
    tmp=$("#"+id).find("td").children(".editTextYear");
    var year=tmp.parent().find("input").val();

    //Exhibition
    tmp=$("#"+id).find("td").children(".dropDownExhibition");
    var exhibition=tmp.parent().find("select").val();

    //Movement
    tmp=$("#"+id).find("td").children(".dropDownMovement");
    var movement=tmp.parent().find("select").val();


    //Artists
    tmp=$("#"+id).find("td").children(".dropDownArtist");
    var arts=tmp.parent().find("select");


    var artists = [];


    arts.each(function () {
        artists.push($(this).val());
    });

    $.ajax({
        type: "POST",
        url: "exhibits_edit.php",
        dataType: "html",
        data: {
            id: id,
            exhibit : exhibit,
            year: year,
            exhibition: exhibition,
            movement: movement,
            artists:artists
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

$(document).on('click', '.add_select', function()
{
    var parent = $(this).parent();
    (parent.find("select")).first().clone().appendTo(parent);
    $(this).clone().appendTo(parent);
    parent.append("<input type='button' class='remove_select'/>");
});

$(document).on('click', '.remove_select', function()
{
    ($(this).prevAll("select")).first().remove();
    ($(this).prevAll(".add_select")).first().remove();
    $(this).remove();
});



function hide_editing(id)
{
    //Year
    var year=$("#"+id).find("td").children(".editTextYear");
    year.show();
    year.parent().find("input").remove();

    //Exhibition
    var exhibition=$("#"+id).find("td").children(".dropDownExhibition");
    exhibition.show();
    exhibition.parent().find("select").remove();

    //Movement
    var movement=$("#"+id).find("td").children(".dropDownMovement");
    movement.show();
    movement.parent().find("select").remove();

    //Exhibit
    var exhibit=$("#"+id).find("td").children(".editTextExhibit");
    exhibit.show();
    exhibit.parent().find("input").remove();

    //Artists
    var artist=$("#"+id).find("td").children(".dropDownArtist");
    artist.show();
    artist.parent().find(".dd").remove();
    artist.parent().find("input").remove();
}



$(document).on('click', '.no_fav', function(){

        var button= $(this);

        var id = button.parent().parent().attr('id');



        $.ajax({
        type: "GET",
        url: "add_favourites.php",
        dataType: "html",
        data: {
            id : id
        },
        success: function(response){

            button.siblings().remove();
            button.parent().append('<span>1</span><input type="button" class="fav"/>');
            button.remove();
            $("#myTable").trigger('update');
        }

        });

       
});

$(document).on('click', '.fav', function(){

        var button= $(this);

        var id = button.parent().parent().attr('id');



        $.ajax({
        type: "GET",
        url: "remove_favourites.php",
        dataType: "html",
        data: {
            id : id
        },
        success: function(response){
            button.siblings().remove();
            button.parent().append('<span>0</span><input type="button" class="no_fav"/>');
            button.remove();
            $("#myTable").trigger('update');
        }

        });

       
});

