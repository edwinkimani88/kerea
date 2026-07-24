<?php
/**
 * KEREA Member Portal — Redirect to Membership Dashboard
 * The member portal has been integrated into /membership/dashboard/
 */
header('HTTP/1.1 301 Moved Permanently');
header('Location: /membership/dashboard/');
exit;
