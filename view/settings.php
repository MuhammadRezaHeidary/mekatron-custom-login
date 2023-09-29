<?php
global $title;
$col_color = $mekatron_custom_login_options['column_color'] ?? '';
?>
<h1><?php echo $title;?></h1>
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
        </tbody>
    </table>
    <p class="submit">
        <button class="button button-primary">Save</button>
    </p>
</form>

