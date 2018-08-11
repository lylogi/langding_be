<?php 

class GM_Walker extends Walker_Nav_Menu {
    public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output){
        $id = $this->db_fields['id'];
        if(isset($children[$el->$id])){
            $el->classes[] = 'has_children';
        }
        parent::display_element($el, $children, $max_depth, $depth, $args, $output);
    }
    // add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            // 'navi',
            ( $display_depth == 1 ? 'sub_menu' : '' ),
            ( $display_depth == 2 ? 'sub_menu_2' : '' ),
            // 'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
        // build html
        $output .= "\n" . $indent . '<ul class="' . esc_attr($class_names) . '">' . "\n";
    }
    // add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        static $is_first;
        $is_first++;
        // depth dependent classes
        
      
        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        $is_mega_menu = (strpos($class_names,'mega') !== false) ? true : false;
        $use_desc = (strpos($class_names,'use_desc') !== false) ? true : false;
        $is_sidebar = (strpos($class_names,'menu_sidebar') !== false) ? true : false;
        $no_title = (strpos($class_names,'no_title') !== false) ? true : false;
        // build html
        $output .= $indent . '<li class="' . esc_attr($depth_class_names) . '">';
        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="' . (($item->url[0] == "#" && !is_front_page()) ? home_url() : '') . esc_attr($item->url) .'"' : '';

        $html_output = ($use_desc) ? '<div class="description_menu_item">'.wp_kses($item->description, allowed_tags()).'</div>' : '';
        if ($is_sidebar) {
            ob_start();
            dynamic_sidebar($item->description);
            $sidebar_html = ob_get_clean();
            $sidebar_output = '<div class="sidebar_menu_item">'.$sidebar_html.'</div>';
            $item_output = $sidebar_output;
        } else{
            $item_output = (!$no_title) ? '<a ' . $attributes . '>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</a>'. $html_output : $html_output;
        }
        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ).(($is_mega_menu)?'<div class="sf-mega"><div class="sf-mega-inner clearfix">':'');
    }
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        $is_mega_menu = (strpos($class_names,'mega') !== false) ? true : false;
        $output .= (($is_mega_menu)?'</div></div>':'') . "</li>\n";
    }
}


class GM_Mobile_Walker extends Walker_Nav_Menu {
    public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output){
        $id = $this->db_fields['id'];
        if(isset($children[$el->$id])){
            $el->classes[] = 'has_children';
        }
        parent::display_element($el, $children, $max_depth, $depth, $args, $output);
    }
    // add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            // 'navi',
            ( $display_depth == 1 ? 'sub-menu' : '' ),
            ( $display_depth == 2 ? 'has-sub' : '' ),
            // 'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
        // build html
        $output .= "\n" . $indent . '<ul class="' . esc_attr($class_names) . '">' . "\n";
    }
    // add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        static $is_first;
        $is_first++;
        // depth dependent classes
        $depth_classes = array(
            ( $depth == 1 ? 'has-sub' : '' ),
            // ( $is_first == 1 ? 'menu-first' : '' ),
            // 'menu-item-depth-' . $depth
        );
        
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        $is_mega_menu = (strpos($class_names,'mega') !== false) ? true : false;
        $use_desc = (strpos($class_names,'use_desc') !== false) ? true : false;
        $is_sidebar = (strpos($class_names,'menu_sidebar') !== false) ? true : false;
        $no_title = (strpos($class_names,'no_title') !== false) ? true : false;
        // build html
        $output .= $indent . '<li class="' . esc_attr($depth_class_names) . '">';
        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="' . (($item->url[0] == "#" && !is_front_page()) ? home_url() : '') . esc_attr($item->url) .'"' : '';

        $html_output = ($use_desc) ? '<div class="description_menu_item">'.wp_kses($item->description, allowed_tags()).'</div>' : '';
        if ($is_sidebar) {
            ob_start();
            dynamic_sidebar($item->description);
            $sidebar_html = ob_get_clean();
            $sidebar_output = '<div class="sidebar_menu_item">'.$sidebar_html.'</div>';
            $item_output = $sidebar_output;
        } else{
            $item_output = (!$no_title) ? '<a ' . $attributes . '>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</a>'. $html_output : $html_output;
        }
        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ).(($is_mega_menu)?'<div class="sf-mega"><div class="sf-mega-inner clearfix">':'');
    }
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        $is_mega_menu = (strpos($class_names,'mega') !== false) ? true : false;
        $output .= (($is_mega_menu)?'</div></div>':'') . "</li>\n";
    }
}