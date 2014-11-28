<?php
$fields = explode(',', str_replace(' ', '', $_GET['fields']));

echo 'class ' . $_GET['className'] . PHP_EOL;
echo '{' . PHP_EOL;

foreach ($fields as $f) {
    if ($f)
        echo '    public $' . $f . ';' . PHP_EOL;
}

echo PHP_EOL;

echo '    public function exchangeArray($data)' . PHP_EOL;
echo '    {' . PHP_EOL;
foreach ($fields as $f) {
    if ($f)
        echo '        $this->' . $f . ' = isset($data["' . $f . '"]) ? $data["' . $f . '"] : NULL;' . PHP_EOL;
}
echo '    }' . PHP_EOL;
echo '}';