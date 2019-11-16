<?php

	$client = new MongoClient;
	$db=$client->airbnb;
	$grid = $db->getGridFS();
	$id=new MongoId();
	$id=(string)$id;
	/*$res2=$grid->storeFile("/home/overlord1109/uploads/uploads.jpg", array('listing_id'=>$id));
	//var_dump($res);
	$res1=$grid->findOne(
		array(	
			"listing_id" => $id
			)
		);
	$im=$res->getBytes();
	$im=imagecreatefromstring($im);
	*/
	//$grid->remove();
	$res=$grid->find();
	foreach ($res as $file) {
		var_dump($file);
		
		# code...
	}
	//header("Content-Type: image/jpeg");
	//if(isset($res))
	//echo $res->getBytes();
	//var_dump($res);
?>