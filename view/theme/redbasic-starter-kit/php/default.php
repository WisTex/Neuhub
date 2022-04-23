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

<link rel="stylesheet" href="https://completehostingguide.com/library/fork-awesome/css/fork-awesome.min.css?v=7.2" type="text/css" media="screen">
<link rel="stylesheet" href="https://completehostingguide.com/vendor/twbs/bootstrap/dist/css/bootstrap.min.css?v=7.2" type="text/css" media="screen">
<link rel="stylesheet" href="https://completehostingguide.com/library/bootstrap-tagsinput/bootstrap-tagsinput.css?v=7.2" type="text/css" media="screen">
<link rel="stylesheet" href="https://completehostingguide.com/view/css/bootstrap-red.css?v=7.2" type="text/css" media="screen">
<link rel="stylesheet" href="https://completehostingguide.com/library/datetimepicker/jquery.datetimepicker.css?v=7.2" type="text/css" media="screen">
<link rel="stylesheet" href="https://completehostingguide.com/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css?v=7.2" type="text/css" media="screen">  

<script src="https://completehostingguide.com/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js?v=7.2" ></script>
<script src="https://completehostingguide.com/library/bootbox/bootbox.min.js?v=7.2" ></script>
<script src="https://completehostingguide.com/library/bootstrap-tagsinput/bootstrap-tagsinput.js?v=7.2" ></script>
<script src="https://completehostingguide.com/library/datetimepicker/jquery.datetimepicker.js?v=7.2" ></script>
<script src="https://completehostingguide.com/library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js?v=7.2" ></script>
<script src="https://completehostingguide.com/view/theme/redbasic/js/redbasic.js?v=7.2" ></script>

  <script>var baseurl="<?php echo z_root() ?>";</script>

  <?php if(x($page,'htmlhead')) echo $page['htmlhead'] ?>
</head>
<body <?php if($page['direction']) echo 'dir="rtl"' ?> >
	<?php if(x($page,'banner')) echo $page['banner']; ?>
	<header><?php if(x($page,'header')) echo $page['header']; ?></header>
	<?php if(x($page,'nav')) echo $page['nav']; ?>
	<main>
		<div class="content">
			<div class="columns">
				<aside id="region_1"><div class="aside_spacer_top_left"></div><div class="aside_spacer_left"><div id="left_aside_wrapper" class="aside_wrapper"><?php if(x($page,'aside')) echo $page['aside']; ?></div></div></aside>
				<section id="region_2"><?php if(x($page,'content')) echo $page['content']; ?>
					<div id="page-footer"></div>
					<div id="pause"></div>
				</section>
				<aside id="region_3" class="d-none d-xl-block"><div class="aside_spacer_top_right"></div><div class="aside_spacer_right"><div id="right_aside_wrapper" class="aside_wrapper"><?php if(x($page,'right_aside')) echo $page['right_aside']; ?></div></div></aside>
			</div>
		</div>
	</main>
	<footer><?php if(x($page,'footer')) echo $page['footer']; ?></footer>
</body>
</html>
