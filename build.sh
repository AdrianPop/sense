#!/usr/bin/env bash
/Applications/MAMP/bin/php/php5.6.2/bin/php composer.phar update
/Applications/MAMP/bin/php/php5.6.2/bin/php phpunit-4.8.5.phar --coverage-clover _build/logs/clover.xml tests
export CODACY_PROJECT_TOKEN=f3494ab676ea43d08302d3ae9766a28e
./vendor/bin/codacycoverage clover _build/logs/clover.xml
