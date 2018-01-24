#!/bin/bash
mysql -u testuser -pPassw0rd < init.sql
mysql -u testuser -pPassw0rd < insertData.sql
