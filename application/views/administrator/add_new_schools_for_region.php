<table cellpadding="1" cellspacing="0" border="0" id="school"  style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<tr>
<td  style="border: 1px solid dodgerblue;font-size:12px;text-align: center;"><b>Schools</b></td>
<td  style="border: 1px solid dodgerblue;font-size:12px;text-align: center;"><b>Index</b></td>
</tr>
<?php
foreach ($school as $school_data)
{
    $total_count += count($school_data->id);
?>
<tr>
<input type="hidden" name="id[]" value="<?php echo $school_data->id; ?>">
<td style="border: 1px solid dodgerblue;font-size:12px;"><?php echo $school_data->school_name; ?></td>
<td style="border: 1px solid dodgerblue;"><input type="text" size="4" value="0" name="ovitrap_index[]" onKeyPress="return numbersonly(this, event)"></td>
</tr>
<?php
}
?>
<tr>
    <td class="td_top td_bottom td_left td_right" align="left"><input type="submit" class="submits" name="submit" value=" Submit " onclick="return confirm('Are you sure you want to save all the details?');"></td>

</tr>
<input type="hidden" value="<?php echo $total_count; ?>" name="count">
</table>
</form>