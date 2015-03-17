 <section>
 	<article>

 		<div class="wrapper">
 			<h1>{$item.nazev}</h1>
 			<p>{$item.popis}</p>
 			<div class="row">
 			<div class="col-xs-12">
 					{foreach from=$files item=file key=key name=Files}
 						<p><a href="{$file.file}" download class="makeMeButton">{$file.nazev} ({$file.ext})</a></p>
 					{/foreach}
 			</div>
 			</div>
 		</div>
 	</article>
 </section>