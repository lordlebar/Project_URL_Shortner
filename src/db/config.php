<?php
require $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/vendor/autoload.php";

\Sentry\init(['dsn' => 'https://62c9c1fe0ee34777b9c70b8e5f6e0fda@o4505257204842496.ingest.sentry.io/4505274352336896' ]);

define("DB_HOST", "db"); // localhost | db
define("DB_USER", "php_url_shortner"); // root | php_url_shortner
define("DB_PASSWORD", "php_url_shortner"); // root | php_url_shortner
define("DB_BASE", "ACQTX"); // ACQTX
?>
