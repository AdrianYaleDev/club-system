<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

		/*

		Simple Query builder. Use this in models to start with.
		$db = db_connect();
		$content = $db->query('SELECT * FROM secondary');
		$test = $content->getResult();

		*/
        // Preload any models, libraries, etc, here.

        $session = service('session');
    }

	protected function getFullUrl($path)
    {
        $currentHost = $_SERVER['HTTP_HOST'];  // e.g., bodmin.localhost.com
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
        return $protocol . $currentHost . '/' . $path;
    }


	protected function render_page($arrData)
	{
		
		// Strip out the Stylesheet and Javascript. Then grab the correct HTML for each.
		// Add these flat HTML strings to the Header/Footer data as applicable.

		$arrJS = $arrData['javascript'];
		$arrCSS = $arrData['stylesheet'];

		$arrJS = array_merge($arrJS, array('bootstrap'));
		$arrCSS = array_merge($arrCSS, array('bootstrap'));

		$strJavascriptHTML = $this->retrieve_javascript($arrJS);
		$strCSSHTML = $this->retrieve_css($arrCSS);

	
		$arrHeaderData = [
			'css' => $strCSSHTML,
			'pageTitle' => $arrData['pageTitle']
		];

		$arrFooterData = [
			'javascript' => $strJavascriptHTML
		];

		$arrContentData = [ 

		];

		$strFolder = $arrData['viewFolder'] .'/' ?: '';		

	    $strView = view($strFolder.'header', $arrHeaderData);
		$strView .= view($strFolder.$arrData['viewName'], $arrContentData);
		$strView .= view($strFolder.'footer', $arrFooterData);
		return $strView;
	} 

	protected function retrieve_javascript($arrScripts) 
	{

		$strJavascriptHTML = '';

		$arrDefaults = ['jQuery', 'bootstrap'];

		$arrScripts = array_merge($arrDefaults, $arrScripts);

		foreach($arrScripts as $strScript) {
			switch($strScript) {
				case 'jQuery':
					$strJavascriptHTML .= '<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>';
				    break;
				case 'bootstrap':
					$strJavascriptHTML .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';
				    break;
				case 'register' :
					$strJavascriptHTML .= '<script src="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/assets/js/main/register.js" crossorigin="anonymous"></script>';
				    break;
			}
		}

		return $strJavascriptHTML;
	}

	protected function retrieve_css($arrStyles) 
	{

		$strCSSHTML = '';

		foreach($arrStyles as $strStyle) {
			switch($strStyle) {
				case 'bootstrap':
					$strCSSHTML .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">';
				    break;
				case 'main':
					// $strCSSHTML .= link_tag("assets/css/styles.css");
					$strCSSHTML.= '<link href="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/assets/css/main.css" rel="stylesheet">';
					break;
				
			}
		}

		return $strCSSHTML;
	}

	
}
