<?php
$this->layout = ['_redirect'];
?>
<main>
<a href="<?= $url ?>"><?= $url ?></a>
</main>
<script>
link_object = document.getElementsByTagName('a')[0];
link_object.click();
</script>
