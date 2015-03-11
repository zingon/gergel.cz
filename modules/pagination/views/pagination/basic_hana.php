<p class="pagination">

	<?php if ($first_page !== FALSE): ?>
           <a href="<?php echo HTML::chars($page->url($first_page).url::query()); ?>" rel="first">&laquo;</a>
	<?php else: ?>
                <span>&laquo;</span>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($previous_page).url::query()) ?>" rel="prev">&lt;</a>
	<?php else: ?>
                <span>&lt;</span>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<strong><?php echo $i ?></strong>
		<?php else: ?>
			<a href="<?php echo HTML::chars($page->url($i).url::query()) ?>"><?php echo $i ?></a>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($next_page).url::query()) ?>" rel="next">&gt;</a>
	<?php else: ?>
		<span>&gt;</span>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($last_page).url::query()) ?>" rel="last">&raquo;</a>
	<?php else: ?>
                <span>&raquo;</span>
	<?php endif ?>

</p><!-- .pagination -->