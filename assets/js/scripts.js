$(function(){

    // PLYR Audio & Video Player
    plyr.setup();

    // 'Add New Audio' Trigger
    $('.add_audio').click(function(e){
        $('#new_file_form').addClass('active');
        e.stopPropagation();
    });

    // Hide New Audio Form if user clicks away
    $(document).on("click", function(e){ $('#new_file_form').removeClass('active') });

    // Prevent click-away hiding if user clicks within new file form
    $('#new_file_form').click(function(e){ e.stopPropagation() });

    $(".add_file_submit").click(function(e){e.preventDefault()});

}); // end ready state