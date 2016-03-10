<?php

$total_pages = $posts->max_num_pages;  
if ($total_pages > 1){  
	$current_page = max(1, get_query_var('paged')); 
	$permalink_structure = get_option('permalink_structure');
	$format = empty( $permalink_structure ) ? '&paged=%#%' : 'page/%#%/'; 

	echo '<div id="blog_pagination" class="pagination pagination-centered clearfix">';   
	echo paginate_links(array(  
		'base' => get_pagenum_link(1) . '%_%',  
		'format' => $format, 
		'current' => $current_page,  
		'total' => $total_pages,  
		'prev_text' => '<i class="icon-chevronleft"></i>',
		'next_text' => '<i class="icon-chevronright"></i>',
		'type' => 'plain',  
	));  
	echo '</div>';  
} 
