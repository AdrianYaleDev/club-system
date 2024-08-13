<?php

namespace App\Controllers;
use CodeIgniter\Controller;

// Model Imports.
use App\Models\ValidationModel;
use App\Models\UsersModel;
use App\Models\ClubsModel;
use App\Models\PasswordModel;
use Config\Services;

class Home extends BaseController {

	public function __construct()
	{
		$this->arrDB = ['test'];

		$this->viewData["viewFolder"] = "main";
		$this->session = \Config\Services::session();

	}


	public function index($param = false)
    {  
		
		

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "home";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = [];

    
    	return $this->render_page($this->viewData);
	}


	public function register()
	{

		$this->viewData["pageTitle"] = "Home";
		$this->viewData["viewName"] = "register";
		$this->viewData["viewData"] = [];
		$this->viewData["stylesheet"] = ['main'];
		$this->viewData["javascript"] = ['register'];


    	return $this->render_page($this->viewData);
	}

	public function signup()
	{
		
		$this->validationModel = new ValidationModel();
		$request = \Config\Services::request();

		$arrReturn = array(
			'success' => 'true'
		);

		// Loop through all inputs and validate the contents.
		$arrInputs = $request->getGet();
		foreach($arrInputs as $strName => $strValue) {
			$arrResults = $this->validationModel->validateInputs($strName, $strValue);
			if($arrResults['error'] == true) {
				// We;ll also give messages etc to send back to the front end.
				$arrReturn['success'] = false;
				$arrReturn['errors'][$arrResults['field']] = $arrResults['error'];
			}
		}

		// Failed first pass validation. Return content here.
		if(isset($arrReturn['error'])){
			echo json_encode($arrReturn);
			exit();
		}

		// Lets check the users Email does not exist already.
		$this->usersModel = new UsersModel();
		$strUserEmail = $arrInputs['email_e'];
		$bExistingUser = $this->usersModel->checkForExistingUser($strUserEmail);

		// If the user is an existing user lets halt here.
		if($bExistingUser) {
			$arrReturn['success'] = false;
			$arrReturn['errors']['email'] = 'User already exists.';
		}

		// Now check if the club is an existing club.
		$this->clubsModel = new ClubsModel();
		$strClubName = $arrInputs['clubname_s'];
		$bExistingClub = $this->clubsModel->checkForExistingClub($strClubName);

		// If the user is an existing user lets halt here.
		if($bExistingClub) {
			$arrReturn['success'] = false;
			$arrReturn['errors']['club'] = 'Club already exists.';
		}

		if(!$arrReturn['success']) {
			echo json_encode($arrReturn);
			exit();
		}

		// Now lets Salt and sanitize the password before passing to the UserData.
		$this->passwordModel = new PasswordModel();

		// Create Salt

		$strSalt = $this->passwordModel->createSalt();

		$strHashedPass = $this->passwordModel->createHashedPassword($arrInputs['password_p'], $strSalt);
		// Create Salted Password
		// Create User, Store Salt AND Salted Password.

		$arrUserData = [
			'first_name' => $arrInputs['firstname_s'],
			'last_name' => $arrInputs['lastname_s'],
			'salt' => $strSalt,
			'pass'  => $strHashedPass,
			'email' => $arrInputs['email_e'],
		];
			
		// Create the user and Return the User ID (Used to assign to the Club).
		$iUserID = $this->usersModel->createUser($arrUserData);

		// Now we have created the user, lets check if the user was created first. If it failed for some reason lets show the user a generic error message.
		if(!$iUserID) {
			$arrReturn['success'] = false;
			$arrReturn['errors']['error'] = 'We have experienced an error with code 001, please contact the admin';
			echo json_encode($arrReturn);
			exit();
		}

		$arrClubData = [
			'clubname' => $arrInputs['clubname_s'],
			'sport' => $arrInputs['sport_s']
		];
		
		// Now lets create the Club and assign the user ID as a CSV to the Admin area of it.
		$iClubID = $this->clubsModel->createClub($arrClubData);
		
		// Now we link the user and club together and set the user to be an admin. 
		// This would be on a user_assignment table which has a Many to one relationship
		// As this is the sign up we want this first user to always be an Admin hence the True call.
		$this->usersModel->createClubAssociation($iUserID, $iClubID, true);

		// Now we have created a User, Club and Admin user for that club Lets drop some information into the return array.

		$arrReturn['club'] = $arrInputs['clubname_s'];

		//Now we are about to return lets create the session to log the user
		// Set session data
		session()->destroy();
		session()->set('logged_in' , 1);


		
		$sessional = [
			'user_id' => $iUserID,
			'loggedIn' => true,
		];
		$this->session->set($sessional);



		// session()->set('user_id' , $iUserID);
		// echo '<pre>' . print_r(session(),1) .'</pre>';
		// die();
		
		// $_SESSION['user_id'] = $iUserID;
		echo json_encode($arrReturn);

	}

	public function pricing()
	{

	}

	public function product()
	{

	}

	public function contactus()
	{


	}

	public function privacy()
	{


	}


}