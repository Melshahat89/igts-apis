$(document).ready(function () {

    $("#submit_form").click(function () {
        // clear all disply hidden div
        $('.autocomplete_results_get').html('');

        $("#Users-form").submit();
    });



    if ($('.ps_avatar').hasClass('avatar_rotation')) {
        $('.ps_avatar, .ps_avatar_border').css({opacity: 0, scale: 0, rotate: '-360deg'}).transit({opacity: 1, scale: 1, rotate: '0deg'}, 800)
        $('.ps_update').css({opacity: 0}).delay(1000).animate({opacity: 1}, 1000);
    }


$('#new_avatar').click(function() {

        $('input#avatar_input').click()

    })

    //Check File API support
    if (window.File && window.FileList && window.FileReader)
    {

        var AvatarInput = document.getElementById("avatar_input");

        AvatarInput.addEventListener("change", function(event) {

            var avatar = event.target.files; //FileList object
            for (var x = 0; x < avatar.length; x++)
            {
                var get_avatar = avatar[x];

                //Only pics
                if (!get_avatar.type.match('image'))
                    continue;

                var avatarReader = new FileReader();


                avatarReader.addEventListener("load", function(event) {

                    var avatarFile = event.target;

                    var image = '<img src="' + avatarFile.result + '" width="100" height="100" class="rounded">';
                    
                    $('#profimage').val(avatarFile.result); //Edit By Amer
					
                    
				//$('#CimagProf').css('background-image',avatarFile.result);
				//	alert(avatarFile.result)
                   $('.avatar_img').html(image);
				   
					

                    var avatar_position = $('.ps_avatar').offset().top;

                    $('.ps_avatar > img').each(function(i, item) {
                        var img_height = $(item).height();
                        var div_height = $(item).parent().height();
                        if (img_height < div_height) {
                            //INCREASE HEIGHT OF IMAGE TO MATCH CONTAINER
                            $(item).css({'width': 'auto', 'height': div_height});
                            //GET THE NEW WIDTH AFTER RESIZE
                            var img_width = $(item).width();
                            //GET THE PARENT WIDTH
                            var div_width = $(item).parent().width();
                            //GET THE NEW HORIZONTAL MARGIN
                            var newMargin = (div_width - img_width) / 2 + 'px';
                            //SET THE NEW HORIZONTAL MARGIN (EXCESS IMAGE WIDTH IS CROPPED)
                            $(item).css({'margin-left': newMargin});
                        } else {
                            //CENTER IT VERTICALLY (EXCESS IMAGE HEIGHT IS CROPPED)
                            var newMargin = (div_height - img_height) / 2 + 'px';
                            $(item).css({'margin-top': newMargin});
                        }
                    });

                    $('html, body').animate({
                        scrollTop: avatar_position
                    }, 1000);

                });

                avatarReader.readAsDataURL(get_avatar);
            }

        });

    }
    else
    {
        console.log("Your browser does not support File API");
    }
    
    
//    navItems();

//    accountSet();
//
//    accountDtails();
//    fakeRadio(); //Added By Amer



})



