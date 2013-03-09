<select name="cities" id="required" style="font-family:tahoma,sans-serif,arial; font-size:12px; font-weight:bold;">
<option value="">- Select City -</option>
<?php
foreach($select_region as $region_data_info)
{
?>
<option value="<?php echo $region_data_info->id; ?>"><?php echo $region_data_info->city_name; ?></option>
<?php
}
?>
</select>