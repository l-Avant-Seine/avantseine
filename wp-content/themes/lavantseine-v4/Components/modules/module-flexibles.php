<?php 

    if( have_rows('flexible_contents') ):
        while ( have_rows('flexible_contents') ) : the_row();

            $today = date('Y-m-d');


            if( get_row_layout() == 'mod_slide' ): 
                
                $data = array (
                    'posts' => get_sub_field('mod_relations'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'slider',
                    $data
                );


            elseif( get_row_layout() == 'mod_bigtypo' ): 
                
                $data = array (
                    'ancre' => get_sub_field('mod_id'),
                    'title' => get_sub_field('mod_title'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'message',
                    $data
                );

                
            endif; 

        endwhile;
    endif; 
?>