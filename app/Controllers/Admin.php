<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\ClubsModel;
use App\Models\PasswordModel;

class Admin extends BaseController {

	private $iClubID;

	public function __construct()
	{


		//Code here that checks the subdomain against the DB.


		$this->arrDB = ['test'];

		$this->viewData = array(
			"viewFolder" => "club/admin"
		);
		


	}

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

		$this->clubsModel = new ClubsModel();
		$strClubName = explode('.', $_SERVER['HTTP_HOST'])[0];
		$this->iClubID = $this->clubsModel->getClubID($strClubName);
		


		/*

		Simple Query builder. Use this in models to start with.
		$db = db_connect();
		$content = $db->query('SELECT * FROM secondary');
		$test = $content->getResult();

		*/
        // Preload any models, libraries, etc, here.

        // $this->session = \Config\Services::session();

		// echo '<pre>' . print_r($_SESSION,1) .'</pre>';

		// $newData = [
        //     'test'    => 'Content'
        // ];

        // $this->session->set($newData);
		// $session = service('session');

		$this->session = \Config\Services::session();
			
echo 'Hallo';
		echo '<pre>' . print_r($_SESSION,1) .'</pre>';

    }


    public function index($paramClub = false)
    {  		

		echo '<pre>' . print_r($this->session,1) .'</pre>';

		if (!$this->session->has('logged_in')) {

			$redirectUrl = $this->getFullUrl('admin/login');
            return redirect()->to($redirectUrl);
        }

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    	return $this->render_page($this->viewData);
	}

	public function login()
	{

		$request = \Config\Services::request();
		if($arrInputs = $request->getGet()) {

			$iUserId = '';




			$strEmail = $arrInputs['email_e'];
			$strPass = $arrInputs['password_p'];

			$this->userModel = new UsersModel();
			if($arrUserID = $this->userModel->checkForExistingUser($strEmail)) {
				echo 'UserExists <br>	';
				$iUserId = $arrUserID[0]->id;
				echo $iUserId;
			} else {
				echo 'No User';
				$this->viewData['error'] = 'Please check the username and / or password';
			}

			$strPassword = $arrInputs['password_p'];

			if($iUserId) {

				// Lets check the user is associated with the club in question.
				$bUserClubAssociation = $this->userModel->checkClubAssociation($iUserId, $this->iClubID);


				if($bUserClubAssociation) {
					var_dump($bUserClubAssociation);
				
					$strSalt = $this->userModel->getUserSalt($iUserId);
					echo $strSalt .'<br>';
					$this->passwordModel = new PasswordModel();
	
					$strHashedPass = $this->passwordModel->createHashedPassword($strPass, $strSalt);
	
					echo $strHashedPass.'<br>';
					
					$bPasswordCheck = $this->passwordModel->checkPassword($strHashedPass, $iUserId);
	
	
					if($bPasswordCheck) {
						echo 'Passed';
						session()->destroy();
						session()->set('logged_in' , 1);
	
	
						$sessional = [
							'user_id' => $iUserId,
							'loggedIn' => true,
						];
						$this->session->set($sessional);
	
						echo '<pre>' . print_r($_SESSION,1) .'</pre>';
	
						// $redirectUrl = $this->getFullUrl('admin');
						// return redirect()->to($redirectUrl);
	
					} else {
						$this->viewData['error'] = 'Please check the username and / or password';
					}
				} else {
					$this->viewData['error'] = 'Please check the username and / or password';
				}
				

			}

		} 


		$this->viewData["pageTitle"] = "Login";
		$this->viewData["viewName"] = "login";
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