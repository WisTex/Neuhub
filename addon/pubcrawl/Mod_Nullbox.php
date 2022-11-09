<?php

namespace Zotlabs\Module;


class Nullbox extends \Zotlabs\Web\Controller {

	function init() {
		http_status_exit(404,'Permission Denied');
	}
}

