<div class="mb-1 grantHide">
<?php
// Get a list of terms for this post's custom taxonomy.
$project_depts = get_field( 'unit' );
// Renumber array.
$project_depts = array_values($project_depts);
for($dept_count=0; $dept_count<count($project_depts); $dept_count++) {
	// Each array item is an object. Display its 'name' value.
//echo $project_depts[$dept_count]->name;
	// If there is more than one term, comma separate them.
	if ($dept_count<count($project_depts)-1){
		//echo ', ';
	}
}?>
</div>
<?php 
$getDate = strtotime( get_field('start_date') );
$getTime = strtotime( get_field('start_date') );
?>

<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="50%"><?php the_title(); ?></td>
      <td width="15%"><?php echo date('F j, Y', $getDate); ?> </td>
      <td width="15%"><?php echo date('g:i a', $getDate); ?></td>
      <td width="20%"><a href="<?php the_field('url'); ?>" target="_blank">REGISTER</a></td>
    </tr>
  </tbody>
</table>