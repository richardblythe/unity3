<?php

namespace Unity3_Vendor;

// Start of recode v.
/**
 * Recode a string according to a recode request
 * @link https://php.net/manual/en/function.recode-string.php
 * @param string $request <p>
 * The desired recode request type
 * </p>
 * @param string $string <p>
 * The string to be recoded
 * </p>
 * @return string|false the recoded string or <b>FALSE</b>, if unable to
 * perform the recode request.
 */
function recode_string($request, $string)
{
}
/**
 * Recode from file to file according to recode request
 * @link https://php.net/manual/en/function.recode-file.php
 * @param string $request <p>
 * The desired recode request type
 * </p>
 * @param resource $input <p>
 * A local file handle resource for
 * the <i>input</i>
 * </p>
 * @param resource $output <p>
 * A local file handle resource for
 * the <i>output</i>
 * </p>
 * @return bool <b>FALSE</b>, if unable to comply, <b>TRUE</b> otherwise.
 */
function recode_file($request, $input, $output)
{
}
/**
 * Alias of <b>recode_string</b>
 * @link https://php.net/manual/en/function.recode.php
 * @param $request
 * @param $str
 */
function recode($request, $str)
{
}
// End of recode v.
