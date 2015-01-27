<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

Route::controller('admin/content', 'Ofat\InlineContent\AdminController', [
    'getIndex' => 'content.admin.index',
    'getCreate' => 'content.admin.create',
    'postInlineSave' => 'content.admin.inline-save'
]);