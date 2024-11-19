<div class="container-fluid">
    <!-- Registration form -->
    <form action="" id="manage-register">
        <!-- Hidden input fields for ID and event ID -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <input type="hidden" name="event_id" value="<?php echo isset($_GET['event_id']) ? $_GET['event_id'] : '' ?>">
        <!-- Full Name field -->
        <div class="form-group">
            <label for="" class="control-label">Full Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <!-- Address field -->
        <div class="form-group">
            <label for="" class="control-label">Address</label>
            <textarea cols="30" rows="2" required="" name="address" class="form-control"><?php echo isset($address) ? $address : '' ?></textarea>
        </div>
        <!-- Email field -->
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
        </div>
        <!-- Contact Number field -->
        <div class="form-group">
            <label for="" class="control-label">Contact #</label>
            <input type="text" class="form-control" name="contact" value="<?php echo isset($contact) ? $contact : '' ?>" required>
        </div>
    </form>
</div>

<script>
    // Initializing datetimepicker
    $('.datetimepicker').datetimepicker({
        format: 'Y/m/d H:i',
        startDate: '+3d'
    });

    // Submit event handler for registration form
    $('#manage-register').submit(function(e){
        e.preventDefault(); // Preventing default form submission
        start_load(); // Showing loading indicator
        $('#msg').html(''); // Clearing any existing messages

        // Sending registration data via AJAX
        $.ajax({
            url: 'admin/ajax.php?action=save_register', // URL for handling registration
            data: new FormData($(this)[0]), // Form data
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp){ // Callback function on success
                if(resp == 1){ // If registration was successful
                    alert_toast("Registration Request Sent.", 'success'); // Showing success message
                    end_load(); // Hiding loading indicator
                    uni_modal("", "register_msg.php"); // Opening registration message modal
                }
            }
        });
    });
</script>
