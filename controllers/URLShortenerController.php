<?php

require_once 'services/URLShortenerService.php';

class URLShortenerController {
    
    /**
     * @var URLShortenerService
     */
    private $urlShortenerService;

    /**
     * URLShortenerController constructor.
     * @param URLShortenerService $urlShortenerService 
     */
    public function __construct() {
        $this->urlShortenerService = new URLShortenerService();
    }
       
    public function store() {
        $original_url = $_POST['originalUrl'];
        
        header('Content-Type: application/json');

        if (
            !isset($original_url) 
            || strlen($original_url) > 250
            || strlen($original_url) < 1
            ) {

            echo json_encode([
                'success' => false,
                'message' => 'Please provide a valid URL'
            ]);
            die;

        }

        $urlGenerate = $this->urlShortenerService->store($original_url);
        
        echo json_encode([
            'success' => true,
            'data' => $urlGenerate
        ]);
        die;
    }
}
?>
