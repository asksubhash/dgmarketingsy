<?php

function url_active($url_get)
{
	if (!empty($url_get)) {
		$active = '';
		if ($url_get == 'page/service') {
			$active = 'service_active';
		} else if ($url_get == 'page/about') {
			$active = 'about_active';
		} else if ($url_get == 'page/contact') {
			$active = 'contact_active';
		} else if ($url_get == '') {
			$active = 'home_active';
		} else if ($url_get == 'home') {
			$active = 'home_active';
		} else if ($url_get == 'blog') {
			$active = 'blog_active';
		} else if ($url_get == 'blog/index') {
			$active = 'blog_active';
		}

		return $active;
	}
}
