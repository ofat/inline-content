<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

Route::get('admin/content/{type}', [
    'as'=>'content.admin.index',
    'uses' => 'Ofat\InlineContent\AdminController@getIndex'
])->where('type', 'pages|blocks');

Route::controller('admin/content', 'Ofat\InlineContent\AdminController', [
    'getCreate' => 'content.admin.create'
]);