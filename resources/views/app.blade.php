<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        <div id="preloader">
            <div class="preloader-title">
                penStashem
            </div>
            
            <div class="preloader-bar-wrapper">
                <div id="preloader-bar"></div>
            </div>
            
            <div id="preloader-status">Drafting Morning Edition...</div>
        </div>

        <style>
            #preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #F4F1EA;
                background-image: url('/images/paper-grain.svg');
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                transition: all 0.3s cubic-bezier(0.65, 0, 0.35, 1);
                color: #000;
            }
            .preloader-title {
                font-family: 'Playfair Display', serif;
                font-weight: 900;
                font-size: 2.5rem;
                letter-spacing: -0.05em;
                text-transform: uppercase;
                margin-bottom: 1.5rem;
            }
            .preloader-bar-wrapper {
                width: 200px;
                height: 2px;
                position: relative;
                background: rgba(0,0,0,0.1);
            }
            #preloader-bar {
                position: absolute;
                width: 0%;
                height: 100%;
                background-color: #000;
                transition: width 0.8s cubic-bezier(0.22, 1, 0.36, 1);
            }
            #preloader-status {
                font-family: monospace;
                font-size: 9px;
                text-transform: uppercase;
                margin-top: 15px;
                letter-spacing: 0.3em;
                color: #888;
            }

            @keyframes lineGrow {
                to { transform: scaleX(1); }
            }
            .preloader-hidden {
                opacity: 0 !important;
                visibility: hidden !important;
                transform: scale(1.05) !important;
            }

            /* Lenis Smooth Scroll Base */
            html.lenis, html.lenis body {
                height: auto;
            }
            .lenis.lenis-smooth {
                scroll-behavior: auto !important;
            }
            .lenis.lenis-smooth [data-lenis-prevent] {
                overscroll-behavior: contain;
            }
            .lenis.lenis-stopped {
                overflow: hidden;
            }
            .lenis.lenis-scrolling iframe {
                pointer-events: none;
            }
        </style>

        @inertia

        <div id="page-spinner">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>

        <style>
            :root {
                --spinner-bg: rgba(255, 255, 255, 0.9);
                --spinner-stroke: #000000;
                --spinner-shadow: rgba(0, 0, 0, 0.15);
            }

            @media (prefers-color-scheme: dark) {
                :root {
                    --spinner-bg: rgba(0, 0, 0, 0.8);
                    --spinner-stroke: #ffffff;
                    --spinner-shadow: rgba(255, 255, 255, 0.1);
                }
            }

            html.dark, body.dark {
                --spinner-bg: rgba(0, 0, 0, 0.8);
                --spinner-stroke: #ffffff;
                --spinner-shadow: rgba(255, 255, 255, 0.1);
            }

            #page-spinner {
                position: fixed;
                bottom: calc(25px + env(safe-area-inset-bottom, 0px));
                right: calc(25px + env(safe-area-inset-right, 0px));
                width: 50px;
                height: 50px;
                
                background: var(--spinner-bg);
                box-shadow: 0 4px 12px var(--spinner-shadow);
                
                backdrop-filter: blur(4px);
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9998;
                opacity: 0;
                visibility: hidden;
                transform: scale(0.8);
                transition: opacity 0.2s ease, transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), background 0.3s ease;
                pointer-events: none;
            }

            .spinner {
                width: 24px;
                height: 24px;
                animation: rotate 2s linear infinite;
            }
            
            .spinner .path {
                stroke: var(--spinner-stroke);
                stroke-linecap: round;
                animation: dash 1.5s ease-in-out infinite;
            }
            
            .spinner-visible {
                opacity: 1 !important;
                visibility: visible !important;
                transform: scale(1) !important;
            }

            @keyframes rotate {
                100% { transform: rotate(360deg); }
            }
            @keyframes dash {
                0% { stroke-dasharray: 1, 150; stroke-dashoffset: 0; }
                50% { stroke-dasharray: 90, 150; stroke-dashoffset: -35; }
                100% { stroke-dasharray: 90, 150; stroke-dashoffset: -124; }
            }
        </style>
    </body>
</html>
