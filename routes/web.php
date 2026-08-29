<?php
/**
 * Application Web Routes Registry
 * Maps HTTP Method and URL pattern to Controller and Action
 * Supports placeholders: {slug} for strings and {id} for numeric IDs
 */

return [
    // ------------------------------------------------------------------------
    // Public Front Storefront Routes
    // ------------------------------------------------------------------------
    'GET' => [
        ''                              => ['HomeController', 'index'],
        '/'                             => ['HomeController', 'index'],
        'home'                          => ['HomeController', 'index'],
        'about'                         => ['AboutController', 'index'],
        'products'                      => ['ProductController', 'index'],
        'products/{slug}'               => ['ProductController', 'detail'],
        'product'                       => ['ProductController', 'detailLegacy'],
        'contact'                       => ['ContactController', 'index'],
        'login'                         => ['AuthController', 'login'],
        'register'                      => ['AuthController', 'register'],
        'logout'                        => ['AuthController', 'logout'],

        // --------------------------------------------------------------------
        // Protected Admin Routes
        // --------------------------------------------------------------------
        'admin'                         => ['AdminController', 'dashboard'],
        'admin/dashboard'               => ['AdminController', 'dashboard'],

        // Admin Products Management
        'admin/products'                => ['ProductController', 'adminIndex'],
        'admin/products/create'         => ['ProductController', 'adminCreateView'],
        'admin/products/edit/{id}'      => ['ProductController', 'adminEditView'],

        // Admin Categories Management
        'admin/categories'              => ['CategoryController', 'adminIndex'],
        'admin/categories/create'       => ['CategoryController', 'adminCreateView'],
        'admin/categories/edit/{id}'    => ['CategoryController', 'adminEditView'],

        // Admin Gallery Management
        'admin/gallery'                 => ['GalleryController', 'adminIndex'],
        'admin/gallery/create'          => ['GalleryController', 'adminCreateView'],
        'admin/gallery/edit/{id}'       => ['GalleryController', 'adminEditView'],

        // Admin Customer Messages
        'admin/messages'                => ['AdminController', 'messages'],
        'admin/messages/read/{id}'       => ['AdminController', 'markMessageRead'],
    ],

    'POST' => [
        'contact'                       => ['ContactController', 'submit'],
        'login'                         => ['AuthController', 'processLogin'],
        'register'                      => ['AuthController', 'processRegister'],
        'logout'                        => ['AuthController', 'logout'],

        // Admin Product POST Handlers
        'admin/products/create'         => ['ProductController', 'processAdminCreate'],
        'admin/products/edit/{id}'      => ['ProductController', 'processAdminEdit'],
        'admin/products/delete/{id}'    => ['ProductController', 'processAdminDelete'],

        // Admin Category POST Handlers
        'admin/categories/create'       => ['CategoryController', 'processAdminCreate'],
        'admin/categories/edit/{id}'    => ['CategoryController', 'processAdminEdit'],
        'admin/categories/delete/{id}'  => ['CategoryController', 'processAdminDelete'],

        // Admin Gallery POST Handlers
        'admin/gallery/create'          => ['GalleryController', 'processAdminCreate'],
        'admin/gallery/edit/{id}'       => ['GalleryController', 'processAdminEdit'],
        'admin/gallery/delete/{id}'     => ['GalleryController', 'processAdminDelete'],

        // Admin Message Delete
        'admin/messages/delete/{id}'    => ['AdminController', 'processDeleteMessage'],
    ]
];
