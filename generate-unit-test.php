<?php
$fields = explode(',', str_replace(' ', '', $_GET['fields']));

echo 'public function testDataInitialState()' . PHP_EOL;
echo '{' . PHP_EOL;
foreach ($fields as $f) {
    if ($f)
        echo '    $this->assertNull($this->' . $_GET['className'] . '->' . $f, ', \'"' . $f . '" should be initially null\');' . PHP_EOL;
}
echo '}' . PHP_EOL . PHP_EOL;

echo 'public function testExchangeArraySetsPropertiesCorrectly()' . PHP_EOL;
echo '{' . PHP_EOL;
echo '    $data = array(' . PHP_EOL;
foreach ($fields as $f) {
    if ($f) {
        $dummyData = null;

        if (!$dummyData && strpos($f, '_flag')) {
            $dummyData = '\'n\'';
        }

        if (!$dummyData && strpos($f, '_id')) {
            $dummyData = rand(1,25);
        }

        if (!$dummyData && strpos($f, '_datetime')) {
            $dummyData = '\'' . date('Y-m-d H:i:s') . '\'';
        }

        if (!$dummyData && strpos($f, 'site_code')) {
            $dummyData = '\'UP\'';
        }

        if (!$dummyData && ($f == 'email')) {
            $dummyData = '\'customer123@uprinting.com\'';
        }

        if (!$dummyData) {
            $dummyData = '\'\'';
        }

        echo '        \'' . $f . '\' => ' . $dummyData . ',' . PHP_EOL;
    }
}
echo '    );' . PHP_EOL . PHP_EOL;
echo '    $this->' . $_GET['className'] . ' = new ' . $_GET['className'] . '();' . PHP_EOL;
echo '    $this->' . $_GET['className'] . '->exchangeArray($data);' . PHP_EOL . PHP_EOL;

foreach ($fields as $f) {
    if ($f)
        echo '    $this->assertSame($data[\'' . $f . '\'], $this->' . $_GET['className'] . '->' . $f . ', \'"' . $f . '" was not set correctly\');' . PHP_EOL;
}

echo '}' . PHP_EOL . PHP_EOL;