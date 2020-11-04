<?php
namespace Anax\View;

?>
<h1>Resultat</h1>

<?php if ($isValid) : ?>
    <p><strong><?= htmlentities($ipAddress) ?></strong> är en validerad <strong><?= htmlentities($ipv) ?></strong> IP-Address</p>
<?php else : ?>
    <p><strong><?= htmlentities($ipAddress) ?></strong> är inte en validerad IP-Address</p>
<?php endif; ?>

<?php if ($domain) : ?>
  <p><strong>Domännamn:</strong> <?= $domain ?></p>
<?php endif; ?>
