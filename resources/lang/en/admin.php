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
    'categories_index_page' => [
        'page_headers' => [
            'categories' => 'Categories',
            'subcategories' => 'Subcategories',
        ],
        'page_subheaders' => [
            'categories' => 'Create, manage and delete all categories and subcategories in your database',
        ],
        'create_btn_text' => [
            'categories' => 'New Category',
            'subcategories' => 'A New Subcategory',
        ],
    ],
    'entity_create_page' => [
        'page_headers' => [
            'game' => 'Create New Game',
            'user' => 'Create New User',
            'game_platform' => 'Create New Game Platform',
            'game_category' => 'Create New Category',
            'game_subcategory' => 'Create New Subcategory',
        ],
    ],
    'entity_edit_page' => [
        'page_headers' => [
            'game' => 'Edit Game',
            'user' => 'Edit User',
            'game_platform' => 'Edit Game Platform',
            'game_category' => 'Edit Category',
            'game_subcategory' => 'Edit Subcategory',
        ],
        'placeholders' => [
            // Game Page
            'title' => 'Title of the game',
            'slug' => 'URL-friendly identifier (e.g. \'my-awesome-game\')',
            'short_description' => 'Short description...',
            'description' => 'Longer detailed description of the game...',
            'developer' => 'Developer of the game',
            'publisher' => 'Publisher of the game',
            'trailer_url' => 'URL of the game\'s trailer video (e.g. YouTube link)',
            'seo_title' => 'Optional SEO title (if different from main title)',
            'seo_description' => 'Optional SEO description',
            // Other Pages
            'category_placeholder' => 'Select a category',
            // User Page
            'username' => 'Username',
            'email' => 'Email Address',
            'password' => 'Password (leave blank to keep current password)',
        ],
        'fields' => [
            // Game Page
            'title' => 'Title',
            'slug' => 'URL slug',
            'short_description' => 'Short Description',
            'description' => 'Full Description',
            'developer' => 'Developer',
            'publisher' => 'Publisher',
            'release_date' => 'Release Date',
            'category' => 'Category',
            'subcategory' => 'Subcategory',
            'platforms' => 'Platforms',
            'thumbnail_image' => 'Main Image',
            'gallery_images' => 'Gallery Images',
            'trailer_url' => 'YouTube Trailer URL',    
            'seo_title' => 'SEO Title',
            'seo_description' => 'SEO Description',
            'seo_keywords' => 'SEO Keywords',
            // User Page
            'username' => 'Username',
            'email' => 'Email Address',
            'password' => 'Password',
            'role' => 'Role',
            'status' => 'Status',
            'current_avatar' => 'Current Profile Image', 
            'upload_avatar' => 'Upload New Profile Image',     

        ],
        'sections' => [
            'main' => 'Main Information', 
            'categorization' => 'Categorization',
            'media' => 'Media',
            'seo' => 'SEO Settings',
            // User Page
            'basic_info' => 'Basic Information',  
            'account_settings' => 'Account Settings', 
            'profile_image' => 'Profile Image',  
            'icon_image' => 'Icon Image', 
        ],
        'actions' => [
            'save' => 'Save Changes',
            'cancel' => 'Cancel',
        ],
    ],
    'system_settings_updated' => 'System settings updated successfully.',
    'system_settings' => [
        'title' => 'System Settings',
        'subtitle' => 'Manage your system settings here.'
    ],
    'success_messages' => [
        'game_added' => 'Game was added successfully.',
        'game_updated' => 'Game was updated successfully.',
        'user_added' => 'User was added successfully.',
        'user_updated' => 'User was updated successfully.',
        'platform_added' => 'Platform was added successfully.',
        'platform_updated' => 'Platform was updated successfully.',
        'category_added' => 'Category was added successfully.',
        'category_updated' => 'Category was updated successfully.',
        'subcategory_added' => 'Subcategory was added successfully.',
        'subcategory_updated' => 'Subcategory was updated successfully.',
    ]
];