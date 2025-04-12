// Giỏ hàng
$router->get('/webbanhang/Cart/view', 'CartController@view');  // Xem giỏ hàng
$router->post('/webbanhang/Cart/add/{productId}', 'CartController@add');  // Thêm sản phẩm vào giỏ hàng
$router->get('/webbanhang/Cart/remove/{productId}', 'CartController@remove');  // Xóa sản phẩm khỏi giỏ hàng
$router->post('/webbanhang/Cart/update/{productId}', 'CartController@update');  // Cập nhật số lượng sản phẩm
