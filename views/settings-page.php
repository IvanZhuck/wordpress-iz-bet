<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
        <?php
            settings_fields('izbet');
            do_settings_sections('izbet-settings');
            submit_button(__('Save Settings', 'iz-block-editor-tooltips'));
        ?>
    </form>
</div>