<?php

return [
    'welcome_message' => 'Welcome',
    'latest_games' => 'Latest games',
    'sidebar' => [
        'dashboard' => 'Dashboard',
        'games' => 'Games',
        'game_platforms' => 'Game Platforms',
        'categories' => 'Categories',
        'users' => 'Users',
        'settings' => 'System Settings',
    ],
    'entity_create_page' => [
        'page_headers' => [
            'game' => 'Create New Game',
            'user' => 'Create New User',
            'game_platform' => 'Create New Game Platform',
            'game_category' => 'Create New Category',
        ],
    ],
    'entity_edit_page' => [
        'page_headers' => [
            'game' => 'Редакция на игра',
            'user' => 'Редакция на потребител',
            'game_platform' => 'Редакция на игрова платформа',
            'game_category' => 'Редакция на категория',
        ],
        'fields' => [
            // Game Page
            'title' => 'Име',
            'slug' => 'URL slug',
            'short_description' => 'Кратко описание',
            'description' => 'Пълно описание',
            'developer' => 'Разработчик',
            'publisher' => 'Издател',
            'release_date' => 'Дата на издаване',
            'category' => 'Категория',
            'subcategory' => 'Подкатегория',
            'platforms' => 'Платформи',
            'thumbnail_image' => 'Главно изображение',
            'gallery_images' => 'Галерийни изображения',
            'trailer_url' => 'URL на YouTube трейлър',      //'YouTube Trailer URL',
            'seo_title' => 'SEO заглавие',
            'seo_description' => 'SEO описание',
            'seo_keywords' => 'SEO ключови думи',
            // User Page
            'username' => 'Потребителско име',
            'email' => 'Имейл адрес',
            'password' => 'Парола',
            'role' => 'Роля',
            'status' => 'Статус',
            'current_avatar' => 'Current Profile Image', // 'Текущо профилно изображение',
            'upload_avatar' => 'Качване на аватар',    //'Upload New Profile Image',

        ],
        'sections' => [
            'main' => 'Основна информация',
            'categorization' => 'Категоризация',
            'media' => 'Медия',
            'seo' => 'SEO настройки',
            // User Page
            'basic_info' => 'Основна информация', // 'Basic Information',
            'account_settings' => 'Настройки на акаунта', // 'Account Settings',
            'profile_image' => 'Профилна снимка', // 'Profile Image',
            'icon_image' => 'Икона', // 'Icon Image',
        ],

        'actions' => [
            'save' => 'Запази промените',
            'cancel' => 'Отказ',
        ],
    ],
    'system_settings_updated' => 'System settings updated successfully.',
    'system_settings' => [
        'title' => 'System Settings',
        'subtitle' => 'Manage your system settings here.'
    ],
];