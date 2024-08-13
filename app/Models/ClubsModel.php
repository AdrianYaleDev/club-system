<?php
namespace App\Models;

use CodeIgniter\Model;

class ClubsModel extends Model
{
    protected $table = 'clubs';

    public function checkForExistingClub($strClubName)
    {
		$db = db_connect();

		$strSQL = 'SELECT c.id FROM clubs c WHERE c.clubname = ?';

		$query = $db->query($strSQL, [$strClubName]);
		$arrResults = $query->getResult();
		return $arrResults;
    }

	public function createClub($arrClubData)
	{
		
		$db = db_connect();
		$pQuery = $db->prepare(static function ($db) {
			return $db->table('clubs')->insert([
				'clubname' => 'x',
				'sport' => '',
			]);
		});

		// Collect the Data
		$strClubName    = $arrClubData['clubname'];
		$strSport    = $arrClubData['sport'];
		
		// Run the Query
		$result = $pQuery->execute($strClubName, $strSport);

		if($result) {
			$strSQL = 'SELECT c.id FROM clubs c WHERE c.clubname = ?';

			$query = $db->query($strSQL, [$arrClubData['clubname']]);
			$result = $query->getResult()[0]->id;

		}	

		return $result;
	}

	public function getClubID($strClubName) 
	{
		$db = db_connect();

		$strSQL = 'SELECT c.id FROM clubs c WHERE c.clubname = ?';
		$query = $db->query($strSQL, [$strClubName]);
		$arrResults = $query->getResult()[0]->id;
		return $arrResults;


	}

}