<?php
$datetime = date("Y-m-d H:i:s");
$time = strtotime($datetime);
$date = date('Y-m-d H:i:s', $time);

echo var_dump($date);

$query    = new WP_Query( [
	'post_type'      => 'immolive',
	'posts_per_page' => 3,
	'meta_query'     => [
		'realtion' => 'AND',
		[
			'key'     => 'termin',
			'compare' =>  '>=',
			'value'   => $date,
			'type'    => 'DATETIME',
		],
		[
			'key'     => 'termin',
			'compare' =>  '<=',
			'value'   => $date = date('Y-m-d H:i:s'),
			'type'    => 'DATETIME',
		],
	],
] );

echo var_dump($query->post_count);
