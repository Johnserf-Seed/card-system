<?php
namespace App\Library; class Helper { public static function getMysqlDate($sp7d6c63 = 0) { return date('Y-m-d', time() + $sp7d6c63 * 24 * 3600); } public static function getIP() { if (isset($_SERVER)) { if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { $spe999f5 = $_SERVER['HTTP_X_FORWARDED_FOR']; } else { if (isset($_SERVER['HTTP_CLIENT_IP'])) { $spe999f5 = $_SERVER['HTTP_CLIENT_IP']; } else { $spe999f5 = @$_SERVER['REMOTE_ADDR']; } } } else { if (getenv('HTTP_X_FORWARDED_FOR')) { $spe999f5 = getenv('HTTP_X_FORWARDED_FOR'); } else { if (getenv('HTTP_CLIENT_IP')) { $spe999f5 = getenv('HTTP_CLIENT_IP'); } else { $spe999f5 = getenv('REMOTE_ADDR'); } } } if (strpos($spe999f5, ',') !== FALSE) { $sp23237a = explode(',', $spe999f5); return $sp23237a[0]; } return $spe999f5; } public static function getClientIP() { if (isset($_SERVER)) { $spe999f5 = $_SERVER['REMOTE_ADDR']; } else { $spe999f5 = getenv('REMOTE_ADDR'); } if (strpos($spe999f5, ',') !== FALSE) { $sp23237a = explode(',', $spe999f5); return $sp23237a[0]; } return $spe999f5; } public static function filterWords($spba2cdb, $sp70a70d) { if (!$spba2cdb) { return false; } if (!is_array($sp70a70d)) { $sp70a70d = explode('|', $sp70a70d); } foreach ($sp70a70d as $sp6adb52) { if ($sp6adb52 && strpos($spba2cdb, $sp6adb52) !== FALSE) { return $sp6adb52; } } return false; } public static function is_idcard($spa9746d) { if (strlen($spa9746d) == 18) { return self::idcard_checksum18($spa9746d); } elseif (strlen($spa9746d) == 15) { $spa9746d = self::idcard_15to18($spa9746d); return self::idcard_checksum18($spa9746d); } else { return false; } } private static function idcard_verify_number($spbf4bad) { if (strlen($spbf4bad) != 17) { return false; } $spb1687b = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); $sp84ee1d = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'); $sp215a09 = 0; for ($sp3f53b5 = 0; $sp3f53b5 < strlen($spbf4bad); $sp3f53b5++) { $sp215a09 += substr($spbf4bad, $sp3f53b5, 1) * $spb1687b[$sp3f53b5]; } $sp326697 = $sp215a09 % 11; $spdd9a49 = $sp84ee1d[$sp326697]; return $spdd9a49; } private static function idcard_15to18($spd125cc) { if (strlen($spd125cc) != 15) { return false; } else { if (array_search(substr($spd125cc, 12, 3), array('996', '997', '998', '999')) !== false) { $spd125cc = substr($spd125cc, 0, 6) . '18' . substr($spd125cc, 6, 9); } else { $spd125cc = substr($spd125cc, 0, 6) . '19' . substr($spd125cc, 6, 9); } } $spd125cc = $spd125cc . self::idcard_verify_number($spd125cc); return $spd125cc; } private static function idcard_checksum18($spd125cc) { if (strlen($spd125cc) != 18) { return false; } $spbf4bad = substr($spd125cc, 0, 17); if (self::idcard_verify_number($spbf4bad) != strtoupper(substr($spd125cc, 17, 1))) { return false; } else { return true; } } public static function strBetween($spba2cdb, $spc55008, $sp76d7f5) { $spa71564 = stripos($spba2cdb, $spc55008); if ($spa71564 === false) { return ''; } $sp6b36c9 = stripos($spba2cdb, $sp76d7f5, $spa71564 + strlen($spc55008)); if ($sp6b36c9 === false || $spa71564 >= $sp6b36c9) { return ''; } $sp037d6e = strlen($spc55008); $sp27b5c4 = substr($spba2cdb, $spa71564 + $sp037d6e, $sp6b36c9 - $spa71564 - $sp037d6e); return $sp27b5c4; } public static function formatUrl($spadfef0) { if (!starts_with($spadfef0, 'http://') && !starts_with($spadfef0, 'https://')) { $spadfef0 = 'http://' . $spadfef0; } while (ends_with($spadfef0, '/')) { $spadfef0 = substr($spadfef0, 0, -1); } return $spadfef0; } }