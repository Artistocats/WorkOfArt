$(document).ready(function(){
        $("#myTable").tablesorter({
			widgets: ['zebra'],
            headers: {4: { sorter: false }},
            sortList: [[0,0]]
        	
    	});
});