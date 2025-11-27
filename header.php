<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header/Nav con efecto glassmorphism -->
<div class="container mx-auto">
    <header class="backdrop-blur-md border-b border-white/10 shadow-lg bg-primary transition-all duration-300" id="main-header">
        <nav class="px-6 py-4 transition-all duration-300" id="main-nav">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/public/logo_light.png" 
                             alt="<?php bloginfo('name'); ?>" 
                             class="h-16 transition-all duration-300" 
                             id="site-logo"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='block';">
                        <span class="text-white font-bold text-xl" style="display:none;">
                            <?php bloginfo('name'); ?>
                        </span>
                    </a>
                <?php endif; ?>
            </div>
            
            <!-- Menú Central y botón móvil -->
            <div class="flex items-center space-x-8">
                <!-- Menú Central -->
                <div class="hidden md:flex items-center space-x-8">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'items_wrap' => '%3$s',
                    'fallback_cb' => function() {
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-white hover:text-blue-300 transition">Quiénes somos</a>
                        <a href="<?php echo esc_url(home_url('/que-ofrecemos')); ?>" class="text-white hover:text-blue-300 transition">Qué ofrecemos</a>
                        <a href="#" class="text-white hover:text-blue-300 transition">Camino zum talent</a>
                        <a href="#" class="text-white hover:text-blue-300 transition">Contacto</a>
                        <a href="#" class="text-white hover:text-blue-300 transition">Bolsa de trabajo</a>
                        <?php
                    },
                    'link_before' => '<span class="text-white hover:text-blue-300 transition">',
                    'link_after' => '</span>',
                ));
                ?>
            </div>
            
            <!-- Menú móvil toggle  --> 
            <button id="mobile-menu-toggle" class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            </div> 
        </div>
        
        <!-- Menú móvil -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'space-y-3',
                'fallback_cb' => function() {
                    ?>
                    <div class="space-y-3">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="block text-white hover:text-blue-300 transition py-2">Quiénes somos</a>
                        <a href="<?php echo esc_url(home_url('/que-ofrecemos')); ?>" class="block text-white hover:text-blue-300 transition py-2">Qué ofrecemos</a>
                        <a href="#" class="block text-white hover:text-blue-300 transition py-2">Camino zum talent</a>
                        <a href="#" class="block text-white hover:text-blue-300 transition py-2">Contáctanos</a>
                        <a href="#" class="block text-white hover:text-blue-300 transition py-2">Bolsa de trabajo</a>
                    </div>
                    <?php
                },
                'link_before' => '<span class="block text-white hover:text-blue-300 transition py-2">',
                'link_after' => '</span>',
            ));
            ?>
        </div>
    </nav>
</header>
</div>

<script>
// Header sticky al hacer scroll con animación
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('main-header');
    const nav = document.getElementById('main-nav');
    const logo = document.getElementById('site-logo');
    const container = header.closest('.container');
    let isFixed = false;

    window.addEventListener('scroll', function() {
        const scrolled = window.scrollY;
        
        if (scrolled > 100 && !isFixed) {
            // Hacer sticky
            isFixed = true;
            container.style.position = 'fixed';
            container.style.top = '0';
            container.style.left = '50%';
            container.style.transform = 'translateX(-50%)';
            container.style.zIndex = '9999';
            container.style.width = '100%';
            container.style.maxWidth = '1440px';
            
            // Cambiar background a 30% de opacidad
            header.classList.remove('bg-primary');
            header.classList.add('bg-primary/30');
            
            // Reducir tamaño
            nav.style.paddingTop = '0.75rem';
            nav.style.paddingBottom = '0.75rem';
            if (logo) {
                logo.style.height = '3rem';
            }
        } else if (scrolled <= 100 && isFixed) {
            // Quitar sticky
            isFixed = false;
            container.style.position = 'static';
            container.style.top = 'auto';
            container.style.left = 'auto';
            container.style.transform = 'none';
            container.style.zIndex = 'auto';
            container.style.width = 'auto';
            container.style.maxWidth = '1440px';
            
            // Restaurar background opaco
            header.classList.remove('bg-primary/30');
            header.classList.add('bg-primary');
            
            // Restaurar tamaño
            nav.style.paddingTop = '1rem';
            nav.style.paddingBottom = '1rem';
            if (logo) {
                logo.style.height = '4rem';
            }
        }
    });

    // Toggle menú móvil
    const toggle = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu');
    
    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
    }
});
</script>
