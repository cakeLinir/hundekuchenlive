<?php
declare(strict_types=1);

// Support läuft über StreamElements: Alte Links und Lesezeichen auf /spenden/ leiten dorthin weiter.
header('X-Robots-Tag: noindex, nofollow');
header('Location: https://streamelements.com/hundekuchenlive/tip', true, 302);
exit;
