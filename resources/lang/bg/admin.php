<?php

return [
    'welcome_message' => 'Добре дошли',
    'latest_games' => 'Последни игри',
    'sidebar' => [
        'dashboard' => 'Табло за управление',
        'games' => 'Игри',
        'game_platforms' => 'Платформи',
        'categories' => 'Категории',
        'users' => 'Потребители',
        'settings' => 'Системни настройки',
    ],
    'categories_index_page' => [
        'page_headers' => [
            'categories' => 'Категории',
            'subcategories' => 'Подкатегории',
        ],
        'page_subheaders' => [
            'categories' => 'Създавайте, управлявайте и изтривайте всички категории и подкатегории във вашата база данни',
        ],
        'create_btn_text' => [
            'categories' => 'Нова категория',
            'subcategories' => 'Нова подкатегория',
        ],
    ],
    'entity_create_page' => [
        'page_headers' => [
            'game' => 'Създаване на нова игра',
            'user' => 'Създаване на нов потребител',
            'game_platform' => 'Създаване на нова игрова платформа',
            'game_category' => 'Създаване на нова категория',
            'game_subcategory' => 'Създаване на нова подкатегория',
        ],
    ],
    'entity_edit_page' => [
        'page_headers' => [
            'game' => 'Редакция на игра',
            'user' => 'Редакция на потребител',
            'game_platform' => 'Редакция на игрова платформа',
            'game_category' => 'Редакция на категория',
            'game_subcategory' => 'Редакция на подкатегория',
        ],
        'placeholders' => [
            // Game Page
            'title' => 'Име на играта',
            'slug' => 'URL-friendly идентификатор (напр. \'my-awesome-game\')"',
            'short_description' => 'Кратко описание...',
            'description' => 'По-подробно описание на играта...',
            'developer' => 'Разработчик на играта',
            'publisher' => 'Издател на играта',
            'trailer_url' => 'URL на трейлър видео на играта (напр. YouTube линк)',
            'seo_title' => 'Опционално SEO заглавие (ако е различно от основното)',
            'seo_description' => 'Опционално SEO описание',
            // Other Pages
            'category_placeholder' => 'Изберете категория',
            // User Page
            'username' => 'Потребителско име',
            'email' => 'Имейл адрес',
            'password' => 'Парола (оставете празно, за да запазите текущата парола)',
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
            'trailer_url' => 'URL на YouTube трейлър',     
            'seo_title' => 'SEO заглавие',
            'seo_description' => 'SEO описание',
            'seo_keywords' => 'SEO ключови думи',
            // User Page
            'username' => 'Потребителско име',
            'email' => 'Имейл адрес',
            'password' => 'Парола',
            'role' => 'Роля',
            'status' => 'Статус',
            'current_avatar' => 'Текущо профилно изображение',  
            'upload_avatar' => 'Качване на аватар',   

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
    'system_settings_updated' => 'Системните настройки бяха успешно обновени.',
    'system_settings' => [
        'title' => 'Системни настройки',
        'subtitle' => 'Управлявайте системните настройки тук.'
    ],
    'success_messages' => [
        'game_added' => 'Играта беше успешно добавена.',
        'game_updated' => 'Играта беше успешно обновена.',
        'user_added' => 'Потребителят беше успешно добавен.',
        'user_updated' => 'Потребителят беше успешно обновен.',
        'platform_added' => 'Платформата беше успешно добавена.',
        'platform_updated' => 'Платформата беше успешно обновена.',
        'category_added' => 'Категорията беше успешно добавена.',
        'category_updated' => 'Категорията беше успешно обновена.',
        'subcategory_added' => 'Подкатегорията беше успешно добавена.',
        'subcategory_updated' => 'Подкатегорията беше успешно обновена.',
    ]
];