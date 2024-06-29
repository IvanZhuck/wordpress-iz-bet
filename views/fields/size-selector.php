<select name="izbet_options[<?php echo esc_attr($label_for); ?>]">
    <?php foreach ($options as $optionName => $optionValue) : ?>
        <option value="<?php echo esc_attr($optionValue); ?>" <?php echo $optionValue === $value ? 'selected' : '' ?>><?php echo esc_attr($optionName); ?></option>
    <?php endforeach; ?>
</select>
