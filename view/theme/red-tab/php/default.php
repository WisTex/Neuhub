<!doctype html>
<!--
* Neuhub Tab Theme for Hubzilla
* @version 1.0
* @link https://neuhub.org
* Copyright © 2023 WisTex TechSero Ltd. Co.
* Licensed under MIT (https://license.neuhub.org)
*
* This theme uses elements from:
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright © 2018-2023 The Tabler Authors
* Copyright © 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->

<?php
// Include default configuration file, if it exists.
// ! Do not put your configuration settings in this file. It will be overwritten when you update Neuhub.
$filename = 'view/theme/neuhub-tab/config/neuhub-config-default.php';
if (file_exists($filename)) {
    include_once('view/theme/neuhub-tab/config/neuhub-config-default.php');
} else {
    //// echo "The file $filename does not exist";
}
?>

<?php
// Include your configuration file, if it exists.
// ! Overrides values in default configuration file.
$filename = 'view/theme/neuhub-tab/config/neuhub-config.php';
if (file_exists($filename)) {
    include_once('view/theme/neuhub-tab/config/neuhub-config.php');
} else {
    //// echo "The file $filename does not exist";
}
?>


<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    
    <title><?php if(x($page,'title')) echo $page['title'] ?></title>
    <script>var baseurl="<?php echo z_root() ?>";</script>
    <?php if(x($page,'htmlhead')) echo $page['htmlhead'] ?>


    <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="/stats/js/script.js"></script>
    <meta name="msapplication-TileColor" content=""/>
    <meta name="theme-color" content=""/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <meta name="description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!"/>
    <meta name="canonical" content="https://preview.tabler.io/layout-combo.html">
    <meta name="twitter:image:src" content="https://preview.tabler.io/static/og.png">
    <meta name="twitter:site" content="@tabler_ui">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta name="twitter:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <meta property="og:image" content="https://preview.tabler.io/static/og.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Tabler">
    <meta property="og:type" content="object">
    <meta property="og:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta property="og:url" content="https://preview.tabler.io/static/og.png">
    <meta property="og:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <!-- CSS files -->

    <link rel="stylesheet" href="https://neuhub.org/view/theme/neuhub-red-dash/assets/fonts/fontawesome-all.min.css?v=7.8.7" type="text/css" media="screen">
    <link rel="stylesheet" href="https://neuhub.org/view/theme/neuhub-red-dash/assets/fonts/font-awesome.min.css?v=7.8.7" type="text/css" media="screen">
    <link rel="stylesheet" href="https://neuhub.org/view/theme/neuhub-red-dash/assets/fonts/fontawesome5-overrides.min.css?v=7.8.7" type="text/css" media="screen">
    <link rel="stylesheet" href="https://neuhub.org/view/theme/neuhub-red-dash/assets/fonts/fa5/css/all.css?v=7.8.7" type="text/css" media="screen">
    <!-- <link rel="stylesheet" href="https://neuhub.org/view/theme/neuhub-red-dash/assets/assets/fonts/hubzilla/style.css?v=7.8.7" type="text/css" media="screen"> -->
    <!-- <link rel="stylesheet" href="/mockups/mockup-neuhub-tabley/assets/fonts/hubzilla/style.css?v=7.8.7" type="text/css" media="screen"> -->

    <!-- Moved to /theme_init.php -->
    <link href="/view/theme/red-tab/dist/css/tabler.min.css?1685973381" rel="stylesheet"/>
    <link href="/view/theme/red-tab/dist/css/tabler-flags.min.css?1685973381" rel="stylesheet"/>
    <link href="/view/theme/red-tab/dist/css/tabler-payments.min.css?1685973381" rel="stylesheet"/>
    <link href="/view/theme/red-tab/dist/css/tabler-vendors.min.css?1685973381" rel="stylesheet"/>
    <link href="/view/theme/red-tab/dist/css/demo.min.css?1685973381" rel="stylesheet"/>
<!-- -->
    

    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        /* --bs-border-color: rgba(4, 32, 69, 0.14); */
        --bs-border-color: rgba(72, 110, 149, 0.14); /* had to pick a color that shows up on light and dark modes */
        /* --bs-body-bg: white; conflicts with dark mode */
        /* --bs-body-bg: rgba(72, 110, 149, 0.14); had to pick a color that shows up on light and dark modes */
        /* --bs-body-bg: var(--tblr-card-color); */
        /* --bs-tertiary-bg: rgb(230, 238, 246);  conflicts with dark mode */
        /* --bs-tertiary-bg: rgba(72, 110, 149, 0.14); had to pick a color that shows up on light and dark modes */
        /* --bs-link-color: rgb(0, 84, 166); slate blue link color */
        --bs-link-color: green; /* mostly used for toggle switches */
        --bs-warning: #f59f00;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
      .wall-item-content-wrapper {
        background: var(--tblr-card-color);
      }
      .btn-group-sm>.btn, .btn-sm {
        --bs-btn-padding-y: 0.3rem;
        --bs-btn-padding-x: 0.5rem;
        --bs-btn-font-size: 0.9rem;
        --tblr-btn-padding-y: 0.3rem;
        --tblr-btn-padding-x: 0.5rem;
        --tblr-btn-font-size: 0.9rem;    
        --tblr-btn-icon-size: 0.9rem;
      }
      .dropdown-menu {
    --tblr-dropdown-min-width: 15rem;
      }

    </style>
  </head>
  <body >
    <?php /* Moved to theme_init.php <script src="/view/theme/red-tabler/dist/js/demo-theme.min.js?1685973381"></script> */ ?>
    <script src="/view/theme/red-tab/dist/js/demo-theme.min.js?1685973381"></script>
    <div class="page">

                <!-- Main Site Navigation -->
                <?php if(x($page,'nav')) echo $page['nav']; ?>

      <div class="page-wrapper">

                <!-- Site Breadcrumbs -->
                <?php if(x($page,'breadcrumb')) echo $page['breadcrumb'] ?>   

                <!-- Widgets Above Content -->
                <?php if(x($page,'top_area')) echo $page['top_area']; ?>

        <!-- Page header -->
        <?php /*
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Thatcher Keel
                </div>
                <h2 class="page-title">
                  Combo layout
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="/hq" class="btn">
                      Headquarters (HQ)
                    </a>
                  </span>
                  <a href="/rpost" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Create New Post
                  </a>
                  <a href="/rpost" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create New Post">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        */ ?>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-8">


                <?php if(x($page,'content')) echo $page['content']; ?>          

                <!--
                <div class="card !card-lg">
                    <div class="card-body">
                    
                    </div>
                </div>
                -->

                <!--
                <div class="card card-lg">
                  <div class="card-body">
                    <div class="markdown">
                      <p>This is a legal agreement between you, the Purchaser, and Tabler. Purchasing or downloading of any Tabler product (Tabler Free, Tabler PRO, Tabler Email), constitutes your acceptance of the terms of this license, <a href="https://tabler.io/terms-of-service.html">Tabler terms of service</a> and <a href="https://tabler.io/privacy-policy.html">Tabler private policy</a>.</p>
                      <p>A license grants you a non-exclusive and non-transferable right to use and incorporate the item in your personal or commercial projects.</p>
                      <h3 id="tabler-free-license">Tabler Free License</h3>
                      <p>Tabler Free is available under MIT License</p>
                      <p>Copyright 2023 Tabler</p>
                      <p>Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:</p>
                      <p>The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.</p>
                      <p>THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.</p>
                      <h3 id="tabler-pro-and-tabler-email-license">Tabler PRO and Tabler Email License</h3>
                      <p>After Purchasing you are granted the use products under the conditions featured belowed.</p>
                      <p>Rights</p>
                      <ol>
                        <li>You have rights to use our resources for any or all of your personal and commercial projects.</li>
                        <li>You may modify the resources according to your requirements.</li>
                        <li>You are not required to attribute or link to Tabler in any of your projects.</li>
                      </ol>
                      <p>Restrictions</p>
                      <ol>
                        <li>You do not have the rights to redistribute, resell, lease, license, sub-license or offer the file downloaded to any third party.</li>
                        <li>For any resalable web applications or software programs, you cannot include our graphic resources as an additional attachment.</li>
                        <li>You cannot redistribute any of the software, or products created with Tabler paid  products.</li>
                        <li>You cannot add our source code to any open source repository.</li>
                        <li>The source code may not be placed on any website in a complete or archived downloadable format.</li>
                      </ol>
                    </div>
                  </div>
                </div>
    -->
              </div>
              <div class="col-lg-4">

              <?php if(x($page,'aside')) echo $page['aside']; ?>
              <?php if(x($page,'right_aside')) echo $page['right_aside']; ?>



                <p></p>

                <div class="card mb-3">
                  <!--
                  <div class="card-header">
                    <h3 class="card-title">Card title <span class="card-subtitle">Subtitle</span></h3>
                  </div>
                  -->
                  <div class="card-body">
                    <p>
                      <a href="/"><b>Digital Authorship</b></a> is part of a decentralized social network powered by Hubzilla and Neuhub.
                      <!-- <a href="https://github.com/WisTex/Raconteur" target="_blank">Raconteur</a>. -->
                    </p>
                  </div>
                </div>

                <?php /*
                <div class="card mb-3">
                  <!--
                  <div class="card-header">
                    <h3 class="card-title">Card title <span class="card-subtitle">Subtitle</span></h3>
                  </div>
                  -->
                  <div class="card-body">
                    <h3 class="card-title">Follow Scott M. Stolz</h3>
                  <p>Follow me on Hubzilla or via ActivityPub
                    <br>scott@completehostingguide.com
                  </p>
                  <p>Follow me on Mastodon
                    <br>@scott@completehostingguide.com
                  </p>
                  <!--
                  <p>Follow me on Bluesky
                    <br>@scott.completehostingguide.com
                  </p>
                  -->
                </div>
                </div>
                */ ?>



              </div>
            </div>
          </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item"><a href="./" class="link-secondary">Home</a></li>
                  <li class="list-inline-item"><a href="./directory" class="link-secondary">Directory</a></li>
                  <!--
                  <li class="list-inline-item"><a href="./article/legal" class="link-secondary">Legal</a></li>
                  -->
                  <li class="list-inline-item"><a href="./help" class="link-secondary">Help</a></li>
                  <!-- 
                  <li class="list-inline-item"><a href="./article/about" class="link-secondary">About</a></li>
                  -->
                  <!--
                  <li class="list-inline-item">
                    <a href="https://neuhub.org" target="_blank" class="link-secondary" rel="noopener">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                      Sponsor
                    </a>
                  </li>
                  -->
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 1995-2023
                    <a href="https://wistex.com" target="_blank" class="link-secondary">WisTex TechSero Ltd. Co.</a>
                    All rights reserved.
                  </li>
                  <!--
                  <li class="list-inline-item">
                    <a href="./article/changelog" class="link-secondary" rel="noopener">
                      v1.0
                    </a>
                  </li>
                  -->
                </ul>
              </div>
            </div>
          </div>

          <style>
            .mobile-nav {
            background: #F1F1F1;
            position: fixed;
            bottom: 0;
            height: 65px;
            width: 100%;
            display: flex;
            justify-content: space-around;
            margin-top: 165px;
          }
          .bloc-icon {
            display: flex;
            justify-content: center;
            align-items: center;
          }
          .bloc-icon img {
            width: 30px;
          }
          @media screen and (min-width: 600px) {
            .mobile-nav {
            display: none;
            }
          }
          </style>
          
                  <nav class="mobile-nav bg-dark-lt">
                    <a href="/article/main" class="bloc-icon">




                      <span class="bg-dark-lt text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                          <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                          <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                      </span>
                    </a>
                    <a href="/profile/wistex" class="bloc-icon">
                      <span class="bg-dark-lt text-muted avatar"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                      </span>
                    </a>
                    <a href="/hq" class="bloc-icon">
                      <span class="bg-dark-lt text-muted avatar"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-castle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M15 19v-2a3 3 0 0 0 -6 0v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-14h4v3h3v-3h4v3h3v-3h4v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                          <path d="M3 11l18 0" />
                        </svg>
                      </span>
                    </a>

                    <a href="/notifications" class="bloc-icon">
                      <span class="bg-dark-lt text-muted avatar"><!-- Download SVG icon from http://tabler-icons.io/i/user -->

                        <!-- if there are notifications -->
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M14.235 19c.865 0 1.322 1.024 .745 1.668a3.992 3.992 0 0 1 -2.98 1.332a3.992 3.992 0 0 1 -2.98 -1.332c-.552 -.616 -.158 -1.579 .634 -1.661l.11 -.006h4.471z" stroke-width="0" fill="currentColor" />
                          <path d="M12 2c1.358 0 2.506 .903 2.875 2.141l.046 .171l.008 .043a8.013 8.013 0 0 1 4.024 6.069l.028 .287l.019 .289v2.931l.021 .136a3 3 0 0 0 1.143 1.847l.167 .117l.162 .099c.86 .487 .56 1.766 -.377 1.864l-.116 .006h-16c-1.028 0 -1.387 -1.364 -.493 -1.87a3 3 0 0 0 1.472 -2.063l.021 -.143l.001 -2.97a8 8 0 0 1 3.821 -6.454l.248 -.146l.01 -.043a3.003 3.003 0 0 1 2.562 -2.29l.182 -.017l.176 -.004z" stroke-width="0" fill="currentColor" />
                        </svg>
                        

                        <!-- if there are no notifications -->
                        <!--
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                          <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        -->
                      </span>
                    </a>
                    <a href="/settings" class="bloc-icon">
                      <span class="bg-dark-lt text-muted avatar"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                          <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        </svg>
                      </span>
                    </a>
                </nav>

        </footer>



     
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/view/theme/red-tabler/dist/js/tabler.min.js?1685973381" defer></script>
    <script src="/view/theme/red-tabler/dist/js/demo.min.js?1685973381" defer></script>
  </body>
</html>