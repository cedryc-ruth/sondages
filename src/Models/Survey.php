<?php
namespace App\Models;

class Survey {
	
	private $id;
	private $owner;
	private $question;
	private $responses;

	public function __construct($owner, $question) {
		$this->id = null;
		$this->owner = $owner;
		$this->question = $question;
		$this->responses = array();
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function addResponse($response) {
		$this->responses[] = $response;
	}

	public function getId() {
		return $this->id;
	}

	public function getOwner() {
		return $this->owner;
	}
	
	public function getQuestion() {	
		return $this->question;
	}

	public function getResponses() {
		return $this->responses;
	}
	
	public function computePercentages() {
		$total = 0;
	    foreach($this->getResponses() as $response){
	        $total += $response->getCount();
	    }
	    foreach($this->getResponses() as $response2){
	        $response2->computePercentage($total);
	    }
	}

}
?>
