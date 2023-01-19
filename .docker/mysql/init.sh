#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS fast_tests_testing;
    GRANT ALL PRIVILEGES ON \`fast_tests_testing%\`.* TO '$MYSQL_USER'@'%';
    GRANT ALL PRIVILEGES ON \`fast_tests%\`.* TO '$MYSQL_USER'@'%';
EOSQL
