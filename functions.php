<?php
function winnica_podepnij_skrypty() {
    // 1. Ładowanie głównego pliku style.css (z katalogu motywu)
    wp_enqueue_style( 'winnica-style', get_stylesheet_uri() );
    
    // 2. Ładowanie zewnętrznego CSS (Toastify)
    wp_enqueue_style( 'toastify-style', 'https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css' );
    
    // 3. Ładowanie zewnętrznego JS (Toastify) w stopce
    wp_enqueue_script( 'toastify-js', 'https://cdn.jsdelivr.net/npm/toastify-js', array(), null, true );
    
    // 4. Ładowanie Twojego pliku script.js w stopce
    wp_enqueue_script( 'winnica-script', get_template_directory_uri() . '/script.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'winnica_podepnij_skrypty' );

function winnica_rejestruj_wina() {
    register_post_type( 'wina', array(
        'labels' => array(
            'name' => 'Wina',
            'singular_name' => 'Wino',
            'add_new' => 'Dodaj nowe wino',
            'add_new_item' => 'Dodaj nowe wino',
            'edit_item' => 'Edytuj wino'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array( 'title' ),
        'menu_icon' => 'dashicons-glass' // Ikonka kieliszka w menu
    ));
}
add_action( 'init', 'winnica_rejestruj_wina' );