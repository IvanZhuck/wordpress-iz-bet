<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
        <?php
            settings_fields('iz_bet');
            do_settings_sections('iz-bet-settings');
            submit_button('Save Settings');
        ?>
    </form>
</div>