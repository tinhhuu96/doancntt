<?php

route::pattern('id','([0-9]*)'); //là một hàm chứa biểu thức chính quy dùng cho tất cả.
route::pattern('slug','.*');

//add cart
        Route::get('carts/{id}/add', 'CartController@add');
///carts
Route::get('/carts', 'CartController@index');
Route::get('carts/delete/{rowId}', 'CartController@delete');
Route::get('carts/checkout', 'CartController@checkout');
Route::post('/carts', 'CartController@store_order');
Route::get('carts/manage' , 'CartController@manage');
Route::get('carts/manage/{id}/cancel' , 'CartController@cancel');
Route::get('carts/manage/{id}/detail' , 'CartController@detail');
Route::get('carts/{rowId}/down-count', 'CartController@down_count');
Route::get('carts/{rowId}/up-count', 'CartController@up_count');
Route::get('carts/manage/export', 'CartController@export_order');
Route::get('carts/manage/{id}/detail/export', 'CartController@export_order_detail');

Route::get('/send_email', array('uses' => 'EmailController@sendEmailReminder'));

Route::group(['namespace' => 'LayoutController'], function () {
    Route::get('/', [
        'uses' => 'IndexController@index',
        'as'   => 'public.index'
    ]);
    //---- products --------
    Route::group(['prefix' => 'product'], function () {
        Route::get('/',[
            'uses'  => 'ProductController@index',
            'as'    => 'public.products'
        ]);

        Route::get('categories/{slug}-{id}',[
            'uses'  => 'ProductController@Product_Cate',
            'as'    => 'public.Product_Cate'
        ]);

        Route::get('detail-{slug}-{id}',[
            'uses'  => 'ProductController@product_detail',
            'as'    => 'public.product_detail'
        ]);

        Route::post('ajax-add-comment',[
            'uses'  => 'ProductController@ajaxComment',
            'as'    => 'public.ajax.Addcomment'
        ]);

        Route::post('Ajax-getComment',[
            'uses'  => 'ProductController@ajaxGetComment',
            'as'    => 'public.ajax.getComment'
        ]);
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('shopping-card',[
            'uses'  => 'OrderController@shoppingcard',
            'as'    => 'public.shoppingcard'
        ]);
        Route::get('/checkout',[
            'uses'  => 'OrderController@checkout',
            'as'    => 'public.checkout'
        ]);

    });

    Route::group(['prefix'=> 'search'], function(){

        Route::post('search-product',[
            'uses'  => 'SearchController@search_product',
            'as'    => 'public.search.product'
        ]);
    });


    Route::group(['prefix' => 'contact'], function () {
        Route::get('',[
            'uses'  => 'ContactController@index',
            'as'    => 'public.contact'
        ]);

        Route::post('create-contact',[
            'uses'  => 'ContactController@store',
            'as'    => 'public.create.contact'
        ]);
        
    });

    Route::group(['prefix' => 'login'], function () {
        Route::get('dang-nhap',[
            'uses'  => 'UserController@login',
            'as'    => 'public.login'
        ]);
    });


});




//-----------------------------------------------------------------
//Quản lý Dashboard.
Route::group(['namespace' => 'AdminController','prefix' => 'adminpc', 'middleware'=>'auth'], function () {
    Route::get('/',[
        'uses'  => 'IndexController@index',
        'as'    => 'admin.index'
    ]);
    Route::get('/index',[
        'uses'  => 'IndexController@index',
        'as'    => 'admin.index'
    ]);
    //quản lý product...
    Route::group(['prefix' => 'Product'], function () {
        Route::get('/',[
            'uses'  => 'ProductController@index',
            'as'    => 'admin.listproduct'
        ]);

        Route::post('ajax-changeActive',[
            'uses'  => 'ProductController@changerActive',
            'as'    => 'admin.ajax.changeActive'
        ]);

        Route::get('/Chon-danh-muc',[
            'uses'  => 'ProductController@create',
            'as'    => 'admin.cate.add.product'
        ]);

        Route::get('/nhap-them-san-pham-{id}',[
            'uses'  => 'ProductController@Infoproduct',
            'as'    => 'admin.add.product'
        ]);

        Route::post('add-product',[
            'uses'  => 'ProductController@store',
            'as'    => 'admin.addproduct.store'
        ]);

        Route::get('addParameter-product-{id}',[
            'uses'  => 'ProductController@addParameters',
            'as'    => 'admin.addParameters.product'
        ]);

        Route::post('ajax-addparaproduct',[
            'uses'  => 'ProductController@addParaAjax',
            'as'    => 'admin.ajaxAddPara.product'
        ]);

        Route::post('ajax-getParaNewProduct',[
            'uses'  => 'ProductController@getParaNewAdd',
            'as'    => 'admin.ajaxParaNewAdd'
        ]);

        Route::post('ajax-getListPara',[
            'uses'  => 'ProductController@ajaxListPara',
            'as'    => 'admin.ajax.listPara'
        ]);

        Route::post('destroy-parameter',[
            'uses'  => 'ProductController@destroyPara',
            'as'    => 'admin.ajax.destroyparameter'
        ]);

        Route::get('edit-product-{id}',[
            'uses'  => 'ProductController@edit',
            'as'    => 'admin.edit.product'
        ]);

        Route::post('update-product-{id}',[
            'uses'  => 'ProductController@update',
            'as'    => 'admin.update.product'
        ]);

        Route::get('destroy-product-{id}',[
            'uses'  => 'ProductController@destroy',
            'as'    => 'admin.destroy.product'
        ]);

        Route::post('/destroy-MuchProduct',[
            'uses'  => 'ProductController@destroymuch',
            'as'    => 'admin.deleteMuch.product'
        ]);

    });

    Route::group(['prefix' => 'Promotion'], function () {
        Route::get('',[
            'uses'  => 'PromotionController@index',
            'as'    => 'promotion.index'
        ]);
    });

    Route::group(['prefix' => 'Category'], function () {
        Route::get('',[
            'uses'  => 'CateController@index',
            'as'    => 'admin.category'
        ]);
        Route::post('store-category',[
            'uses'  => 'CateController@store',
            'as'    => 'admin.storeCate'
        ]);
        Route::get('edit-{slug}-{id}',[
            'uses'  => 'CateController@edit',
            'as'    => 'admin.cateEdit'
        ]);

        Route::post('update-{slug}-{id}',[
            'uses'  => 'CateController@update',
            'as'    => 'admin.updateCate'
        ]);
        Route::post('delete-category',[
            'uses'  => 'CateController@ajaxdestroy',
            'as'    => 'admin.ajaxdestroy'
        ]);

    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/quan-ly-hoa-don',[
            'uses'  => 'OrdermanageController@show',
            'as'    => 'admin.qlhoadon'
        ]);

        Route::get('/Nhap-don-hang',[
            'uses'  => 'OrdermanageController@NhapDH',
            'as'    => 'admin.OrderIn'
        ]);

        Route::get('/add-inputOrder-{slug}-{id}',[
            'uses'  => 'OrdermanageController@AddOrderInput',
            'as'    => 'admin.Order.inputUpdate'
        ]);

        Route::post('store-product',[
            'uses'  => 'OrdermanageController@store',
            'as'    => 'admin.inputOrder'
        ]);

        Route::post('input-order-update',[
            'uses'  => 'OrdermanageController@inputUpdateorder',
            'as'    => 'admin.upadte.inputorder'
        ]);

        Route::get('/chi-tiet-hoa-don',[
            'uses'  => 'OrdermanageController@detaiOrder',
            'as'    => 'admin.detaiOrder'
        ]);

        Route::post('ajax-getInOrder',[
            'uses'  => 'OrdermanageController@ajaxGetInOrder',
            'as'    => 'admin.ajax.getInOrder'
        ]);
        Route::post('ajax-order-search',[
            'uses'  => 'OrdermanageController@ajaxsearch',
            'as'    => 'admin.ajaxsearch'
        ]);

    });
    Route::group(['prefix' => 'comment'], function () {
        Route::get('',[
            'uses'  => 'CommentController@index',
            'as'    => 'admin.comment'
        ]);

        Route::post('delete-comment',[
            'uses'  => 'CommentController@Ajaxdestroy',
            'as'    => 'admin.ajax.delete'
        ]);
        Route::post('destroy-much',[
            'uses'  => 'CommentController@destroy',
            'as'    => 'admin.destroy.comment'
        ]);
    });
    Route::group(['prefix' => 'parameters'], function () {
        Route::get('',[
            'uses'  => 'ParameterController@index',
            'as'    => 'admin.parameter'
        ]);

        Route::post('ajax-parameters',[
            'uses'  => 'ParameterController@getParameters',
            'as'    => 'admin.ajaxParameters'
        ]);

        Route::post('add-parameters',[
            'uses'  => 'ParameterController@store',
            'as'    => 'admin.add.parameters'
        ]);

        Route::get('/edit-{slug}-{id}',[
            'uses'  => 'ParameterController@edit',
            'as'    => 'admin.edit.parameter'

        ]);

        Route::post('update-{id}',[
            'uses'  => 'ParameterController@update',
            'as'    => 'admin.update.parameters'
        ]);

        Route::post('destroy',[
            'uses'  => 'ParameterController@destroy',
            'as'    =>'admin.destroy.parameters'
        ]);

    });
    Route::group(['prefix' => 'User'], function () {
        Route::get('',[
            'uses'  => 'UsersController@index',
            'as'    => 'admin.users'
        ]);

        Route::get('see-Profile-{id}',[
            'uses'  => 'UsersController@seeProfile',
            'as'    =>'admin.user.seeProfile'
        ]);

        Route::get('/user-add',[
            'uses'  => 'UsersController@create',
            'as'    => 'admin.usersCreate'
        ]);

        Route::post('store-user',[
            'uses'  => 'UsersController@store',
            'as'    => 'admin.user.store'
        ]);

        Route::get('edit-{slug}-{id}',[
            'uses'  => 'UsersController@edit',
            'as'    => 'admin.user.edit'
        ]);

        Route::post('update-{id}',[
            'uses'  => 'UsersController@update',
            'as'    => 'admin.user.update'
        ]);

        Route::get('delete-{id}',[
            'uses'  => 'UsersController@destroy',
            'as'    => 'admin.user.delete'
        ]);
        //-----------------------------------
        Route::get('/user-permission',[
            'uses'  => 'PermissionController@index',
            'as'    => 'admin.userPermission'
        ]);

        Route::post('/permission-store',[
            'uses'  => 'PermissionController@store',
            'as'    => 'admin.permission.store'
        ]);

        Route::post('/permission-update',[
            'uses'  => 'PermissionController@update',
            'as'    => 'admin.permission.update'
        ]);

        Route::post('/set-permission',[
            'uses'  => 'PermissionController@setPermission',
            'as'    => 'admin.permission.set'
        ]);

        Route::post('/permission-destroy',[
            'uses'  => 'PermissionController@destroy',
            'as'    => 'admin.permission.destroy'
        ]);
    });

    Route::group(['prefix' => 'provider'], function () {
        Route::get('',[
            'uses'  => 'ProviderController@index',
            'as'    => 'provider.index'
        ]);
        Route::post('store',[
            'uses'  => 'ProviderController@store',
            'as'    => 'provider.store'
        ]);
        Route::get('edit-{slug}-{id}',[
            'uses'  => 'ProviderController@edit',
            'as'    => 'provider.edit'
        ]);
        Route::post('update',[
            'uses'  => 'ProviderController@update',
            'as'    => 'provider.update'
        ]);
        Route::post('destroy-provider',[
            'uses'  => 'ProviderController@destroy',
            'as'    => 'provider.destroy'
        ]);
    });

    Route::group(['prefix' => 'Contacts'], function () {

        Route::get('',[
            'uses'  => 'ContactController@index',
            'as'    => 'admin.contact.index'
        ]);

        Route::post('ajax-count-contact',[
            'uses'  => 'ContactController@getcount',
            'as'    => 'admin.ajax.getcontact'
        ]);
        Route::post('ajax-setStar-contact',[
            'uses'  => 'ContactController@setStar',
            'as'    => 'admin.ajax.setStar'
        ]);

        Route::post('ajax-getall-contact',[
            'uses'  => 'ContactController@getall',
            'as'    => 'admin.ajax.allcontact'
        ]);

        Route::post('ajaxall-contact',[
            'uses'  => 'ContactController@arContact',
            'as'    => 'admin.ajax.getallcontact'
        ]);

        Route::post('ajaxView-contact',[
            'uses'  => 'ContactController@View',
            'as'    => 'admin.ajax.Viewcontact'
        ]);

        Route::post('destroy-contacts',[
            'uses'  => 'ContactController@destroy',
            'as'    => 'admin.destroy.contact'
        ]);

    });

    Route::group(['prefix' => 'Excels'], function () {

        Route::post('export-excel-addorder',[
            'uses'  => 'EcxelController@ExportAddOrder',
            'as'    => 'admin.excel.addorder'
        ]);

    });

});
route::group(['prefix'=> 'adminpc', 'namespace'=> 'Auth'], function(){

    route::get('',[
        'uses'  => 'AuthController@login',
        'as'    => 'admin.login'
    ]);
    route::post('post-login',[
        'uses'  => 'AuthController@postLogin',
        'as'    => 'admin.postlogin'
    ]);
    Route::get('logout',[
        'uses'  => 'AuthController@logout',
        'as'    => 'admin.logout'
    ]);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
