<div class="container-fluid">
    <!-- Form for managing book -->
    <form action="" id="manage-book">
        <!-- Hidden input fields for book ID and venue ID -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
        <input type="hidden" name="venue_id" value="<?php echo isset($_GET['venue_id']) ? $_GET['venue_id'] :'' ?>">
        
        <!-- Input field for Full Name -->
        <div class="form-group">
            <label for="" class="control-label">Full Name</label>
            <input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
        </div>
        
        <!-- Input field for Address -->
        <div class="form-group">
            <label for="" class="control-label">Address</label>
            <textarea cols="30" rows="2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
        </div>
        
        <!-- Input field for Email -->
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            <input type="email" class="form-control" name="email"  value="<?php echo isset($email) ? $email :'' ?>" required>
        </div>
        
        <!-- Input field for Contact Number -->
        <div class="form-group">
            <label for="" class="control-label">Contact #</label>
            <input type="text" class="form-control" name="contact"  value="<?php echo isset($contact) ? $contact :'' ?>" required>
        </div>
        
        <!-- Input field for Duration -->
        <div class="form-group">
            <label for="" class="control-label">Duration</label>
            <input type="text" class="form-control" name="duration"  value="<?php echo isset($duration) ? $duration :'' ?>" required>
        </div>
        
        <!-- Input field for Desired Event Schedule -->
        <div class="form-group">
            <label for="" class="control-label">Desired Event Schedule</label>
            <input type="text" class="form-control datetimepicker" name="schedule"  value="<?php echo isset($schedule) ? $schedule :'' ?>" required>
        </div>
    </form>
</div>

<script>
    // Initialize datetimepicker
    $('.datetimepicker').datetimepicker({
        format: 'Y/m/d H:i',
        startDate: '+3d'
    });

    // Handle form submission
    $('#manage-book').submit(function(e){
        e.preventDefault(); // Prevent default form submission
        start_load(); // Show loading indicator
        $('#msg').html(''); // Clear any existing messages

        // Perform AJAX request
        $.ajax({
            url: 'admin/ajax.php?action=save_book',
            data: new FormData($(this)[0]), // Form data
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                if(resp == 1){
                    // Show success message
                    alert_toast("book Request Sent.", 'success');
                    end_load(); // Hide loading indicator
                    uni_modal("", "book_msg.php"); // Show additional message
                }
            }
        });
    });
</script>
