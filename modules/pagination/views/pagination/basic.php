<p class="pagination">

	<?php if ($first_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first"><?php echo "&lt;" ?></a>
	<?php else: ?>
		<?php echo "<span>&lt;</span>" ?>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev"><?php echo "&laquo;" ?></a>
	<?php else: ?>
		<?php echo "<span>&laquo;</span>" ?>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<strong class="page"><?php echo $i ?></strong>
		<?php else: ?>
			<a class="page" href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next"><?php echo "&gt;" ?></a>
	<?php else: ?>
		<?php echo "<span>&gt;</span>" ?>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last"><?php echo "&raquo;" ?></a>
	<?php else: ?>
		<?php echo "<span>&raquo;</span>" ?>
	<?php endif ?>

</p><!-- .pagination -->