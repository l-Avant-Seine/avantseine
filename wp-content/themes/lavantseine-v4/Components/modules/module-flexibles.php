<?php 

    if( have_rows('modules') ):
        while ( have_rows('modules') ) : the_row();

            $today = date('Y-m-d');


            if( get_row_layout() == 'mod_bigtypo' ): 
                
                $data = array (
                    'ancre' => get_sub_field('mod_id'),
                    'title' => get_sub_field('mod_title'),
                );

                set_query_var( 'design', get_sub_field('mod_design') );
                get_template_part( 
                    'components/modules/module', 
                    'message',
                    $data
                );


            elseif( get_row_layout() == 'mod_bigtypo' ): 
                
                $data = array (
                    'ancre' => get_sub_field('mod_id'),
                    'title' => get_sub_field('mod_title'),
                );

                get_template_part( 
                    'components/modules/module', 
                    'message',
                    $data
                );

                
            endif; 

        endwhile;
    endif; 
?>