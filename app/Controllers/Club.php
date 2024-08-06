<?php

namespace App\Controllers;


class Club extends BaseController {


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

	

	public function login($paramClub = false)
    {  		

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    
    	return $this->render_page($this->viewData);
	}

	public function teams($paramClub = false)
    {  		

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    
    	return $this->render_page($this->viewData);
	}

	public function about($paramClub = false)
    {  		

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    
    	return $this->render_page($this->viewData);
	}

	public function join($paramClub = false)
    {  		

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    
    	return $this->render_page($this->viewData);
	}

	public function contact($paramClub = false)
    {  		

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    
    	return $this->render_page($this->viewData);
	}

	public function findus($paramClub = false)
    {  		

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    
    	return $this->render_page($this->viewData);
	}



}