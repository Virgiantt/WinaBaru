<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'] = array(
	'class'    => 'SessionHook',
	'function' => 'checkSessionStatus',
	'filename' => 'SessionHook.php',
	'filepath' => 'hooks'
);