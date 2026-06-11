<?php 
function get_menu_items(){
    global $conn;
    $result = $conn->query("
        SELECT n.*, p.title as page_title
        FROM navigation n
        LEFT JOIN pages p ON n.page_id = p.id
        ORDER BY n.order_priority ASC
    ");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function build_menu_tree($items, $parent_id = null){
    $tree = [];
    foreach($items as $item){
        if($item['parent_id'] == $parent_id){
            $children = build_menu_tree($items, $item['id']);
            if($children){
                $item['children'] = $children;
            }
            $tree[] = $item;
        }
    }
    return $tree;
}
function render_menu($tree) {
    $html = '<ul class="navbar-nav">';
    foreach ($tree as $item) {
        $has_children = !empty($item['children']);
        $html .= '<li class="nav-item' . ($has_children ? ' dropdown' : '') . '">';
        $html .= '<a class="nav-link' . ($has_children ? ' dropdown-toggle' : '') . '" href="' . htmlspecialchars($item['url']) . '" target="' . $item['target'] . '"' . ($has_children ? ' data-bs-toggle="dropdown"' : '') . '>';
        $html .= htmlspecialchars($item['title']);
        $html .= '</a>';
        if ($has_children) {
            $html .= '<ul class="dropdown-menu">';
            foreach ($item['children'] as $child) {
                $html .= '<li><a class="dropdown-item" href="' . htmlspecialchars($child['url']) . '" target="' . $child['target'] . '">' . htmlspecialchars($child['title']) . '</a></li>';
            }
            $html .= '</ul>';
        }
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
?>