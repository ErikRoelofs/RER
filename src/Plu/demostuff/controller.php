<?php

$list = array(
    array(0.2, 500, 'routeA'),
    array(0.4, 300, 'routeA'),
    array(0.5, 3500, 'routeB'),
    array(0.7, 700, 'routeA'),
    array(0.1, 800, 'routeB'),
    array(0.1, 900, 'routeA'),
    array(0.1, 100, 'routeB'),
    array(0.05, 250, 'routeC'),
    array(1.2, 400, 'routeA'),
);

$rules = array(
    new Rule(new MemUse(100), new AvgLoad()),
    new Rule(new MemUse(500), new AvgLoad())
);

foreach ($list as $item) {
    foreach ($rules as $rule) {
        if ($rule->relevant($item)) {
            $rule->calculate($item);
        }
    }
}

$reporter = new Reporter;
foreach ($rules as $rule) {
    $rule->report($reporter);
}
