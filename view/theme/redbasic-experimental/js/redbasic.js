/**
 * redbasic theme specific JavaScript
 */

$(document).ready(function() {

	// CSS3 calc() fallback (for unsupported browsers)
	$('body').append('<div id="css3-calc" style="width: 10px; width: calc(10px + 10px); display: none;"></div>');
	if( $('#css3-calc').width() == 10) {
		$(window).resize(function() {
			if($(window).width() < 992) {
				$('main').css('width', $(window).width() + $('aside').outerWidth() );
			} else {
				$('main').css('width', '100%');
			}
		});
	}
	$('#css3-calc').remove(); // Remove the test element

	if (document.querySelector('#region_1')) {
		stickyScroll('.aside_spacer_left', '.aside_spacer_top_left', '.content', parseFloat(window.getComputedStyle(document.querySelector('#region_1')).getPropertyValue('padding-top')), 0);
	}

	if (document.querySelector('#region_3')) {
		stickyScroll('.aside_spacer_right', '.aside_spacer_top_right', '.content', parseFloat(window.getComputedStyle(document.querySelector('#region_3')).getPropertyValue('padding-top')), 20);
	}

	$('#expand-aside').on('click', function() {
		if($('main').hasClass('region_1-on')){
			toggleAside('left');
		}
		else {
			toggleAside('right');
		}
	});

	$('.usermenu').click(function() {
		if($('#navbar-collapse-1, #navbar-collapse-2').hasClass('show')){
			$('#navbar-collapse-1, #navbar-collapse-2').removeClass('show');
		}
	});

	$('#menu-btn').click(function() {
		if($('#navbar-collapse-1').hasClass('show')){
			$('#navbar-collapse-1').removeClass('show');
		}
	});

	$('.notifications-btn').click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		if($('#navbar-collapse-2').hasClass('show')){
			$('#navbar-collapse-2').removeClass('show');
		}
	});

	$("input[data-role=cat-tagsinput]").tagsinput({
		tagClass: 'badge rounded-pill bg-warning text-dark'
	});

	$('a.disabled').click(function(e) {
		e.preventDefault();
		e.stopPropagation();
	});

	var doctitle = document.title;
	function checkNotify() {
		var notifyUpdateElem = document.getElementById('notify-update');
		if(notifyUpdateElem !== null) {
			if(notifyUpdateElem.innerHTML !== "")
				document.title = "(" + notifyUpdateElem.innerHTML + ") " + doctitle;
			else
				document.title = doctitle;
		}
	}
	setInterval(function () {checkNotify();}, 10 * 1000);

	var touch_start = null;
	var touch_max = window.innerWidth / 10;

	window.addEventListener('touchstart', function(e) {
		if (e.touches.length === 1){
			//just one finger touched
			touch_start = e.touches.item(0).clientX;
			if (touch_start < touch_max) {
				$('html, body').css('overflow-y', 'hidden');
			}
		}
		else {
			//a second finger hit the screen, abort the touch
			touch_start = null;
		}
	});

	window.addEventListener('touchend', function(e) {
		$('html, body').css('overflow-y', '');

		let touch_offset = 30; //at least 30px are a swipe
		if (touch_start) {
			//the only finger that hit the screen left it
			let touch_end = e.changedTouches.item(0).clientX;

			if (touch_end > (touch_start + touch_offset)) {
				//a left -> right swipe
				if (touch_start < touch_max) {
					toggleAside('right');
				}
			}
			if (touch_end < (touch_start - touch_offset)) {
				//a right -> left swipe
				//toggleAside('left');
			}
		}
	});

	$(document).on('hz:hqControlsClickAction', function(e) {
		toggleAside('left');
	});

});

function setStyle(element, cssProperty) {
	for (var property in cssProperty){
		element.style[property] = cssProperty[property];
	}
}

function stickyScroll(sticky, stickyTop, container, topOffset, bottomOffset) {

	var lastScrollTop = 0;
	var sticky = document.querySelector(sticky);

	if (!sticky) {
		return;
	}

	var stickyHeight = sticky.getBoundingClientRect().height;
	var stickyTop = document.querySelector(stickyTop);
	var content = document.querySelector(container);
	var diff = window.innerHeight - stickyHeight;
	var h = 0;
	var lasth = 0;
	var st = window.pageYOffset || document.documentElement.scrollTop;

	var resizeObserver = new ResizeObserver(function(entries) {
		stickyHeight = sticky.getBoundingClientRect().height;
		st = window.pageYOffset || document.documentElement.scrollTop;
		diff = window.innerHeight - stickyHeight;
	});

	resizeObserver.observe(sticky);
	resizeObserver.observe(content);

	window.addEventListener('scroll', function() {
		if(window.innerHeight > stickyHeight + topOffset) {
			setStyle(stickyTop, { height: 0 + 'px' });
			setStyle(sticky, { position: 'sticky', top: topOffset + 'px'});
		}
		else {
			st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
			if (st > lastScrollTop){
				// downscroll code
				setStyle(stickyTop, { height: lasth + 'px' });
				setStyle(sticky, { position: 'sticky', top: Math.round(diff) - bottomOffset + 'px', bottom: '' });
			} else {
				// upscroll code
				h = sticky.getBoundingClientRect().top - content.getBoundingClientRect().top - topOffset;
				if(Math.round(stickyTop.getBoundingClientRect().height) === lasth) {
					setStyle(stickyTop, { height: Math.round(h) + 'px' });
				}
				lasth = Math.round(h);
				setStyle(sticky, { position: 'sticky', top: '', bottom: Math.round(diff - topOffset) + 'px' });
			}
			lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
		}
	}, false);

}

function makeFullScreen(full) {
	if(typeof full=='undefined' || full == true) {
		$('main').addClass('fullscreen');
		$('header, nav, aside, #fullscreen-btn').attr('style','display:none !important');
		$('#inline-btn').show();
	}
	else {
		$('main').removeClass('fullscreen');
		$('header, nav, aside, #fullscreen-btn').show();
		$('#inline-btn').hide();
	}
}

function toggleAside(swipe) {

	if ($('main').hasClass('region_1-on') && swipe === 'left') {
		$('#expand-aside-icon').addClass('fa-arrow-circle-right').removeClass('fa-arrow-circle-left');
		$('html, body').css({ 'position': '', left: '' });
		$('main').removeClass('region_1-on');
		$('#overlay').remove();
	}
	if (!$('main').hasClass('region_1-on') && swipe === 'right') {
		$('#expand-aside-icon').removeClass('fa-arrow-circle-right').addClass('fa-arrow-circle-left');
		$('html, body').css({ 'position': 'sticky',  'left': '0px'});
		$('main').addClass('region_1-on');
		$('<div id="overlay"></div>').appendTo('body').one('click', function() { toggleAside('left'); });
	}
}
