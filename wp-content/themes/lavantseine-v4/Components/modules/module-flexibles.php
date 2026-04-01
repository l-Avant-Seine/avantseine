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


            elseif( get_row_layout() == 'mod_calendar' ): 
                
                $data = array (
                    'title' => get_sub_field('mod_title'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'calendar',
                    $data
                );


            elseif( get_row_layout() == 'mod_contact' ): 
                
                $data = array (
                    'title_news' => get_sub_field('mod_title_news'),
                    'title_rs' => get_sub_field('mod_title_rs'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'contact',
                    $data
                );
                

            elseif( get_row_layout() == 'mod_largebanner' ): 
                
                $data = array (
                    'wysiwyg' => get_sub_field('mod_wysiwyg'),
                    'label' => get_sub_field('mod_label'),
                    'link' => get_sub_field('mod_link'),
                    'picto' => get_sub_field('mod_picto'),
                    'img' => get_sub_field('mod_img'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'banner',
                    $data
                );


            elseif( get_row_layout() == 'mod_pagealone' ): 
                
                $data = array (
                    'page' => get_sub_field('mod_page'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'pagealone',
                    $data
                );
                
            elseif( get_row_layout() == 'mode_4posts' ): 
                
                $data = array (
                    'relations' => get_sub_field('mod_relations'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'pagescolumns',
                    $data
                );


            endif; 

        endwhile;
    endif; 
?>