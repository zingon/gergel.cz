 <section>
 	<article>
 		<div class="wrapper">
 			<h1>{$item.nazev}</h1>
 			<div class="pie">
 				<p>{$item.popis}</p>
 				<ul>
 					{foreach from=$files item=file key=key name=Files}
 						<li><a href="{$file.file}" download>{$file.nazev} ({$file.ext})</a></li>
 					{/foreach}
 				</ul>
 			</div>
 		</div>
 	</article>
 </section>