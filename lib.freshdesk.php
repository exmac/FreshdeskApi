<?php
define('FRESHDESK_API_DOMAIN' , "myfreshdeskurl.freshdesk.com"); // Your FreshDesk URL
define( 'FRESHDESK_API_USERNAME' , "XXXXXXXXXXXXXXXXXX"); // Found by logging into your Freshdesk, then hover over name on upper right, and click on Profile. API_USERNAME==API Key found on the right hand side.
define( 'FRESHDESK_API_PASSWORD' , "X"); // Don't change

function create_ticket($email, $subject, $name='',$description='') {

	$ticket = new DomDocument('1.0');
	$ticket_root = $ticket->appendChild($ticket->createElement('helpdesk_ticket'));
	
	$email_tag = $ticket_root->appendChild($ticket->createElement('email'));
	$email_tag->appendChild($ticket->createTextNode($email));
	
	$subject_tag = $ticket_root->appendChild($ticket->createElement('subject'));
	$subject_tag->appendChild($ticket->createTextNode($subject));
	
	if ($name != '') {
		$subject_tag = $ticket_root->appendChild($ticket->createElement('name'));
		$subject_tag->appendChild($ticket->createTextNode($name));
	}
	
	if ($description != '') {
		$description_tag = $ticket_root->appendChild($ticket->createElement('description'));
		$description_tag->appendChild($ticket->createTextNode($description));
	}
	
	
	$source = $ticket_root->appendChild($ticket->createElement('source'));
	$source->appendChild($ticket->createTextNode("2"));
	
	$xmlOutput = $ticket->saveXML();
	
	$process = curl_init('http://'.FRESHDESK_API_DOMAIN.'/helpdesk/tickets.xml');                                                                         
	curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));              
	curl_setopt($process, CURLOPT_HEADER, 1);
	curl_setopt($process, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);                                                                            
	curl_setopt($process, CURLOPT_USERPWD, FRESHDESK_API_USERNAME . ":" . FRESHDESK_API_PASSWORD);                                                
	curl_setopt($process, CURLOPT_TIMEOUT, 30);                                                                         
	curl_setopt($process, CURLOPT_POST, 1);                                                                             
	curl_setopt($process, CURLOPT_POSTFIELDS, $xmlOutput);                                                            
	curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);                                                                
	$response = curl_exec($process);  
	
	$http_status_code = curl_getinfo($process, CURLINFO_HTTP_CODE);
	return ($http_status_code == '200');
	
}