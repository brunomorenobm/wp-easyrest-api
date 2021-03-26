 <?php

    /**
     * Plugin Name: Consultas REST simples e diretas
     * Plugin URI: https://github.com/brunomorenobm/wp-easyrest-api
     * Description: Consultas simples para listagem de produtos de forma fácil e direta.
     * Author URI: https://github.com/brunomorenobm
     * Text Domain: wp-easy-rest-api
     * Domain Path: /api
     * License: GPLv2 or later
     * Version: 0.1
     * Text Domain: easy-rest
     * Requires at least: 5.6
     * Requires PHP: 5.6
     */


    add_action('rest_api_init', function () {
        register_rest_route('easy-rest/v1', '/products', array(
            'methods' => 'GET',
            'callback' => 'get_products',
            'permission_callback' => 'permission_callback',
        ));
    });

    function permission_callback($data)
    {
        return true;
    }



    function get_products($data)
    {

        // Read from configuration image size 
        $dbProducts = wc_get_products(array('status' => 'publish', 'limit' => -1));
        $jsonProducts = array();
        header('Content-Type: application/json; charset=UTF-8');

        if (empty($dbProducts)) {
            return null;
        }

        $product_data[] = [];
        $i = 0;
        // Get an instance of the WC_Order object
        foreach ($dbProducts as $product) {
            $product_data[$i]['product_id']       = $product->get_id();
            $product_data[$i]['category_id']     = $product->get_category_ids('view')[0];
            $product_data[$i]['name']         = $product->get_name();
            $product_data[$i]['description'] = $product->get_description();
            $product_data[$i]['price']  = $product->get_price();
            $product_data[$i]['price']  = $product->get_regular_price();
            $product_data[$i]['type'] = $product->get_type();
            $product_data[$i]['status'] = $product->get_status();
            $product_data[$i]['html_image'] = $product->get_image();
            $product_data[$i]['image_croped'] = preg_replace('/(\..{2,4}?$)/i', '-100x100${1}', wp_get_attachment_url($product->get_image_id()));
            $product_data[$i]['image_url'] = wp_get_attachment_url($product->get_image_id());

            if ($product->get_type() == 'variable') {
                $product_data[$i]['variations']  = get_product_variations($product->get_available_variations());
            }

            //$product_data[$i]['data'] = $product->get_data();
            $i++;
        }
        return  $product_data;
    }

    function get_product_variations($variations)
    {
        $variation_data[] = [];
        $i = 0;
        foreach ($variations as $variation) {
            $variation_data[$i]['variation_id'] = $variation['variation_id'];
            $variation_data[$i]['price'] = $variation['display_price'];
            $variation_data[$i]['variation_text'] = array_values($variation['attributes'])[0];
            $i++;
        }
        return $variation_data;
    }

    ?>
