<?php

$root = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

$config['base_url'] = $root . 'dashboard/';

$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center ">';
$config['full_tag_close'] = '</ul></nav>';

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] =  '</li>';

$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] =  '</li>';

$config['next_link'] = '&raquo';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&laquo';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';

$config['attributes'] = ['class' => 'page-link'];
