<?php

namespace My_Theme;

use My_Core\Plugins\Yoast;

defined( 'ABSPATH' ) || exit;

Yoast::get_breadcrumbs( '<div class="my-breadcrumbs">', '</div>' );
