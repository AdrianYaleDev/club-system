<?php
namespace App\Models;

use CodeIgniter\Model;

class ValidationModel extends Model
{
    protected $table = 'clubs';



    public function validateInputs($strName, $strValue)
    {

		// // Return array.
		$arrReturn = array(
			'error' => false
		);

		// // Remove extra spaces, newlines, tabs, etc.
		// // Convert special characters to HTML entities
		$strValue = trim($strValue);
		$strValue = htmlspecialchars($strValue, ENT_QUOTES, 'UTF-8');

	
		$arrNameArray = explode('_', $strName);
		$strValidationType = $arrNameArray[1];
		

		/*
			s - String, 
			sd - String from DB, 
			e - Email,
			p - Password
			i - Integer
		*/
		switch($strValidationType){
			case 's':
				$bValidationResult = $this->validateString($strValue);
				if(!$bValidationResult) {
					$strError = 'Invalid Contents';
				}
				break;
			// case 'sd':
			// 	$bValidationResult = $this->validateString($strValue);
			// 	break;
			case 'e':
				$bValidationResult = $this->validateEmail($strValue);
				if(!$bValidationResult) {
					$strError = 'This does not appear to be an Email';
				}
				break;
			case 'p':
				$bValidationResult = $this->validatePassword($strValue);
				if(!$bValidationResult) {
					$strError = 'Please ensure your password is secure with at least 1 upper, 1 lower, 1 number and at least 12 characters';
				}
				break;
			case 'i':
				$bValidationResult = $this->validateInteger($strValue);
				if(!$bValidationResult) {
					$strError = 'This does not appear to be a number';
				}
				break;
		}

		if($bValidationResult == false) {
			$arrReturn['error'] = true;
			$arrReturn['field'] = $arrNameArray[0];
			$arrReturn['error'] = $strError;
		}
		

		return $arrReturn;
		
    }

	// Validate a general string (e.g., name) with additional characters
	private function validateString($string) : bool
	{
		// Allow letters, numbers, spaces, and common punctuation marks and symbols
		return !empty($string) && preg_match("/^[a-zA-Z0-9\s.,'\"!?(){}[\]\/\\\-]+$/", $string);
	}

	// Validate an integer
	private function validateInteger($integer) : bool
	{
		// Check if the input is a valid integer
		return filter_var($integer, FILTER_VALIDATE_INT) !== false;
	}

	// Validate a password (at least 8 characters, at least one number, one uppercase letter, and one lowercase letter)
	private function validatePassword($password) : bool
	{
		$pattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/";
		return preg_match($pattern, $password);
	}

	// Validate an email
	private function validateEmail($email) : bool
	{
		// Use PHP's built-in filter to validate email
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}


}