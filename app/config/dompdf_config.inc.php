<?php
//define("DOMPDF_DPI", 72);
define("DOMPDF_ENABLE_REMOTE", true);
//define("DOMPDF_ENABLE_CSS_FLOAT", true);

define("DOMPDF_FONT_CACHE", "../app/cache/");
define("DOMPDF_ENABLE_AUTOLOAD", false);

include('../vendor/dompdf/dompdf/dompdf_config.inc.php');