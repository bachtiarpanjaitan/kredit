<?php

return [
	'brand' => [
		'honda' => [
			'id' => 1,
			'name' => 'Honda',
		],
		'yamaha' => [
			'id' => 2,
			'name' => 'Yamaha'
		],
		'suzuki' => [
			'id' => 3,
			'name' => 'Suzuki'
		],
		'kawasaki' => [
			'id' => 4,
			'name' => 'Kawasaki'
		]
	],
	'type' => [
		'sport' => [
			'id' => 1,
			'name' => 'Sport'
		],
		'standard' => [
			'id' => 2,
			'name' => 'Stardard/Naked'
		],
		'cruiser' => [
			'id' => 3,
			'name' => 'Cruiser'
		],
		'trail' => [
			'id' => 4,
			'name' => 'Trail/ Off Road'
		],
		'bebek' => [
			'id' => 5,
			'name' => 'Bebek'
		],
		'matic' => [
			'id' => 6,
			'name' => 'Skuter Matik'
		],
		'bajaj' => [
			'id' => 7,
			'name' => 'Bajaj'
		]
	],
	'interest_type' => [
		'flat' => [
			'id' => 1,
			'name' => 'Flat'
		],
		'sliding_rate' => [
			'id' => 2,
			'name' => 'Sliding Rate'
		]
	],
	'credit_status' => [
		'idle' => [
			'id' => 1,
			'name' => 'IDLE'
		],
		'running' => [
			'id' => 2,
			'name' => "RUNNING"
		],
		'done' => [
			'id' => 3,
			'name' => 'DONE'
		]
	],
	'installment_status' => [
		'open' => [
			'id' => 1,
			'name' => 'Belum Lunas'
		],
		'close' => [
			'id' => 2,
			'name' => 'Lunas'
		]
	],
	'tenor' => [12,18,24,30,36],
	'downpayment' => [1000000,2500000,3500000,4000000,5500000,6000000],
	'default_otr' => 2000000,
	'default_interest' => 5,
	'months' => ['Januari', 'Februari',' Maret','April', 'Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
];