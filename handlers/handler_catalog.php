<?php
    include($_SERVER['DOCUMENT_ROOT'].'/parts/header_conf.php');

    $response = [
        'products' => [],
        'pagination' => [
            'count' => 0,
            'active' => 0
        ]
    ];


    // Логика рассчета данных для пагинации
    $limit_products = 8;
    $pagination_active = (int) $_GET['active'];

    if (!empty($_GET['filter_type'])) {
        $filter_type = $_GET['filter_type'];
        $query_filter_type = " AND products.type = '$filter_type' ";
    } else {
        $query_filter_type = "";
    }

    $query_filter_size = "";
    if (!empty($_GET['filter_size'])) {
        $filter_size = $_GET['filter_size'];
        $_SESSION['filter']['size'] = $filter_size;
        $product_has_size = [];
        
        $query_all_sizes = "SELECT * FROM product_sizes";
        $result_all_sizes = mysqli_query($link, $query_all_sizes);

        while ($row = mysqli_fetch_assoc($result_all_sizes)) {
            if (strpos ( $row['product_sizes'] , $filter_size) != false) {
                $product_has_size[] = $row['product_id'];
            };
        }
        if ($product_has_size != []) {
            $product_has_size_str = '('.implode ( ', ' , $product_has_size).')';
            $query_filter_size = " AND products.id IN $product_has_size_str ";
        } else {
            $query_filter_size = " AND products.id = false ";
        }

    } 
    
    if (!empty($_GET['filter_price'])) {
        $price_range_arr = explode('-', $_GET['filter_price']);
        $price_range_min = $price_range_arr[0];
        $price_range_max = $price_range_arr[1];
        $query_filter_price = " AND products.price BETWEEN $price_range_min AND $price_range_max ";
    } else {
        $query_filter_price = "";
    }

    if ($_GET['category_id'] != 4) {
        $sql_all_products = "SELECT products.* FROM products
        INNER JOIN product_category ON products.id = product_category.product_id 
        WHERE product_category.category_id={$_GET['category_id']}".$query_filter_type.$query_filter_price.$query_filter_size;
    } else {
        $sql_all_products = "SELECT * FROM products WHERE TIMESTAMPDIFF (HOUR, add_date, NOW()) < $product_remain_new ".$query_filter_type.$query_filter_price.$query_filter_size."ORDER BY add_date";
    }

    $result_all_products = mysqli_query($link, $sql_all_products);
    $count_products = mysqli_num_rows($result_all_products);
    $pagination_count = ceil($count_products / $limit_products); // ceil - округление числа в большую сторону

    $response['pagination']['count'] = $pagination_count;
    $response['pagination']['active'] = $pagination_active;
    if (!empty($filter_type)) {
        $response['type'] = $filter_type;
    } else {
        $response['type'] = '';
    }
    if (!empty($filter_size)) {
        $response['size'] = $filter_size;
    } else {
        $response['size'] = '';
    }

    $start_limit = ($pagination_active - 1) * $limit_products;

    if ($_GET['category_id'] != 4) {
        $sql_products = $sql_all_products . " LIMIT {$start_limit}, {$limit_products}";
    } else {
        $sql_products = $sql_all_products . " DESC LIMIT {$start_limit}, {$limit_products}";
    }


    $result_products = mysqli_query($link, $sql_products);

    while($row = mysqli_fetch_assoc($result_products)) {
        $response['products'][] = $row;
    }

    sleep(1);
    echo json_encode($response);
