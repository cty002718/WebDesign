<?php
    $username='cty002718';
    $password='12345';
    
    if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
       || ($_SERVER['PHP_AUTH_USER']!=$username) || ($_SERVER['PHP_AUTH_PW']!=$password)) {
        
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="score"');
        exit('<h2>&#23494;&#30908;&#37679;&#35492;</h2>.........&#19981;&#35201;&#20098;&#21034;&#20098;&#25913;&#36039;&#26009;');
    }
    
?>
