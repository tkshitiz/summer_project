<?php

include('stripe-php-master/init.php');
$publishableKey="pk_test_51IYAMtSDR1smVlTPfJQS8lWQUjYFfcFWtT4NjZ8oIFzLlALPfcfop5RApkIcudsMzCo64pOGYW7QTGLHVqkqzGRz00wtE0o03u
";

$secretKey="sk_test_51IYAMtSDR1smVlTPjHRHAesI3vJKh9LfT6lwlEDCnUidVC1ic2P5W4SXVobhcsc77D5eAzz0Ncmz3CZHMIxtKT6O005dTCJIpc";

\Stripe\Stripe::setApiKey($secretKey);

?>