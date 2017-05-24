<?php
/**
 * The default template for displaying content. Used for seeker tips
 * @package Jobify
 * @since Jobify 1.0
 */
?>
		<ul>
			<?php   
				$user_query = new WP_User_Query( array( 'role' => 'candidate' ,'number' => 3,'order' => 'DESC', 'fields' => 'all') );
				$authors = $user_query->get_results();
				if (!empty($authors)) {
					    
					    // loop through each author
					    foreach ($authors as $author)
					    {
					        // get all the user's data
					        $author_info = get_userdata($author->ID);
					        echo '<li><span><a target="_blank" href="'.site_url().'/job-seekers/quick-view?recruiterid='.$author->ID.'">' . $author_info->first_name . ' ' . $author_info->last_name . '</a></span>:'.get_cimyFieldValue($author->ID,'BEST_INDUSTRY').'</li>';
					    }
					} else {
					    echo '';
					}
				
			?>
		</ul>