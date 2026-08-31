<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
/**
 * Mursal Marble Front Controller & Application Bootstrapper
 */

// Define Core Constants First
define('APPROOT', dirname(__DIR__));

// Global Exception & Error Logger
set_exception_handler(function ($exception) {

    echo "<pre>";
    echo "ERROR: " . $exception->getMessage() . "\n\n";
    echo "FILE: " . $exception->getFile() . "\n";
    echo "LINE: " . $exception->getLine();
    echo "</pre>";

    exit();
});
    $logDir = APPROOT . '/app/logs';

// Start session storage with secure cookie attributes
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'use_only_cookies' => true
    ]);
}

// Detect URL Root dynamically
    
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$dirName = dirname($scriptName);

if (basename($dirName) === 'public') {
    $urlRoot = dirname($dirName);
} else {
    $urlRoot = $dirName;
}

$urlRoot = rtrim($urlRoot, '/');

define('URLROOT', $urlRoot);
    define('SITENAME', 'Mursal Marble & Granite Tiles');
    define('UPLOADS_PATH', APPROOT . '/public/uploads/');

// Include Helpers & Database Config
require_once APPROOT . '/app/helpers/security.php';
require_once APPROOT . '/app/helpers/upload.php';
require_once APPROOT . '/config/database.php';

// Auto-load all Models
foreach (glob(APPROOT . '/app/models/*.php') as $modelFile) {
    require_once $modelFile;
}

// Auto-load all Controllers
foreach (glob(APPROOT . '/app/controllers/*.php') as $controllerFile) {
    require_once $controllerFile;
}

// Load Web Routes Registry
$routes = require_once APPROOT . '/routes/web.php';

$method = $_SERVER['REQUEST_METHOD'];

// Parse Request URI Path
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// the added content


// Strip base subfolder prefix if present (e.g. /mursal_marbel)
if (!empty($urlRoot) && strpos($requestUri, $urlRoot) === 0) {
    $requestUri = substr($requestUri, strlen($urlRoot));
}
$requestUri = str_replace('/public', '', $requestUri);
$requestUri = trim($requestUri, '/');

echo "TEST ROUTER";
echo "<br>";
echo "URI = " . $requestUri;
exit();



// Verify CSRF on POST requests
if ($method === 'POST') {
    verify_csrf();
}

// Router Pattern Dispatcher
$matchedRoute = false;

if (isset($routes[$method])) {
    foreach ($routes[$method] as $routePattern => $handler) {
        // Convert route pattern like 'products/{slug}' or 'admin/products/edit/{id}' to regex
        $regexPattern = preg_replace('/\{id\}/', '(\d+)', $routePattern);
        $regexPattern = preg_replace('/\{slug\}/', '([a-zA-Z0-9-]+)', $regexPattern);
        $regexPattern = '#^' . $regexPattern . '$#';

        if (preg_match($regexPattern, $requestUri, $matches)) {
            array_shift($matches); // Remove full match
            list($controllerName, $actionName) = $handler;

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    call_user_func_array([$controller, $actionName], $matches);
                    $matchedRoute = true;
                    exit();
                }
            }
        }
    }
}

// 404 Fallback Page if no route matches
if (!$matchedRoute) {
    http_response_code(404);
    $pageTitle = "404 Page Not Found";
    require_once APPROOT . '/app/views/layouts/header.php';
    ?>
    <div class="container my-5 py-5 text-center">
        <div class="py-5 bg-dark text-light rounded-4 shadow-lg border border-secondary border-opacity-25" style="background: linear-gradient(145deg, #181c24, #0b0d11)!important;">
            <h1 class="display-1 text-gold fw-bold">404</h1>
            <h2 class="h3 mb-3">Page Not Found</h2>
            <p class="lead text-muted mb-4">The requested page URI does not exist or has been relocated.</p>
            <a href="<?= URLROOT ?>/" class="btn btn-gold btn-lg px-4 rounded-pill">
                <i class="bi bi-house-door me-2"></i> Return to Home Page
            </a>
        </div>
    </div>
    <?php
    require_once APPROOT . '/app/views/layouts/footer.php';
}
