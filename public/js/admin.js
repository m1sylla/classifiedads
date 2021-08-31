//jQuery(function($) {
$(document).ready(function() {

    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
            .parent()
            .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });
    // close icon sidebar
    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
    });

    //confirm delete admin window
    $('.delete-admin').click(function(e) {
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Etes vous sur?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });

    // show cat item's attrs 
    $('#show_subcat_attr select').on('change', function() {
        var subcat_id = this.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajaxSetup({
            statusCode: {
                401: function() {
                    // Redirec the to the login page.
                    window.location.replace('/admin_yetek224/login');
                }
            }
        });

        $.ajax({
            type: 'post',
            url: '/admin_yetec224/show/each_category_attribute',
            data: { 'subcat_id': subcat_id },
            //contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            cache: false,
            success: function(data) {
                var attr_el = '';
                data.forEach(element => {
                    attr_el += "<li class='list-group-item'>" + element.name + "</li>";
                });
                $('#show_subcat_attr .list-group').html(attr_el);
                $('#show_subcat_attr .no-attr').hide();
                $('#show_subcat_attr .list-group').show();
            },
            error: function() {
                alert('Echec!');
            }
        });
    });
    // reset select
    $('#show_subcat_attr select').attr('autocomplete', 'off');

    // gérer region ville
    $('#accordionRegionVille .ville-collapse')
        .on('hidden.bs.collapse', function() {
            $(this)
                .parent()
                .find(".fa-minus")
                .removeClass("fa-minus")
                .addClass("fa-plus");
        });
    $('#accordionRegionVille .ville-collapse')
        .on('shown.bs.collapse', function() {
            $(this)
                .parent()
                .find(".fa-plus")
                .removeClass("fa-plus")
                .addClass("fa-minus");
        });


    // gérer categorie sous-catégorie 
    $('#accordionCategory .category-collapse')
        .on('hidden.bs.collapse', function() {
            $(this)
                .parent()
                .find(".fa-minus")
                .removeClass("fa-minus")
                .addClass("fa-plus");
        });
    $('#accordionCategory .category-collapse')
        .on('shown.bs.collapse', function() {
            $(this)
                .parent()
                .find(".fa-plus")
                .removeClass("fa-plus")
                .addClass("fa-minus");
        });

    // manage ads
    // suspend ad
    $(".manage-ad button[name='suspend_free_ad']").click(function() {
        var annonceid = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/admin_yetec224/annonces/suspend',
            data: { 'annonceid': annonceid },
            dataType: 'json',
            cache: false,
            success: function(response) {
                // hide from list
                $(".manage-ad #free_ad" + annonceid).toggle();
                $(".manage-ad #suspend_ad" + annonceid).toggle();
                //console.log('Done');
            },
            error: function(xhr, status, error) {
                //console.log('Failed ' + xhr.status);
            }
        });

    });
    // end suspend ad

    // delete ad
    $(".manage-ad button[name='delete_ad']").click(function() {
        var annonceid = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/admin_yetec224/annonces/delete',
            data: { 'annonceid': annonceid },
            dataType: 'json',
            cache: false,
            success: function(response) {
                // hide from list
                $(".manage-ad #delete_ad" + annonceid).closest(".manage-ad").hide();
                //console.log('Done');
            },
            error: function(xhr, status, error) {
                //console.log('Failed ' + xhr.status);
            }
        });

    });
    // end delete ad

    // validate ad
    $(".manage-ad button[name='validate_ad']").click(function() {
        var annonceid = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/admin_yetec224/annonces/validate',
            data: { 'annonceid': annonceid },
            dataType: 'json',
            cache: false,
            success: function(response) {
                // hide button
                $(".manage-ad #validate_ad" + annonceid).hide();
                //console.log('Done' + response.rep);
            },
            error: function(xhr, status, error) {
                //console.log('Failed ' + xhr.status);
            }
        });

    });
    // end validate ad
    // end manage ads



    // manage comptes
    // suspend comptes
    $(".manage-compte button[name='suspend_free_compte']").click(function() {
        var compteid = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/admin_yetec224/comptes/suspend',
            data: { 'compteid': compteid },
            dataType: 'json',
            cache: false,
            success: function(response) {
                // hide from list
                $(".manage-compte #free_compte" + compteid).toggle();
                $(".manage-compte #suspend_compte" + compteid).toggle();
                console.log('Done');
            },
            error: function(xhr, status, error) {
                console.log('Failed ' + xhr.status);
            }
        });

    });
    // end suspend compte

    // end manage comptes


    //////
    /*$("#send_region").click(function(e) {

        e.preventDefault();

        form_data = $("form#add_region").serialize()

        $.ajax({
            url: "admin_yetek224/region_create",
            dataType: "json",
            type: "POST",
            success: function() {
                if (data.success !== undefined && data.success === 200) {
                    console.log(data.text);
                }
            }
        });

    });*/

});