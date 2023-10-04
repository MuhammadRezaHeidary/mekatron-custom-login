<?php
global $title;
$col_color = $mekatron_custom_login_options['column_color'] ?? '';
$background = $mekatron_custom_login_options['background'] ?? '';
$css_code = $mekatron_custom_login_options['css_code'] ?? '';

?>
<h1 id="headlinethatchanges"><?php echo $title;?></h1>
<form action="" method="post">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row">
                    <label for="col-color">Color</label>
                </th>
                <td>
                    <input type="text" name="column_color" id="col-color" value="<?php echo esc_attr($col_color); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="background">Background</label>
                </th>
                <td>
                    <input type="url" name="background" id="background" style="width: 600px" value="<?php echo esc_url($background); ?>">
                    <button type="button" class="button button-add-media" id="background-selector">Select</button>
                    <p style="height: 5px"></p>
                    <img src="<?php echo esc_url($background); ?>" alt="selected-background" style="width: 600px; height: auto;" id="background-preview">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="css_code">Custom CSS</label>
                </th>
                <td>
                    <textarea type="text" name="css_code" id="css_code" placeholder="Type CSS Code here..." style="direction: ltr; resize: none;"><?php echo esc_textarea($css_code); ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="submit">
        <button class="button button-primary" style="width: 99%; height: 50px; font-size: 20px;">Save</button>
    </p>
</form>

