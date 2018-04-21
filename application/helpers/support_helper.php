<?php

function pagination($url = '', $limit, $total_cnt, $num_links = 10) {
	$CI =& get_instance();
	$CI->load->library('pagination');
	$paging = array();
	$paging["base_url"]				= $url;
	$paging["total_rows"]			= $total_cnt;
	$paging["per_page"]				= $limit;
	$paging["num_links"]			= $num_links;
	$paging['page_query_string']	= TRUE;
	$paging['full_tag_open']		= '<ul class="pagination">';
	$paging['cur_tag_open']				= '<li class="active"><a href="#">';
	$paging['cur_tag_close']			= '</a></li>';
	$paging['num_tag_open']				= '<li>';
	$paging['num_tag_close']			= '</li>';
	$paging['full_tag_close']		= '</ul>';
	$paging['first_link']			= '<span class="glyphicons glyphicons-rewind"></span>';
	$paging['first_tag_open']		= '<li>';
	$paging['first_tag_close']		= '</li>';

	$paging['prev_link']			= '<span class="glyphicons glyphicons-chevron-left"></span>';
	$paging['prev_tag_open']		= '<li>';
	$paging['prev_tag_close']		= '</li>';
	$paging['next_link']			= '<span class="glyphicons glyphicons-chevron-right"></span>';
	$paging['next_tag_open']		= '<li>';
	$paging['next_tag_close']		= '</li>';
	$paging['last_link']			= '<span class="glyphicons glyphicons-forward"></span>';
	$paging['last_tag_open']		= '<li>';
	$paging['last_tag_close']		= '</li>';
	$paging["uri_segment"]			= 3;
	$CI->pagination->initialize($paging);
	return $CI->pagination->create_links();
}
