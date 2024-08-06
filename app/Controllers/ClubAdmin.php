<?php

namespace App\Controllers;


class ClubAdmin extends BaseController {


	public function __construct()
	{


		//Code here that checks the subdomain against the DB.


		$this->arrDB = ['test'];

		$this->viewData = array(
			"viewFolder" => "club"
		);


	}

    public function index($paramClub = false)
    {  		
		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    	return $this->render_page($this->viewData);
	}

	

	public function finance($paramClub = false)
    {  		
		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    
    	return $this->render_page($this->viewData);
	}



}