<ul class="pagination right">
	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<li class="current"><a href="#"><?php echo $i ?></a></li>
		<?php else: ?>
            <li><a class="page" href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a></li>
		<?php endif ?>

	<?php endfor ?>
</ul><!-- .pagination -->