$(document).ready(function(){
        $("#myTable").tablesorter({
			widgets: ['zebra'],
			headers: {3: { sorter: false }},
            sortList: [[0,0]]
        	
    	});
});