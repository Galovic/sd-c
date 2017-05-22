<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default max level categories
    |--------------------------------------------------------------------------
    */
    'max_categories' => '2',


    /*
    |--------------------------------------------------------------------------
    | Default admin path
    |--------------------------------------------------------------------------
    */

    'path' => 'admin',


    /*
    |--------------------------------------------------------------------------
    | Default upload directory
    |--------------------------------------------------------------------------
    */

    'path_upload' => 'media/upload',

    // Shared directory in upload directory
    'shared_directory' => 'Shared',


    /*
    |--------------------------------------------------------------------------
    | Default admin title
    |--------------------------------------------------------------------------
    */

    'title' => '[ admin ]',


    /*
    |--------------------------------------------------------------------------
    | Default image crops
    |--------------------------------------------------------------------------
    */

    'image_crop' => [
        'article' => [
            'big' => [
                'size' => [1200, 600],
            ],
//            'medium' => [
//                'size' => [680, 340],
//            ],
            'small' => [
                'size' => [340, 170],
            ],
//            'thumbnail' => [
//                'size' => [175, 73],
//            ],
        ],
        'og' => [
            'default' => [
                'size' => [1200, 630]
            ],
            'thumbnail' => [
                'size' => [312, 164],
            ],
        ],
        'photogallery' => [
            'big' => [
                'size' => 1200,
            ],
            'small' => [
                'size' => 500,
            ],
        ],
        'service' => [
            'big' => [
                'size' => [1200, 600],
            ],
//            'medium' => [
//                'size' => [680, 340],
//            ],
            'small' => [
                'size' => [340, 170],
            ],
//            'thumbnail' => [
//                'size' => [175, 73],
//            ],
        ],
    ],


    /*
     |--------------------------------------------------------------------------
     | List of article types
     |--------------------------------------------------------------------------
     */

    'article_type' => [
        1 => [
            'title' => 'článek',
            'class' => '',
        ],
        /*
        2 => [
            'title' => 'video',
            'class' => 'play',
        ],
        3 => [
            'title' => 'galerie',
            'class' => 'show',
        ],
        */
    ],


    /*
     |--------------------------------------------------------------------------
     | Types of displaying language code in url
     |--------------------------------------------------------------------------
     */
    'language_url' => [
        'directory' => 1,
        'subdomain' => 2,
        'domain' => 3,
    ],


    /*
     |--------------------------------------------------------------------------
     | Url prefixes
     |--------------------------------------------------------------------------
     */
    'urls' => [
        'articles' => 'articles',
        'services' => 'services',
    ],


    /*
    |--------------------------------------------------------------------------
    | Copyright text for admin footer
    |--------------------------------------------------------------------------
    */
    'copyright' => '&copy; ' . date('Y') . '. Admin by <a href="http://www.simplo.cz/" target="_blank">SIMPLO</a>',

];
