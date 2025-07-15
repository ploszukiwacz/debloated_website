<?php
/*
Copyright (C) 2025 PlOszukiwacz

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

// --- Basic IP and User-Agent pattern blocking ---
$block_ip_patterns = [
    '/^185\.177\.72\.144$/',
    '/^185\.177\.72\.115$/',
    '/^68\.183\.184\.14$/',
    '/^112\.78\.2\.224$/',
    '/^198\.55\.98\.91$/',
    '/^93\.123\.109\.7$/',
    '/^194\.26\.192\.144$/',
    '/^34\.207\.124\.193$/',
    '/^199\.45\.155\.87$/',
    '/^167\.94\.145\.105$/',
];

$block_ua_patterns = [
    '/nmap/i',
    '/nikto/i',
    '/sqlmap/i',
    '/dirb/i',
    '/dirbuster/i',
    '/gobuster/i',
    '/masscan/i',
    '/zmap/i',
    '/nuclei/i',
    '/wpscan/i',
    '/whatweb/i',
    '/httprint/i',
    '/w3af/i',
    '/skipfish/i',
    '/burp/i',
    '/owasp/i',
    '/acunetix/i',
    '/nessus/i',
    '/openvas/i',
    '/metasploit/i',
    '/hydra/i',
    '/medusa/i',
    '/john/i',
    '/hashcat/i',
    '/aircrack/i',
    '/reaver/i',
    '/bettercap/i',
    '/ettercap/i',
    '/wireshark/i',
    '/tcpdump/i',
    '/shodan/i',
    '/censys/i',
    '/zgrab/i',
    '/GPTBot/i',
    '/ChatGPT/i',
    '/SemrushBot/i',
    '/Iframely/i',
];

// Get client IP (try X-Forwarded-For first)
$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
$client_ip = explode(',', $client_ip)[0]; // In case of multiple IPs

// Get User-Agent
$client_ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

// Redirect if IP matches
foreach ($block_ip_patterns as $pattern) {
    if (preg_match($pattern, $client_ip)) {
        header('Location: https://hn1f.duckdns.org/int', true, 302);
        exit();
    }
}

// Redirect if UA matches
foreach ($block_ua_patterns as $pattern) {
    if (preg_match($pattern, $client_ua)) {
        header('Location: https://hn1f.duckdns.org/int', true, 302);
        exit();
    }
}

// Simple autoloader for our classes
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/classes/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Include all classes manually as fallback
$classes = [
    'Link',
    'Page',
    'Header',
    'Footer'
];

foreach ($classes as $class) {
    $file = __DIR__ . '/classes/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}
?>
