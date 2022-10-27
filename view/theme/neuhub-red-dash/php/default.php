<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php if(x($page,'title')) echo $page['title'] ?></title>
    <?php /*
    <link rel="stylesheet" href="/view/theme/purplebasic/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/view/theme/purplebasic/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/view/theme/purplebasic/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/view/theme/purplebasic/assets/fonts/fontawesome5-overrides.min.css">
    */ ?>
  
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">  
	
  <script>var baseurl="<?php echo z_root() ?>";</script>
  <?php if(x($page,'htmlhead')) echo $page['htmlhead'] ?>    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    
    <style>
    @media (min-width: 768px)
    .sidebar.toggled .nav-item .nav-link {
        text-align: center;
        padding: 0.75rem 1rem;
        width: 6.5rem;
        /* font-size: .85rem; */
        // font-size: 12px;
    }
    .sidebar .nav-item .nav-link {
        text-align: center;
        padding: 0.75rem 1rem;
        width: 6.5rem;
        text-align: left;
        padding: 1rem;
        width: 14rem;
        /* font-size: .85rem; */
        // font-size: 12px;
    } 
    /*
    @media (min-width: 768px)
    .sidebar.toggled .nav-item .nav-link {
        text-align: center;
        padding: 0.75rem 1rem;
        width: 6.5rem;
        font-size: .85rem;
        // font-size: 1rem;
    }    
    */
    @media (min-width: 768px)
    .sidebar .nav-item .nav-link {
        display: block;
        width: 100%;
        text-align: left;
        padding: 1rem;
        width: 14rem;
        font-size: .85rem;
    }
    html {
    // --bs-font-sans-serif: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    // font-size: 13px;
    // font-size: 0.875rem;
    font-size: 1rem;
    }    
body {
    // font-size: 13px;
    // font-size: 1rem;
}    
.dropdown-menu {
    z-index: 100;
}

.wall-item-content-wrapper {
    // background-color: rgb(238,238,238);
    background-color: #FFF;
    border-top-right-radius: 0.25rem;
    border-top-left-radius: 0.25rem;
}

.wall-item-tools {
    // background-color: rgb(238,238,238);
}

    </style>

</head>

<body id="page-top" style="color: rgb(0,0,0);" class="!sidebar-toggled">
    <div id="wrapper">
        <div class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 toggled" style="background: #43488A;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-code"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Channel</span></div>
                </a>
                <hr class="sidebar-divider my-0">
			<!--
                <div class="d-none">
                    <p class="text-center d-grid" style="color: rgb(253,253,255);">Scott M. Stolz<br><small class="text-center" style="color: rgb(206,207,217);font-size: 12px;line-height: 12px;">scott@completehostingguide.com</small></p>
                </div>
	  -->
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="/"><i class="fas fa-home"></i><span>Home</span></a></li>
                    <!--
                    <li class="nav-item"><a class="nav-link" href="/channel/mockup"><i class="fas fa-tachometer-alt"></i><span>Channel</span></a></li>
                    -->
                    <li class="nav-item"><a class="nav-link" href="/directory?f=&pubforums=0&global=0"><i class="fas fa-user"></i><span>Channels</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/directory?f=&pubforums=1&global=0"><i class="fas fa-user"></i><span>Forums</span></a></li>
                    <!--
                    <li class="nav-item"><a class="nav-link" href="/profile/mockup"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/cal/mockup"><i class="fas fa-calendar"></i><span>Calendar</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/photos/mockup"><i class="fas fa-photo"></i><span>Photos</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login"><i class="far fa-user-circle"></i><span>Login</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="register"><i class="fas fa-user-circle"></i><span>Register</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="/hq"><i class="fas fa-user-circle"></i><span>Back to HQ</span></a></li>
                    -->
                </ul>
                <!-- <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div> -->
			<?php // TODO Fix toggle button ?>
            </div>
        </div>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                
                <?php if(x($page,'nav')) echo $page['nav']; ?>



                <div class="p-3">
                    <div class="row" style="font-size: 0.9rem;">
                        <div class="col-md-8 col-lg-9" id="!region_2">
                            <?php if(x($page,'content')) echo $page['content']; ?>
                        </div>
                        <div class="col-md-4 col-lg-3" id="!region_1">
                            
                            <!--
                            <button class="btn btn-primary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive">Toggle offcanvas</button>
                            
                            <div class="alert alert-info d-none d-lg-block">Resize your browser to show the responsive offcanvas toggle.</div>
                            
                            <div class="offcanvas-md offcanvas-end" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                              <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">Responsive offcanvas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                              </div>
                              <div class="offcanvas-body">
                                  
                                <p class="mb-0">This is content within an <code>.offcanvas-lg</code>.</p>
                                
                                
                              </div>
                            </div>                            
                            -->
                            
                            
                            
                            <div class="d-none d-sm-none d-md-none d-lg-block">
                            <?php if(x($page,'aside')) echo $page['aside']; ?>
                            
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php if(x($page,'footer')) echo $page['footer']; ?>
                            <?php if(x($page,'breadcrumb')) echo $page['breadcrumb'] ?>   
                            <!--
                            <hr>
                            <ol class="breadcrumb" style="font-size: 14px;">
                                <li class="breadcrumb-item"><a href="/" class="text-decoration-none"><span>Name of Website</span></a></li>
                                <li class="breadcrumb-item"><a href="/directory?f=&pubforums=1" class="text-decoration-none"><span>Channels or Forums</span></a></li>
                                <li class="breadcrumb-item"><a href="/channel/mockup" class="text-decoration-none"><span>Name of Forum or Channel</span></a></li>
                                <li class="breadcrumb-item"><a href="/channel/mockup" class="text-decoration-none"><span>Name of Page</span></a></li>
                            </ol>
                            -->
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
            
            <div class="bg-white sticky-footer">
                <div class="container my-auto">
                    <nav class="navbar navbar-light navbar-expand-md">
                        <div class="container-fluid"><a class="navbar-brand" href="#">Neuhub</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1" style="font-size: 12px;"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                            <div class="collapse navbar-collapse" id="navcol-1">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item"><a class="nav-link !active" href="/">Home</a></li>
                                    <!-- <li class="nav-item"><a class="nav-link" href="/network">Stream</a></li> -->
                                    <li class="nav-item"><a class="nav-link" href="/directory">Directory</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/search">Search</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/help">Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class="text-center my-auto copyright mb-20">
                        <!-- <span style="margin: 5px;">Copyright © 2022 <a href="https://wistex.com" class="text-decoration-none">WisTex TechSero Ltd. Co.</a></span> -->
                        <span style="margin: 5px;">An independent <a href="https://federatedhub.org" class="text-decoration-none" target="_blank">federated hub</a>.</span>
					<span style="margin: 5px;">Powered by <a href="https://hubzilla.org" class="text-decoration-none" target="_blank">Hubzilla</a> and <a href="https://neuhub.org" class="text-decoration-none" target="_blank">Neuhub</a>.</span>
                        <span style="margin: 5px;"><a href="/help/TermsOfService" class="text-decoration-none">Terms of Service</a></span>
                        <span style="margin: 5px;"><a href="/help/TermsOfService" class="text-decoration-none">Privacy Policy</a></span><br>&nbsp;
                    </div>
                </div>
            </div>
        </div><!-- <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a> -->
    </div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel"><i class="fas fa-caret-right"></i> Aside</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body" id="!region_1">
    <?php if(x($page,'aside')) echo $page['aside']; ?>
  </div>
</div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasLeftLabel"><i class="fas fa-paper-plane"></i> User Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body" id="!region_3">
      <div class="widget">
      <h3>Network</h3>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link" href="/hq">Headquarters (HQ)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/network">Network Stream</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/notifications/system">Notifications</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="/connections">Connections</a>
        </li>        
        
    </ul>
    </div>
      
    <?php if(x($page,'right_aside')) echo $page['right_aside']; ?>
  </div>
</div>

    <!--
    <script src="/view/theme/purplebasic/assets/bootstrap/js/bootstrap.min.js"></script>
    -->
    <script src="/view/theme/purplebasic/assets/js/bs-init.js"></script>
    <script src="/view/theme/purplebasic/assets/js/theme.js"></script>
    
</body>

</html>