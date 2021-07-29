@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../humbug/php-scoper/bin/php-scoper
php "%BIN_TARGET%" %*
