<div class="wrap">
    <h2>ChokeLive BotTrackker</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('chokelive_bottrack-group'); ?>
        <?php @do_settings_fields('chokelive_bottrack-group'); ?>

        <?php do_settings_sections('chokelive_bottrack'); ?>

		
        <?php @submit_button(); ?>
    </form>
</div>