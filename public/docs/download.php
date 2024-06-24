<?php

include '_function.php';

$nombreArchivo = '';
header("Content-disposition: attachment; filename=" . $nombreArchivo);
header("Content-type: officedocument.wordprocessingml.document");
readfile($nombreArchivo);


#http://recepcion_test.test/docs/download.php?acta_20240623_1