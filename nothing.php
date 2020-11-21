<?php language_atributes(); ?>
<?php bloginfo('charset'); ?>
<?php wp_head(); ?>
<?php body_class(); ?>
<?php wp_footer(); ?>
<?php

add_action('after_setup_theme', 'comet_function');
function comet_function(){

	load_theme_textdomain('comet', get_template_directory().'/lang');
	add_theme_support('title_tag');
	add_theme_support('post_thumbnails');
	add_theme_suppport('post_formates', array(
			'image',
			'audio',
			'video',
			'gallery',
			'quote'

		))

}


function comet_fonts(){
	$fonts= array();
	$fonts[]= 'Montserrat:400,700';
	$fonts[]= 'Raleway:300,400,500';
	$fonts[]= 'Halant:300,400';

	$comet_fonts = add_query_arg(array(
		'family' = urlencode(implode('|', $fonts)),
		'subset' = 'latin'

		),'https://fonts.googleapis.com/css');
	return $comet_fonts;

}

add_action('wp_enque_scripts', 'comet_style');
function comet_style(){
	wp_enqueue_style('bundle', get_template_directory_uri().'/css/bundle.css');
	wp_enqueue_style('style', get_template_directory_uri().'/css/style.css');
	wp_enqueue_style('fonts', comet_fonts());

}

add_action('wp_enqueue_scripts', 'conditional_scrits');
function conditional_scrits(){
	wp_enqueue_script('html5shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js');
	wp_script_add_data('html5shim', 'conditional', 'lt IE 9');
	wp_enqueue_script('respond', 'https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js');
	wp_script_add_data('respond', 'condiitonal', 'lt IE 9');

}

add_action('wp_enqueue_scripts', 'main_scripts');
function main_scripts(){
	wp_enqueue_script('jq', get_template_directory_uri().'js/jquery.js');
	wp_enqueue_script('bundle', get_template_directory_uri().'js/bundle.js', array('jq'), '', true);
	wp_enqueue_script('googlemap', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array('jq'), '', true);
	wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array('jq','bundle'), '', true);
}