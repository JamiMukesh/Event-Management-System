<style>
    /* CSS style for modal dialogs of large and mid-large sizes */
    .modal-dialog.large {
        width: 80% !important;
        max-width: unset;
    }
    .modal-dialog.mid-large {
        width: 50% !important;
        max-width: unset;
    }
</style>

<script>
    // Initialize datepicker
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd"
    });

    // Function to show preloader
    window.start_load = function(){
        $('body').prepend('<di id="preloader2"></di>');
    }

    // Function to hide preloader
    window.end_load = function(){
        $('#preloader2').fadeOut('fast', function() {
            $(this).remove();
        });
    }

    // Function to create and display a modal
    window.uni_modal = function($title = '', $url='', $size=''){
        start_load();
        $.ajax({
            url: $url,
            error: err => {
                console.log();
                alert("An error occurred");
            },
            success: function(resp){
                if(resp){
                    $('#uni_modal .modal-title').html($title);
                    $('#uni_modal .modal-body').html(resp);
                    if($size != ''){
                        $('#uni_modal .modal-dialog').addClass($size);
                    } else {
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md");
                    }
                    $('#uni_modal').modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false,
                        focus: true
                    });
                    end_load();
                }
            }
        });
    }

    // Function to create and display a modal on the right side
    window.uni_modal_right = function($title = '', $url=''){
        start_load();
        $.ajax({
            url: $url,
            error: err => {
                console.log();
                alert("An error occurred");
            },
            success: function(resp){
                if(resp){
                    $('#uni_modal_right .modal-title').html($title);
                    $('#uni_modal_right .modal-body').html(resp);
                    $('#uni_modal_right').modal('show');
                    end_load();
                }
            }
        });
    }

    // Function to create and display a modal for viewing images or videos
    window.viewer_modal = function($src = ''){
        start_load();
        var t = $src.split('.');
        t = t[1];
        if(t =='mp4'){
            var view = $("<video src='"+$src+"' controls autoplay></video>");
        } else {
            var view = $("<img src='"+$src+"' />");
        }
        $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove();
        $('#viewer_modal .modal-content').append(view);
        $('#viewer_modal').modal({
            show: true,
            focus: true
        });
        end_load();
    }

    // Function to show toast alert messages
    window.alert_toast = function($msg = 'TEST', $bg = 'success'){
        $('#alert_toast').removeClass('bg-success')
        $('#alert_toast').removeClass('bg-danger')
        $('#alert_toast').removeClass('bg-info')
        $('#alert_toast').removeClass('bg-warning')

        if($bg == 'success')
            $('#alert_toast').addClass('bg-success')
        if($bg == 'danger')
            $('#alert_toast').addClass('bg-danger')
        if($bg == 'info')
            $('#alert_toast').addClass('bg-info')
        if($bg == 'warning')
            $('#alert_toast').addClass('bg-warning')
        $('#alert_toast .toast-body').html($msg)
        $('#alert_toast').toast({delay:3000}).toast('show');
    }

    // Function to load cart items
    window.load_cart = function(){
        $.ajax({
            url: 'admin/ajax.php?action=get_cart_count',
            success: function(resp){
                if(resp > -1){
                    resp = resp > 0 ? resp : 0;
                    $('.item_count').html(resp);
                }
            }
        });
    }

    // Event listener for login button click
    $('#login_now').click(function(){
        uni_modal("LOGIN", 'login.php');
    });

    // Execute when document is ready
    $(document).ready(function(){
        load_cart(); // Load cart items
        $('#preloader').fadeOut('fast', function() {
            $(this).remove();
        });
    });
</script>

<!-- Bootstrap core JS-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
