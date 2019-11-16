<?php
	/*$client = new MongoClient;
	$db=$client->airbnb;
	$collection=$db->host;*
	//$query='{"listings.city":"Pune"}';
				//echo $query;
	$doclist=$collection->find(
		array(
			"listings.listing_id"=> new MongoId('57e2b1666803fa31158b4569')
			)
		);

	//var_dump($doclist);
	foreach ($doclist as $doc) {
		var_dump($doc);
		
		# code...
	}*/
	$client = new MongoClient;
	$db=$client->airbnb;
	$collection=$db->host;

	$res=$collection->update(
						array(
							"email"=>'mandarmahajan1996@gmail.com',
							),
						array(
							'$set'=>array(
								"fname"=>'Mandar',
								)
							)
						);
	var_dump($res);

	/*$res=$collection->update(
		array(
			"name"=>"arr"
			),
		array(
			'$push'=>array(
				"interested"=>"rahul"
				)
			),
		array('upsert' => true )
		);
	var_dump($res);*/
	//$str=json_encode(array("name"=>"arr"),array("$push"=>array("interested"=>"atharva")));
	//echo $str;
	//$arr=json_decode('{"name":"arr"},{"push":{"interested":"karan"}}');
	//print_r($arr);
	//var_dump($res);
	/*$temp=json_encode(
		array(
			"listings"=>array(
				array(
					"listing_id" => '57e2b1666803fa31158b4569'
				)
				)
			),
		JSON_PRETTY_PRINT
		);*/
	//$temp=json_decode({"listings.listing_id":"57e2b1666803fa31158b4569"});
	//echo $temp;
?>