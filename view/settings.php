<?php
global $title;
$col_color = $mekatron_custom_login_options['column_color'] ?? '';
$background = $mekatron_custom_login_options['background'] ?? '';
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
        </tbody>
    </table>
    <p class="submit">
        <button class="button button-primary">Save</button>
    </p>
</form>

