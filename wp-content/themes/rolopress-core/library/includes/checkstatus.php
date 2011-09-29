<?php 

function getSkypeStatus($username) {
    	
 	$context = stream_context_create(array('http' => array('header'=>'Connection: close')));
 	
    $data = @file_get_contents('http://204.9.163.163/' . $username . '.xml',0,$context);
    
    $status = strpos($data, '<presence xml:lang="en">Offline</presence>') ? 'offline' : 'online';
      
   	return $status;
}

//print_r( $_POST['usernames'] );


//$_POST['usernames'] = array("aires.ana","nunomorgadinho");

$result = array();

foreach($_POST['usernames'] as $key=>$username)
{
	$result[$key]=  getSkypeStatus($username);
}

echo json_encode($result);

?>