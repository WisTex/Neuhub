<?php
/**
 *   * Name: default
 *   * Description: Hubzilla default 3-column layout
 *   * Version: 1
 *   * Author: Mario Vavti
 *   * Maintainer: Mario Vavti
 *   * ContentRegion: aside, left_aside_wrapper
 *   * ContentRegion: content, region_2
 *   * ContentRegion: right_aside, right_aside_wrapper
 */
?>
<!DOCTYPE html >
<html prefix="og: http://ogp.me/ns#">
<head>
  <title><?php if(x($page,'title')) echo $page['title'] ?></title>
  <script>var baseurl="<?php echo z_root() ?>";</script>
  <?php if(x($page,'htmlhead')) echo $page['htmlhead'] ?>
  
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- <title>Neuhub Test</title> -->
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/fonts/ionicons.min.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Highlight-Phone.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/Projects-Clean.css">
    <link rel="stylesheet" href="/view/theme/neuhub-red-dash/assets/css/styles.css">  
  
</head>
<body <?php if($page['direction']) echo 'dir="rtl"' ?> style="width: 100%;background: #f8f9fc;">
	<?php if(x($page,'banner')) echo $page['banner']; ?>
	<header><?php if(x($page,'header')) echo $page['header']; ?></header>
	<?php if(x($page,'nav')) echo $page['nav']; ?>
	<main  class="" style="width: 100%;background: #f8f9fc;max-width: 100%;">
	

<!-- <body style="width: 100%;background: #f8f9fc;"> -->
    <div class="container" style="width: 100%;max-width: 100%;padding-right: 0px;padding-left: 0px;padding-top: 47px;background: #f8f9fc;">
        <div class="row justify-content-center" style="width: 100%;margin-right: 0px;margin-left: 0px;padding: 0px;">
            <div class="col-1 d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block" style="background: #43488A;min-width: 100px;text-align: center;color: var(--bs-gray-400);"><img src="/photo/profile/m/2" style="max-width: 64px;border-radius: 50px;width: 64px;margin-top: 20px;margin-bottom: 20px;">
                <p>Paragraph</p>
	 

	  
            </div>
            <div class="col" style="padding: 0px;background: #f8f9fc;">
                <div class="navbar navbar-light navbar-expand-lg navigation-clean-button d-none d-md-block" style="width: 100%;">
                    <div class="container"><a class="navbar-brand" href="#">Complete Hosting Guide</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navcol-1">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Roadmaps</a>
                                    <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                                </li>
                                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Guides</a>
                                    <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                                </li>
                                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Resources</a>
                                    <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#">Community</a></li>
                            </ul><span class="navbar-text actions"> <a class="login" href="#">Log In</a><a class="btn btn-light action-button" role="button" href="#">Sign Up</a></span>
                        </div>
                    </div>
                </div>
	  
	  <div class="row justify-content-center">
	  
                <ol class="breadcrumb" style="margin-left: 20px;margin-top: 16px;max-width: 1320px; align-items: center;">
                    <li class="breadcrumb-item"><a href="#"><span>Home</span></a></li>
                    <li class="breadcrumb-item"><a href="#"><span>Library</span></a></li>
                    <li class="breadcrumb-item"><a href="#"><span>Data</span></a></li>
                </ol>
                


		<div class="content" style="max-width: 1320px; align-items: center;">
			
			<div class="columns">
						
				<aside id="region_1" class="pt-0 pb-0"><div class="aside_spacer_top_left"></div><div class="aside_spacer_left"><div id="left_aside_wrapper" class="aside_wrapper">
				
				<?php if(x($page,'aside')) echo $page['aside']; ?>
				</div></div></aside>
				<section id="region_2" class="pt-0 pb-0" style="width: 100%; min-width: 400px;"><?php if(x($page,'content')) echo $page['content']; ?>
					<div id="page-footer"></div>
					<div id="pause"></div>
				</section>
				<aside id="region_3" class="d-none d-xl-block pt-0 pb-0"><div class="aside_spacer_top_right"></div><div class="aside_spacer_right"><div id="right_aside_wrapper" class="aside_wrapper">
				<?php if(x($page,'right_aside')) echo $page['right_aside']; ?>
				</div></div></aside>
			</div>
			
		</div>	
		
		</div> <!-- row -->



                <div class="footer-clean d-none d-md-block" style="background: var(--bs-white);width: 100%;">
                    <div class="container" style="width: 100%;">
                        <div class="row justify-content-center" style="width: 100%;">
                            <div class="col-sm-4 col-md-3 item">
                                <h3>Services</h3>
                                <ul>
                                    <li><a href="#">Web design</a></li>
                                    <li><a href="#">Development</a></li>
                                    <li><a href="#">Hosting</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3 item">
                                <h3>About</h3>
                                <ul>
                                    <li><a href="#">Company</a></li>
                                    <li><a href="#">Team</a></li>
                                    <li><a href="#">Legacy</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3 item">
                                <h3>Careers</h3>
                                <ul>
                                    <li><a href="#">Job openings</a></li>
                                    <li><a href="#">Employee success</a></li>
                                    <li><a href="#">Benefits</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                                <p class="copyright">WisTex TechSero Ltd. Co. © 2022</p>
                            </div>
                        </div>
                    </div>
                </div>	


            </div>
        </div>
    </div>
    <!-- <script src="/assets/bootstrap/js/bootstrap.min.js"></script> -->


	
	
	
  	
	
	
	
	
	

	</main>
	<footer><?php if(x($page,'footer')) echo $page['footer']; ?></footer>
	

	
</body>
</html>
