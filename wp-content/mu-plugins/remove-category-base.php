<?php
add_filter("category_rewrite_rules", function($rules) {
    global $wp_rewrite;
    $category_rewrite = array();
    $categories = get_categories(array("hide_empty" => false));
    foreach ($categories as $category) {
        $category_nicename = $category->slug;
        if ($category->parent == $category->cat_ID) $category->parent = 0;
        elseif ($category->parent != 0) $category_nicename = get_category_parents($category->parent, false, "/", true) . $category_nicename;
        $category_rewrite["({$category_nicename})/(?:feed/(feed|rdf|rss|rss2|atom)/?$)?$"] = "index.php?category_name=\$matches[1]&feed=\$matches[2]";
        $category_rewrite["({$category_nicename})/(?:page/([0-9]+))?/?$"] = "index.php?category_name=\$matches[1]&paged=\$matches[2]";
    }
    $category_rewrite = array_merge($category_rewrite, $rules);
    return $category_rewrite;
});

add_filter("category_link", function($link) {
    $link = str_replace("/category/", "/", $link);
    return $link;
});

// Fix: regla de alta prioridad para categorias anidadas con padre vacio (editorial/publicaciones)
add_action("init", function() {
    add_rewrite_rule(
        "^editorial/publicaciones/?$",
        "index.php?category_name=editorial/publicaciones",
        "top"
    );
    add_rewrite_rule(
        "^editorial/publicaciones/page/([0-9]+)/?$",
        "index.php?category_name=editorial/publicaciones&paged=\$matches[1]",
        "top"
    );
});
