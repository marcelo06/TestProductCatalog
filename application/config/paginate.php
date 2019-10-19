<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config['uri_segment'] = 3;
$config['total_rows'] = 1;
$config['per_page'] = PAGER;
$config['num_links'] = 5;
$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';
$config['first_link'] = FALSE;
$config['last_link'] = FALSE;
$config['prev_link'] = '<i class="fa fa-chevron-left" aria-hidden="true"></i>';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
$config['cur_tag_close'] = '</li>';
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
$config['next_link'] = '<i class="fa fa-chevron-right" aria-hidden="true"></i>';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';