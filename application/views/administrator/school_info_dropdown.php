<select name='school_id' id="schools" onchange="showData(this.value)" style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<option value="">-Select School-</option>
<?php
foreach ($school as $school_data)
{
?>
<option value="<?php echo $school_data->id; ?>" ><?php echo $school_data->school_name; ?></option>
<?php
}
echo "</select></td>";
?>
<div id="txtHints"></div>