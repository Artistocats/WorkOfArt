$(document).ready(function(){
        $("#myTable").tablesorter({
			widgets: ['zebra'],
			headers: {5: { sorter: false }},
            sortList: [[0,0]]
        	
    	});
});

$(document).on('click', '.fav', function()
{
        var r=confirm("Remove this favourite?");
        if (r)
        {
            var id = $(this).parent().parent().attr('id');

            $.ajax({
            type: "GET",
            url: "remove_favourites.php",
            dataType: "html",
            data: {
                id : id
            },
            success: function(response){
                location.reload();
            }

            });
        }

        

       
});