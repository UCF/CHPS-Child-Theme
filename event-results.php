<div class="mb-1 grantHide">
<?php 
$terms = get_the_terms( $post->ID , 'unit' );
	foreach ( $terms as $term ) {
	echo '<span class="grant-unit">' . $term->name . '</span>';
} ?>
</div>
<?php 
$getDate = strtotime( get_field('start_date') );
$getTime = strtotime( get_field('start_date') );
?>

<table width="100%" border="0">
  <tbody>
    <tr>
      <td><?php the_title(); ?></td>
      <td><?php echo date('F j, Y', $getDate); ?></td>
      <td><?php echo date('g:i a', $getDate); ?></td>
      <td><a href="<?php the_field('url'); ?>" target="_blank">REGISTER</a></td>
    </tr>
  </tbody>
</table>