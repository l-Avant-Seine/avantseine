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
                    'context' => '',
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
                    'title' => get_sub_field('mod_title'),
                    'label' => get_sub_field('mod_label'),
                    'link' => get_sub_field('mod_link'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'pagescolumns',
                    $data
                );


            elseif( get_row_layout() == 'mod_magazine' ): 
                
                $data = array (
                    'title' => get_sub_field('mod_title'),
                    'simple' => get_sub_field('mod_simpledisplay'),
                    'relations' => get_sub_field('mod_relations'),
                    'auto' => get_sub_field('mod_auto_relations'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'magazine',
                    $data
                );


            elseif( get_row_layout() == 'mod_spectacles' ): 
                
                $data = array (
                    'title' => get_sub_field('mod_title'),
                    'relations' => get_sub_field('mod_relations'),
                    'by_tags' => get_sub_field('mod_tags_relationnels'),
                    'label' => get_sub_field('mod_label'),
                    'link' => get_sub_field('mod_links'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'spectacles',
                    $data
                );


            elseif( get_row_layout() == 'mod_visuels' ): 
                
                $data = array (
                    'title' => get_sub_field('mod_title'),
                    'visuels' => get_sub_field('mod_visuels'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'visuels',
                    $data
                );
         

            elseif( get_row_layout() == 'mod_twocols' ): 
                
                $data = array (
                    'title' => get_sub_field('mod_title'),
                    'intro' => get_sub_field('mod_intro'),
                    'left' => get_sub_field('mod_left'),
                    'right' => get_sub_field('mod_right'),
                );

                get_template_part( 
                    'Components/modules/module', 
                    'twocols',
                    $data
                );

            endif; 

        endwhile;
    endif; 
?>