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

