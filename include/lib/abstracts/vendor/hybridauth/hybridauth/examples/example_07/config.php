<?php
/**
 * Build a configuration array to pass to `Hybridauth\Hybridauth`
 *
 * Set the Authorization callback URL to https://path/to/hybridauth/examples/example_07/callback.php
 * Understandably, you need to replace 'path/to/hybridauth' with the real path to this script.
 */
$config = [
    'callback' => 'https://jobstalentoincluir.com.br/wp-content/plugins/incluyeme-login-extension/include/lib/abstracts/vendor/hybridauth/hybridauth/examples/example_07/callback.php',
    'providers' => [
         'LinkedIn' => ['enabled' => true, 'keys' => ['id' => '77enshq5lqkzdk', 'secret' => 'qyQS2hPoW7lDAkrT']],

    ],
];
