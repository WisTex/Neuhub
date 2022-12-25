<!DOCTYPE html>
<html>

<?php
// Include default configuration file, if it exists.
// ! Do not put your configuration settings in this file. It will be overwritten when you update Neuhub.
$filename = 'view/theme/neuhub-red-dash/config/neuhub-config-default.php';
if (file_exists($filename)) {
    include_once('view/theme/neuhub-red-dash/config/neuhub-config-default.php');
} else {
    //// echo "The file $filename does not exist";
}
?>

<?php
// Include your configuration file, if it exists.
// ! Overrides values in default configuration file.
$filename = 'view/theme/neuhub-red-dash/config/neuhub-config.php';
if (file_exists($filename)) {
    include_once('view/theme/neuhub-red-dash/config/neuhub-config.php');
} else {
    //// echo "The file $filename does not exist";
}

// $channellocal = get_channel();

?>
    


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
  
    <!-- // TODO: Get local copy of font. -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">  

	<link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/fonts/ionicons.min.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Highlight-Phone.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Projects-Clean.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/styles.css">  

    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/css/prism-coy-full.css">
	
  <script>var baseurl="<?php echo z_root() ?>";</script>
  <?php if(x($page,'htmlhead')) echo $page['htmlhead'] ?>    

    <!-- // TODO: Get local copy of popper. -->
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

<body id="page-top" style="color: rgb(0,0,0);" class="sidebar-toggled">
    <!-- Begin Nav Sidebar -->

        <div id="wrapper">
        

<?php
$tpl = get_markup_template('neuhub_red_dash_sidebar_custom.tpl');
	
    // replaces macros in the template.
    $outputsidebar = replace_macros($tpl,array(
        '$title' => t('Example Addon'),
        '$cardtitle' => t('Card Title'),
        '$desc' => t('<p>This is an example of information. <p>It can include HTML in it.'),
        '$alerttitle' => t('Warning'),
        '$alertbody' => t('This is only a test.') 
    ));

if ($outputsidebar != "<h3>ERROR: there was an error creating the output.</h3>") {
    echo $outputsidebar;   
} else {
    ?>


        <div class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 toggled" style="background: #43488A;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="icon-hz-64"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Neuhub</span></div>
                </a>
                <hr class="sidebar-divider my-0">
			    <!--
                <div class="d-none">
                    <p class="text-center d-grid" style="color: rgb(253,253,255);">Scott M. Stolz<br><small class="text-center" style="color: rgb(206,207,217);font-size: 12px;line-height: 12px;">scott@completehostingguide.com</small></p>
                </div>
	            -->
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="/"><i class="fa5 fa5-home"></i><span>Home</span></a></li>
                    <!--
                    <li class="nav-item"><a class="nav-link" href="/channel/mockup"><i class="fas fa-tachometer-alt"></i><span>Channel</span></a></li>
                    -->
                    <!--
		            <li class="nav-item"><a class="nav-link" href="/hq"><i class="fa5 fa5-circle-user"></i><span>HQ</span></a></li>         	      
		            <li class="nav-item"><a class="nav-link" href="/channel"><i class="fa5 fa5-house-user"></i><span>Channel</span></a></li>         
                    -->
		            <li class="nav-item"><a class="nav-link" href="/directory?f=&pubforums=0&global=0"><i class="fas fa-sitemap"></i><span>Directory</span></a></li>
		            <li class="nav-item"><a class="nav-link" href="/directory?f=&pubforums=1&global=0"><i class="fas fa-comments"></i><span>Forums</span></a></li>
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
			<?php // TODO Fix toggle button 
            ?>
            </div>
        </div>

        <?php
}
?>

        <!-- End Nav Sidebar -->
        <div class="d-flex flex-column min-vh-100" id="content-wrapper" style="margin-bottom: 56px;">
            <div id="content">
                
                <!-- Main frame and Site Navigation -->
                <?php if(x($page,'nav')) echo $page['nav']; ?>

                <!-- Site Breadcrumbs -->
                <?php if(x($page,'breadcrumb')) echo $page['breadcrumb'] ?>   

                <!-- Widgets Above Content -->
                <?php if(x($page,'top_area')) echo $page['top_area']; ?>

                <div class="p-3">
                    <div class="row" style="font-size: 0.9rem;">
                        <div class="col-md-8 col-lg-9 flex-grow-1" id="!region_1"> <!-- region 2 -->
                            <?php if(x($page,'content')) echo $page['content']; ?>
                        </div>
                        <div class="col-md-4 col-lg-3" id="!region_1 !region_3"> <!-- region 1 -->
                            
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
	          
	          
	          
	          
                            <?php if(x($page,'below_content')) echo $page['below_content']; ?>
	          
	          
                            
                            
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


<?php
// Enhanced Footer
// TODO: Allow admins to easily customize this.
?>

<!-- Footer -->
<?php if(x($page,'footer')) echo $page['footer']; ?>

<?php
$tpl = get_markup_template('neuhub_red_dash_footer_custom.tpl');
	
    // replaces macros in the template.
    $outputfooter = replace_macros($tpl,array(
        '$title' => t('Example Addon'),
        '$cardtitle' => t('Card Title'),
        '$desc' => t('<p>This is an example of information. <p>It can include HTML in it.'),
        '$alerttitle' => t('Warning'),
        '$alertbody' => t('This is only a test.') 
    ));

if ($outputfooter != "<h3>ERROR: there was an error creating the output.</h3>") {
    echo $outputfooter;   
} else {
    ?>

            <!-- Begin Enhanced Footer -->
                <div class="footer-clean d-none d-md-block bg-dark text-bg-dark" style="background: var(--bs-white);width: 100%;!margin-bottom: 56px;">
                    <div class="container" style="width: 100%;">
                        <div class="row justify-content-center" style="width: 100%;">
                            <div class="col-sm-4 col-md-3 item">
                                <h3>Website</h3>
                                <ul>
                                    <li><a href="<?php echo $HomeURL; ?>">Home</a></li>
                                    <li><a href="/search">Search</a></li>
                                    <li><a href="<?php echo $PrivacyURL; ?>">Privacy</a></li>
                                    <li><a href="/help">Help</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3 item">
                                <h3>Network</h3>
                                <ul>
                                    <!--
                                    <li><a href="/stream">Stream</a></li>
                                    <li><a href="/connections">Connections</a></li>
                                    -->
                                    <li><a href="/directory?f=&pubforums=0&global=0">Directory</a></li>
                                    <li><a href="/directory?f=&pubforums=1&global=0">Forums</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3 item">
                            <!--
                                <h3>Account</h3>
                                <ul>
                                    <li><a href="/hq">Headquarters</a></li>
                                    <li><a href="/channel">Channel</a></li>
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="/settings">Settings</a></li>
                                </ul>
                                -->
                            </div>
                            <div class="col-lg-3 item social">
                            <?php if ($WebsiteChannel != "") { ?>
						        <a href="<?php echo $WebsiteChannel; ?>"><i class="icon icon-hz-64"></i></a>
                            <?php } ?>
                            <?php if ($SocialMastodon != "") { ?>
						        <a href="<?php echo $SocialMastodon; ?>" target="_blank"><i class="icon fab fa5-mastodon"></i></a>
                            <?php } ?>
                            <?php if ($SocialFacebook != "") { ?>
						        <a href="<?php echo $SocialFacebook; ?>" target="_blank"><i class="icon fa fa-facebook"></i></a>
                            <?php } ?>
                            <?php if ($SocialTwitter != "") { ?>
						        <a href="<?php echo $SocialTwitter; ?>" target="_blank"><i class="icon fa fa-twitter"></i></a>
                            <?php } ?>
                            <?php if ($SocialLinkedIn != "") { ?>
						        <a href="<?php echo $SocialLinkedIn; ?>" target="_blank"><i class="icon fa fa-linkedin"></i></a>
                            <?php } ?>                            
                            <?php if ($SocialYouTube != "") { ?>
						        <a href="<?php echo $SocialYouTube; ?>" target="_blank"><i class="icon fa fa-youtube"></i></a>
                            <?php } ?>
                            <?php if ($SocialDigitalAuthorship != "") { ?>
						        <a href="<?php echo $SocialDigitalAuthorship; ?>" target="_blank"><i class="icon icon-hz-64"></i></a>
                            <?php } ?>
                            <?php if ($SocialInstagram != "") { ?>
						        <a href="<?php echo $SocialInstagram; ?>" target="_blank"><i class="icon fa fa-instagram"></i></a>
                            <?php } ?>
                            <?php if ($SocialGithub != "") { ?>
						        <a href="<?php echo $SocialGithub; ?>" target="_blank"><i class="icon fa fa-github"></i></a>
                            <?php } ?>
                            <?php if ($SocialGitlab != "") { ?>
						        <a href="<?php echo $SocialGitlab; ?>" target="_blank"><i class="icon fa fa-gitlab"></i></a>
                            <?php } ?>
                            <?php if ($SocialGit != "") { ?>
						        <a href="<?php echo $SocialGit; ?>" target="_blank"><i class="icon fa fa-git"></i></a>
                            <?php } ?>                                                        
                            <?php if ($SocialPatreon != "") { ?>
						        <a href="<?php echo $SocialPatreon; ?>" target="_blank"><i class="icon fab fa5-patreon"></i></a>
                            <?php } ?>                                         
						<?php /*
						<a href="#"><i class="icon ion-social-facebook"></i></a>
						<a href="#"><i class="icon ion-social-twitter"></i></a>
						<a href="#"><i class="icon ion-social-snapchat"></i></a>
						<a href="#"><i class="icon ion-social-instagram"></i></a>
						*/ ?>
                                <p class="copyright"><?php echo $Copyright; ?></p>
                            </div>
                        </div>
                    </div>
                </div>	
            <!-- End Enhanced Footer -->

            <?php
}
?>

                
        </div>
        



            <?php if(x($page,'footer-sticky')) echo $page['footer-sticky']; ?>
        
        
            <div class="footer fixed-bottom">
            
            <div class="bg-white sticky-footer border-top">
                <div class="container my-auto">
                    <nav class="navbar navbar-light navbar-expand-md">
                        <div class="container-fluid"><a class="navbar-brand" href="/"><?php echo $SiteNameinFooterText; ?></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1" style="font-size: 12px;"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                            <div class="collapse navbar-collapse" id="navcol-1">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item"><a class="nav-link !active" href="/">Home</a></li>
                                    <!-- <li class="nav-item"><a class="nav-link" href="/network">Stream</a></li> -->
                                    <li class="nav-item"><a class="nav-link" href="/directory">Directory</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/search">Search</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/help">Help</a></li>
							<span class="d-block d-md-none">
							<li class="nav-item"><a class="nav-link" href="/help/TermsOfService">Terms of Use &amp; Privacy</a></li>
							</span>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class="text-center my-auto copyright mb-20 d-none d-sm-none">
                        <span style="margin: 5px;">Copyright &copy; 2022 <a href="https://wistex.com" class="text-decoration-none">WisTex TechSero Ltd. Co.</a> All rights reserved.</span><br>
                        <span style="margin: 5px;">An independent <a href="https://federatedhub.org" class="text-decoration-none" target="_blank">federated hub</a>.</span>
					<span style="margin: 5px;">Powered by <a href="https://hubzilla.org" class="text-decoration-none" target="_blank">Hubzilla</a> and <a href="https://neuhub.org" class="text-decoration-none" target="_blank">Neuhub</a>.</span>
                        <!--
					<span style="margin: 5px;"><a href="/help/TermsOfService" class="text-decoration-none">Terms of Service</a></span>
                        <span style="margin: 5px;"><a href="/help/TermsOfService" class="text-decoration-none">Privacy Policy</a></span><br>&nbsp;
	          -->
	          <span style="margin: 5px;"><a href="/help/TermsOfService" class="text-decoration-none">Terms of Use &amp; Privacy</a></span><br>&nbsp;
                    </div>
                </div>
            </div>
            </div> <!-- fixed botton -->
        </div><!-- <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a> -->
    </div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel"><i class="fas fa-columns"></i> Aside</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body" id="!region_1">
    <!-- <?php if(x($page,'aside')) echo $page['aside']; ?> -->
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
    <script src="/view/theme/neuhub-red-dash/assets/js/bs-init.js"></script>
    <script src="/view/theme/neuhub-red-dash/assets/js/theme.js"></script>
    
    <script src="/view/theme/neuhub-red-dash/js/prism-coy-full.js"></script>
    
</body>

</html>