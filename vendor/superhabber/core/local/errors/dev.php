<html>
    <head>
        <title>Error</title>
        <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>Some error was happened</h1>
            <h4><b>Error code:</b> <?=$errno?></h4>
            <h4><b>Error text:</b> <?=$errstr?></h4>
            <h5><b>file in which error happened:</b> <?=$errfile?></h5>
            <?$strs = $file = preg_split("/\n/", file_get_contents($errfile)) ?>
            <?$f = array_splice($strs, $errline-3, 9);?>

                <?foreach($f as $k => $v){
                    
                    print_r('<pre style="'. ($errline==$errline+$k-2 ? "color:red;" : '') .'font-size:14;">'.($errline+$k-2) . "  $v<br>".'</pre>');
                }?>

            <h4><b><code>Error line:</b> <?=$errline?></code></h4>
        </div>
    </body>
</html>

