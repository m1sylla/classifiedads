$(function() {

    var _URL = window.URL || window.webkitURL;
    // ad photos
    var $more_photo = 0;

    // ad photos form data
    var adPhotosData = new FormData();



    $(document).on('click', 'button#morePhotos', function() {
        $more_photo++;
        if ($more_photo == 1) {
            $("div#preview_image_div:nth-child(4)").css("display", "inline-block");
            $("div#preview_image_div:nth-child(5)").css("display", "inline-block");
            $("div#preview_image_div:nth-child(6)").css("display", "inline-block");
        } else if ($more_photo == 2) {
            $("div#preview_image_div:nth-child(7)").css("display", "inline-block");
            $("div#preview_image_div:nth-child(8)").css("display", "inline-block");
            $("div#preview_image_div:nth-child(9)").css("display", "inline-block");
            $("div#preview_image_div:nth-child(10)").css("display", "inline-block");
            $("div#preview_image_div:nth-child(11)").css("display", "inline-block");
            $("div#preview_image_div:nth-child(12)").css("display", "inline-block");
            $("#morePhoto").css("display", "none");
        }

    });


    $("#preview_image_div input").change(function(e) {

        // get number
        var str = $(this).attr("id");

        var preview_photo = "preview-photo" + str.substring(8);
        var rotate_photo = "rotate-photo" + str.substring(8);

        var imgPath = $(this)[0].value;
        var imgFile = $(this)[0].files[0];

        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if (extn == "png" || extn == "jpg" || extn == "jpeg") {
            var outputImage = document.getElementById(preview_photo);
            //outputImage.src = _URL.createObjectURL(imgFile);
            var rotate_photo_show = document.getElementById(rotate_photo);
            rotate_photo_show.classList.add("d-inline-block");

            /* resize photo */
            //create a FileReader
            var fileReader = new FileReader();
            //image turned to base64-encoded Data URI.
            fileReader.readAsDataURL(imgFile);
            fileReader.name = imgFile.name; //get the image's name
            fileReader.size = imgFile.size; //get the image's size 
            fileReader.onload = function(readerEvent) {
                    var img = new Image(); //create a image
                    img.src = readerEvent.target.result; //result is base64-encoded Data URI
                    img.name = readerEvent.target.name; //set name (optional)
                    img.size = readerEvent.target.size; //set size (optional)
                    img.onload = function() { //outputImage

                        var canvas = document.createElement("canvas");
                        var ctx = canvas.getContext("2d");

                        var MAX_WIDTH = 760;
                        var MAX_HEIGHT = 500;
                        var width = img.width; //outputImage.naturalWidth;
                        var height = img.height; //outputImage.naturalHeight;
                        //console.log(width + " " + height);

                        if (width > height) {
                            if (width > MAX_WIDTH) {
                                var steps = Math.ceil(Math.log(width / MAX_WIDTH) / Math.log(2));
                                height *= MAX_WIDTH / width;
                                height = Math.round(height);
                                width = MAX_WIDTH;
                            } else {
                                var steps = 0;
                            }
                        } else {
                            if (height > MAX_HEIGHT) {
                                var steps = Math.ceil(Math.log(height / MAX_HEIGHT) / Math.log(2));
                                width *= MAX_HEIGHT / height;
                                width = Math.round(width);
                                height = MAX_HEIGHT;
                            } else {
                                var steps = 0;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;

                        if (steps > 0) {
                            // step 1 - resize to 50%
                            var oc = document.createElement('canvas'),
                                octx = oc.getContext('2d');


                            oc.width = img.width * 0.5;
                            oc.height = img.height * 0.5;
                            octx.drawImage(img, 0, 0, oc.width, oc.height);

                            //ctx.drawImage(oc, 0, 0, oc.width, oc.height, 0, 0, width, height);
                            ctx.drawImage(oc, 0, 0, width, height);
                        } else {
                            ctx.drawImage(img, 0, 0, width, height);
                        }

                        //get the base64-encoded Data URI from the resize image
                        var dataUrl = canvas.toDataURL('image/jpeg');

                        var resizedImage = dataURLToBlob(dataUrl);
                        // append to formdata
                        adPhotosData.append('photo' + str.substring(8), resizedImage);
                        //assign it to thumb src
                        //outputImage.src = _URL.createObjectURL(resizedImage);
                        outputImage.src = dataUrl;

                        //blobImage.src = _URL.createObjectURL(resizedImage);

                        //console.log(resizedImage.size + " " + resizedImage.type);

                    }

                }
                /* end resize photo */

        } else {
            alert("Extention non permise");
        }

    });
    // end ad photos


    /*$(window).on('resize', function() {
        var adDetailW = $('#adDetailCarousel > .carousel-inner').width();
        var adDetailH = $('#adDetailCarousel > .carousel-inner').height();
        console.log(adDetailW + ' ' + adDetailH);
    });*/


    /* Utility function to convert a canvas to a BLOB */
    var dataURLToBlob = function(dataURL) {
            var BASE64_MARKER = ';base64,';
            if (dataURL.indexOf(BASE64_MARKER) == -1) {
                var parts = dataURL.split(',');
                var contentType = parts[0].split(':')[1];
                var raw = parts[1];

                //return new Blob([uInt8Array], { type: text / plain });
                return new Blob([raw], { type: contentType });
            }

            var parts = dataURL.split(BASE64_MARKER);
            var contentType = parts[0].split(':')[1];
            var raw = window.atob(parts[1]);
            var rawLength = raw.length;

            var uInt8Array = new Uint8Array(rawLength);

            for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            //return new Blob([uInt8Array], { type: text / plain });
            return new Blob([uInt8Array], { type: contentType });
        }
        /* End Utility function to convert a canvas to a BLOB      */

    /** send photos ***/
    $("#form-ad-photos button[name='submit']").click(function() {
        //var submit_type = $(this).val();
        adPhotosData.append('submit', $(this).val());
        adPhotosData.append('annonce_id', $("#form-ad-photos input[id='annonce_id']").val());
        // max photos to upload
        for (let index = 1; index <= 12; index++) {
            var rotate = 'rotate' + index;
            adPhotosData.append('rotate' + index, $("#form-ad-photos #" + rotate).val());

        }
        var xhr = new XMLHttpRequest();
        var set_token = document.querySelector('meta[name="csrf-token"]').content;

        xhr.open('POST', '/annonce/photo/create', true);
        //xhr.responseType = 'blob';
        //xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        xhr.setRequestHeader('X-CSRF-TOKEN', set_token);
        xhr.send(adPhotosData);

        xhr.onload = function() {
            if (xhr.status != 200) { // HTTP error?
                // handle error
                return;
            }
            window.location.href = xhr.responseText;
        };

        xhr.onerror = function() {
            alert(`Erreur de réseau`);
        };
        // end Send to server
    });
    /** end send photos */

    /* rotate photo */
    $("img[name='rotateImage']").click(function() {

        var id = $(this).attr('id').substring(12);
        var preview_photo_rotate = "#preview-photo" + id;
        var rotate_photo = "#rotate" + id;

        var rotation_angle = (parseInt($(rotate_photo).val()) + 90) % 360;

        $(preview_photo_rotate).css({
            '-webkit-transform': 'rotate(' + rotation_angle + 'deg)',
            '-moz-transform': 'rotate(' + rotation_angle + 'deg)',
            '-ms-transform': 'rotate(' + rotation_angle + 'deg)',
            'transform': 'rotate(' + rotation_angle + 'deg)'
        });
        $(rotate_photo).val(rotation_angle);

    });
    /* end rotate photo */

    //active profile link
    $("div#profile-link-active [href]").each(function() {
        //var link_loc = window.location.protocol + "//" + window.location.hostname + window.location.pathname;
        var link_loc = window.location.pathname;
        if ($(this)[0].pathname == link_loc) {
            $(this).addClass("a-active-blue");
            $(this).removeClass("a-grey");
        }
    });

    // checkbox custom icon
    $.fn.checkBoxIcon = function() {
        this.click(function() {
            if ($(this).siblings(":checkbox").prop("checked") == true) {
                $(this).siblings(":checkbox").prop("checked", false);
                $(this).toggleClass("fa-check-square");
                $(this).toggleClass("fa-square-o");

            } else {
                $(this).siblings(":checkbox").prop("checked", true);
                $(this).toggleClass("fa-square-o");
                $(this).toggleClass("fa-check-square");

            }
        });
    }

    $("#pub_from_yetecan").checkBoxIcon();
    $("#pub_from_partner").checkBoxIcon();

    // send message to seller box
    $("button[name='send_message_to_seller_btn']").click(function() {
        //$("#send_message_to_seller").slideDown(1000);
        $("#send_message_to_seller").show(1000);
        $('html, body').animate({
            scrollTop: parseInt($("#send_message_to_seller").offset().top)
        }, 1000);
    });


    // mark ad as favourite
    $.fn.addToFavourites = function(annonceid) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '/annonce/favourite/add',
            data: { 'annonceid': annonceid },
            //contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            cache: false,
            success: function() {
                $('#addfavourite' + annonceid).hide();
                $('#deletefavourite' + annonceid).show();
            },
            error: function(xhr) {
                if (xhr.status == 401) {
                    $('#authLinksModal').modal('show');
                }
            }
        });
    }

    // unmark ad as favourite
    $.fn.deleteFromFavourites = function(annonceid) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/annonce/favourite/delete',
            data: { 'annonceid': annonceid },
            //contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            cache: false,
            success: function() {
                $('#deletefavourite' + annonceid).hide();
                $('#addfavourite' + annonceid).show();
            },
            error: function(xhr) {
                if (xhr.status == 401) {
                    $('#authLinksModal').modal('show');
                }
            }
        });
    }

    //unfavorite ad
    $("button[name='deletefavourite']").click(function() {
        var annonceid = $(this).attr('value');
        $.fn.addToFavourites(annonceid);
    });
    // fav ad
    $("button[name='addfavourite']").click(function() {
        var annonceid = $(this).attr('value');
        $.fn.deleteFromFavourites(annonceid);
    });


    // voir numero
    $("button#voirUserNumero").click(function() {

        $(this).children("span").toggle();
    });


    // remove ad from favourite
    $.fn.removeFromFavList = function(annonceid) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/annonce/favourite/remove',
            data: { 'annonceid': annonceid },
            //contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            cache: false,
            success: function(response) {
                // hide from list
                $('#removefromfavlist' + annonceid).closest(".card").hide();

            },
            error: function(xhr, status, error) {
                // handle error
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                alert('Echec!');
            }
        });
    }

    // remove from fav list
    $("button[name='removeFromFavourite']").click(function() {
        var annonceid = $(this).attr('value');
        $.fn.removeFromFavList(annonceid);

    });


    /** delete ad ***/
    $("button[name='deleteAd']").click(function() {
        var annonceid = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/profile/ad/delete',
            data: { 'annonceid': annonceid },
            dataType: 'json',
            cache: false,
            success: function(response) {
                // hide from list
                $('#deleteAd' + annonceid).closest(".row").hide();

            },
            error: function(xhr, status, error) {
                // handle error
                //console.log('Failed ' + xhr.status);
            }
        });

    });
    /** end delete ad */

    /** filter1 ads */
    $(document).mouseup(function(e) {
        var container = $(".filter1 #sortBy");
        var containerH = $(".filter1 #sortBy #sortBymenu");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            containerH.hide();
        }
    });
    $(".filter1 #sortBy #sortBymenutoggle").click(function() {
        $(".filter1 #sortBy #sortBymenu").toggle();
    });

    /** end filter1 ads */


});