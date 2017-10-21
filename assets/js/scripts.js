$(function(){

    // PLYR Audio & Video Player
    var player = plyr.setup('#audio_file');

    // 'Add New Audio' Trigger
    $('.add_audio').click(function(e){
        $('#new_file_form').addClass('active');
        e.stopPropagation();
    });

    // Hide New Audio Form if user clicks away
    $(document).on("click", function(e){ $('#new_file_form').removeClass('active') });

    // Prevent click-away hiding if user clicks within new file form
    $('#new_file_form').click(function(e){ e.stopPropagation() });

    // Add new file ajax call
    $("#add_new_file").submit(function(e){
        var formData = new FormData(this);
        $("#errors").hide();
        $("#errors > ul").empty(); // Reset errors
        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function(e){},
            success: function(response) {
                var obj = JSON.parse(response),
                    podcast = obj.podcast,
                    errorMsg = obj.errorMsg,
                    audio_path = obj.audio_path,
                    audio_name = obj.audio_name,
                    audio_file = obj.audio_file;

                if ( typeof errorMsg !== 'undefined' && typeof errorMsg !== null) {
                    $("#errors > ul").append(errorMsg);
                    $("#errors").show();
                    $('#new_file_form').removeClass('active');
                }
                else {
                    var newBtn = $('<button>').attr("data-audio-file", audio_file).html(audio_name),
                        pathname = window.location.pathname;
                    $("#" + podcast).find('.btn_container').append(newBtn);
                    $('#new_file_form').removeClass('active');
                    // window.location.href = pathname + "?podcast=" + podcast;
                }
            }
        });
        return false;
    });

    // Sound Board button click
    var audioBtn = $("#sound_board button");
    $('button').click(function(e){
        
        console.log(e);

        // Local variables
        var podcast = $(this).parents('.container').attr('id'),
            btn_file = $(this).data('audio-file'),
            btn_label = $(this).text(),
            audio_label = $('#now_playing > span'),
            file_path = 'assets/audio/' + podcast + '/' + btn_file;

        var data = {
            "podcast" : podcast,
            "btn_file" : btn_file,
            "btn_label" : btn_label,
            "audio_label" : audio_label,
            "file_path" : file_path
        };

        
        console.log(data);

        // Change player source to selected file
        // player[0].source({
        //     type:       'audio',
        //     title:      btn_label,
        //     sources: [{
        //         src:      file_path,
        //         type:     'audio/mp3'
        //     }]
        // });

        // // Begin playing selected audio
        // player[0].play();

        // // Update 'now playing' text
        // audio_label.text(btn_label);

        // // Update active state on button
        // audioBtn.removeClass('active');
        // $(this).addClass('active');
    });

}); // end ready state