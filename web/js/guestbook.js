$(document).ready(function(){

    $("#search_guest").keyup(function() {
        var query = $(this).val();
        $.post( "guests/search", { query:query }, function( data ) {
            $("#search_results").html(data);
        });
    });

});
