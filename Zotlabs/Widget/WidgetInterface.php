<?php

// Modified from Streams for use in Hubzilla
// https://codeberg.org/streams/streams/src/branch/release/Code/Widget/WidgetInterface.php

namespace Zotlabs\Widget;

interface WidgetInterface
{
    public function widget(array $arguments): string;
}
