<!-- Masthead -->
<header class="masthead">
    <div class="container h-100">
        <!-- Row for vertical alignment -->
        <div class="row h-100 align-items-center justify-content-center text-center">
            <!-- Column to contain masthead content -->
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                <!-- Masthead title -->
                <h1 class="text-uppercase text-white font-weight-bold">About Us</h1>
                <!-- Divider line -->
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<!-- Page Section -->
<section class="page-section">
    <div class="container">
        <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>
        <!-- PHP code to display dynamic content -->
    </div>
</section>