<?php
/*
Copyright 2016 Daniil Gentili
(https://daniil.it)
This file is part of MadelineProto.
MadelineProto is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
MadelineProto is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.
You should have received a copy of the GNU General Public License along with MadelineProto.
If not, see <http://www.gnu.org/licenses/>.
*/

require 'vendor/autoload.php';

$id = ['AgADBAADcKoxG4_aCgYKET2oLMua7pxRaRkABKoeLWY9bpazGdcCAAEC', 'BQADBAADhQEAAo_aCgZOb3LWhOazMQI'];

function foreach_offset_length($string)
{
    $res = [];
    $strlen = strlen($string);
    for ($offset = 0; $offset < strlen($string); $offset++) {
        for ($length = $strlen - $offset; $length > 0; $length--) {
            $s = substr($string, $offset, $length);
            $number = (string) (new \phpseclib\Math\BigInteger(strrev($s), 256));
            $res[] = ['number' => $number, 'offset' => $offset, 'length' => $length];
        }
    }

    return $res;
}
$res = [];
foreach ($id as $file_id) {
    $base256 = base64url_decode($file_id);
    $res = foreach_offset_length($base256);
    if (!isset($same)) {
        $same = $res;
    } else {
        foreach ($same as $key => $s) {
            if (!in_array($s, $res)) {
                unset($same[$key]);
            }
        }
    }
}

function base64url_decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}
