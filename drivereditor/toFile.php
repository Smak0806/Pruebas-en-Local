<?php

header('Content-type: text/plain');
header('Content-Disposition: attachment; filename=' . $_POST['filename']);

echo $_POST['filecontent'];