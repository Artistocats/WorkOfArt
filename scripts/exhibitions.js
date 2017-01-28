function show_confirm(del)
{
	var r=confirm("Are you sure that you want to delete this exhibition?");
	if (r)
		window.location.href=del;

}

$(document).ready(function(){
        $("#myTable").tablesorter({
			widgets: ['zebra'],
			headers: {4: { sorter: false },5: { sorter: false },6: { sorter: false }},
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

        //Year
        var year=$("#"+id).find("td").children(".editTextYear");

        txt=year.text();
        year.hide();
        year.parent().append("<input type='text' size='4' value='"+ txt +"' />");


        //Country
        var country=$("#"+id).find("td").children(".dropDownCountry");
        ctext=country.text();
        country.hide();

 

        $.ajax({
            url: "country_list.html",
            success: function (data) 
            { 
                country.parent().append("<span class='dd'>" +data+"</span>");
                country.parent().find("select").val(ctext).change();
            },
            dataType: "html"
        });

        //City
        var city=$("#"+id).find("td").children(".editTextCity");

        txt=city.text();
        city.hide();
        city.parent().append("<input type='text' value='"+ txt +"' />");

        //Street
        var street=$("#"+id).find("td").children(".editTextStreet");

        txt=street.text();
        street.hide();
        street.parent().append("<input type='text' value='"+ txt +"' />");

        //Year
        var number=$("#"+id).find("td").children(".editTextNum");

        txt=number.text();
        number.hide();
        number.parent().append("<input type='text' size='4' value='"+ txt +"' />");

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

    //Year
    tmp=$("#"+id).find("td").children(".editTextYear");
    var year=tmp.parent().find("input").val();

    //Country
    tmp=$("#"+id).find("td").children(".dropDownCountry");
    var country=tmp.parent().find("select").val();

    //City
    tmp=$("#"+id).find("td").children(".editTextCity");
    var city=tmp.parent().find("input").val();

    //Street
    tmp=$("#"+id).find("td").children(".editTextStreet");
    var street=tmp.parent().find("input").val();

    //Number
    tmp=$("#"+id).find("td").children(".editTextNum");
    var number=tmp.parent().find("input").val();


    $.ajax({
        type: "POST",
        url: "exhibitions_edit.php",
        dataType: "html",
        data: {
        	id: id,
            name : name,
            year: year,
            country: country,
            city: city,
            street: street,
            number: number
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
    var year=$("#"+id).find("td").children(".editTextYear");
    year.show();
    year.parent().find("input").remove();

    //Country
    var country=$("#"+id).find("td").children(".dropDownCountry");
    country.show();
    country.parent().find("select").remove();

    //City
    var city=$("#"+id).find("td").children(".editTextCity");
    city.show();
    city.parent().find("input").remove();

    //Street
    var street=$("#"+id).find("td").children(".editTextStreet");
    street.show();
    street.parent().find("input").remove();

    //Number
    var number=$("#"+id).find("td").children(".editTextNum");
    number.show();
    number.parent().find("input").remove();



}
