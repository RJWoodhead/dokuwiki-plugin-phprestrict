<?php
/**
 * Default settings for the phprestrict plugin
 *
 * @author Robert Woodhead <trebor@animeigo.com>
 *
 * paths contains comma/newline-separated list of pagenames or namespaces. * can be added to
 * end to match prefix path
 *
 * Examples:
 *
 * fred:		Matches all pages under namespace fred
 * fred:derf	Matches page fred:derf only
 * fred:php*	Matches pages in fred that start with php
 *
 */

$conf['paths']	= '';
$conf['hide']	= 1;