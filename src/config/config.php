<?php
/**
 * @author Vitaliy Ofat <i@vitaliy-ofat.com>
 */

return [
    'languages' => [
        'ru',
        'en'
    ],
    'admin_check' => function() {
        return \Auth::check() && \Auth::user()->isAdmin();
    }
];