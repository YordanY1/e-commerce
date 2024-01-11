<?php

return [

    'test_api_url' => env('ECONT_TEST_API_URL', 'http://demo.econt.com/e-econt/xml_parcel_import2.php'),
    'prod_api_url' => env('ECONT_PROD_API_URL', 'http://www.econt.com/e-econt/xml_parcel_import2.php'),
    'test_service_tool_api_url' => env('ECONT_TEST_SERVICE_TOOL_API_URL', 'http://demo.econt.com/e-econt/xml_service_tool.php'),
    'prod_service_tool_api_url' => env('ECONT_PROD_SERVICE_TOOL_API_URL', 'http://www.econt.com/e-econt/xml_service_tool.php'),
    'username' => env('ECONT_USERNAME', ''),
    'password' => env('ECONT_PASSWORD', ''),
];
