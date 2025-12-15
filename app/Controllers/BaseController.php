<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * E.g., setting up a database connection, loading helpers, etc.
 *
 * The `services()` method is accessible by all controllers.
 */
class BaseController extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url'];

    /**
     * Be sure to declare properties for any property initialization you do here.
     * Only public properties should be present.
     *
     * @var string
     */
    protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
    }

    /**
     * Fungsi helper untuk rendering view dengan layout
     * @param string $page 
     * @param array $data 
     */
    protected function renderView($page, $data = [])
    {
        $data['session'] = $this->session;
        echo view('layout/header', $data);
        echo view($page, $data);
        echo view('layout/footer', $data);
    }
}