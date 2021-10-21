<?php

namespace is\Masters\Modules\Isengine\Currency;

use is\Helpers\System;
use is\Helpers\Objects;
use is\Helpers\Strings;

$instance = $this -> get('instance');
$sets = &$this -> settings;
$data = $this -> getData();

if (!empty($data)) :
	foreach ($data as $key => $item) :
?>
<div class="main-side__block-item main-side__block-item--currency">
	<i class="fa fa-<?= $key; ?>" aria-hidden="true"></i>
	<?= $item; ?>
</div>
<?php
	endforeach;
	unset($item, $key);
endif;
?>

<?php if (!empty($sets['copyright'])) : ?>
<small>
	По данным сайта <a href="http://cbr.ru/" title="Центральный Банк России" target="_blank">Центробанка РФ</a>
</small>
<?php endif; ?>