<div class="nobullets pl-3 pb-3" style="font-size:14px !important; border-bottom:1px solid #EBEBEB;">
    <h6 class="mb-1 mt-3"><?php the_title(); ?></h6>
    <div>
        <?php 
        while(has_sub_field('grant_people')):
        $grant_facultymember = get_sub_field( 'grant_faculty' ); 
        ?>
            <li><strong><?php the_sub_field('title'); ?>:</strong> <?php the_sub_field('regular_person'); ?>
            <?php foreach( $grant_facultymember as $post_object): ?>
                <a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a>
            <?php endforeach; ?>
            </li>
        <?php endwhile; ?>
        <strong>Amount:</strong> $<?php echo number_format($money_output, 0, '.', ','); ?><?php if( get_field('grant_start_date')) {  ?>    
            | <strong>Timeframe:</strong> <?php the_field('grant_start_date'); ?> <?php if( get_field('grant_end_date')) {  ?>- <?php the_field('grant_end_date'); ?><?php } ?>
        <?php } ?>
        <div>
            <strong>Categories:</strong> <?php 
        $terms = get_the_terms( $post->ID , 'grant_cats' );
            foreach ( $terms as $term ) {
            echo $term->name;
        } ?>
        </div>
        <div>
            <strong>Funding Agency:</strong> <?php the_field('grant_agency'); ?>
        </div>    	
    </div>
</div>