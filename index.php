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




   function permission_callback($data)
   {
      return true;
   }



   function get_products($data)
   {

      // Read from configuration image size 
      $dbProducts = wc_get_products(array('status' => 'publish', 'limit' => -1));
      header('Content-Type: application/json; charset=UTF-8');

      if (empty($dbProducts)) {
         return null;
      }

      $product_data[] = [];
      $i = 0;
      // Get an instance of the WC_Order object
      foreach ($dbProducts as $product) {
         $image_id = $product->get_image_id();
         if (is_numeric($image_id) and $image_id > 0) {
            $image_url = wp_get_attachment_url($product->get_image_id());
         } else {
            $image_url = "";
         }
         $product_data[$i]['product_id']       = $product->get_id();
         $product_data[$i]['category_id']     = $product->get_category_ids('view')[0];
         $product_data[$i]['name']         = $product->get_name();
         $product_data[$i]['description'] = $product->get_description();
         $product_data[$i]['price']  = $product->get_price();
         $product_data[$i]['price']  = $product->get_regular_price();
         $product_data[$i]['type'] = $product->get_type();
         $product_data[$i]['status'] = $product->get_status();
         $product_data[$i]['image_url_100x100'] = preg_replace('/(\-scaled)?(\..{2,4}?$)/i', '-100x100${2}', $image_url);
         $product_data[$i]['image_url'] = $image_url;

         if ($product->get_type() == 'variable') {
            $product_data[$i]['variations']  = get_product_variations($product->get_children());
         }


         $i++;
      }
      return  $product_data;
   }

   function get_product_variations($variationIds)
   {
      if ( count($variationIds) == 0) {
         
         return [];
      }
      $variation_data[] = [];
      $i = 0;
      foreach ($variationIds as $variationId) {
         $variation = wc_get_product($variationId);
         $variation_data[$i]['variation_id'] = $variation->get_id();
         $variation_data[$i]['price'] = $variation->get_price();
         $variation_data[$i]['variation_text'] =array_values( $variation->get_attributes())[0];
         $i++;
      }
      return $variation_data;
   }


   function get_orders_by_phone($data)
   {
      $phone = $data['phone'];

      $dbOrders = wc_get_orders(
         array(
            'billing_phone' => $phone,
         )
      );

      if (empty($dbOrders)) {
         return null;
      }


      $order_data[] = [];
      $i = 0;
      // Get an instance of the WC_Order object
      foreach ($dbOrders as $order) {
         $order_data[$i]['date_created'] = (string) $order->get_date_created();
         $order_data[$i]['order_id'] = $order->get_id();
         $order_data[$i]['order_key'] = $order->get_order_key();
         $order_data[$i]['billing_email'] = $order->get_billing_email();
         $order_data[$i]['billing_first_name'] = $order->get_billing_first_name();
         $order_data[$i]['billing_last_name'] = $order->get_billing_last_name();
         $order_data[$i]['billing_address_1'] = $order->get_billing_address_1();
         $order_data[$i]['billing_address_2'] = $order->get_billing_address_2();
         $order_data[$i]['billing_neighborhood'] = $order->get_meta('_billing_neighborhood');
         $order_data[$i]['billing_city'] = $order->get_billing_city();
         $order_data[$i]['billing_state'] = $order->get_billing_state();
         $order_data[$i]['billing_postcode'] = $order->get_billing_postcode();
         $order_data[$i]['billing_country'] = $order->get_billing_country();
         $order_data[$i]['billing_phone'] = $order->get_billing_phone();

         $order_data[$i]['shipping_first_name'] = $order->get_shipping_first_name();
         $order_data[$i]['shipping_last_name'] = $order->get_shipping_last_name();
         $order_data[$i]['shipping_address_1'] = $order->get_shipping_address_1();
         $order_data[$i]['shipping_address_2'] = $order->get_shipping_address_2();
         $order_data[$i]['shipping_neighborhood'] = $order->get_meta('_shipping_neighborhood');
         $order_data[$i]['shipping_city'] = $order->get_shipping_city();
         $order_data[$i]['shipping_state'] = $order->get_shipping_state();
         $order_data[$i]['shipping_postcode'] = $order->get_shipping_postcode();
         $order_data[$i]['shipping_country'] = $order->get_shipping_country();
         $order_data[$i]['shipping_total'] = $order->get_shipping_total();


         $order_data[$i]['payment_method'] = $order->get_payment_method();
         $order_data[$i]['payment_method_title'] = $order->get_payment_method_title();
         $i++;
         // $order_data[$i]['data'] = $order->get_data();
      }

      return $order_data;
   }




   add_action('rest_api_init', function () {
      register_rest_route('easy-rest/v1', '/products', array(
         'methods' => 'GET',
         'callback' => 'get_products',
         'permission_callback' => 'permission_callback',
      ));
      register_rest_route('easy-rest/v1', '/search-orders', array(
         'methods' => 'POST',
         'callback' => 'get_orders_by_phone',
         'args' => array(
            'phone' => array(
               'validate_callback' => 'is_empty'
            ),
         ),
         'permission_callback' => 'permission_callback',
      ));
   });

   ?>