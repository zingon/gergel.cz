<section>
	<article>
		<div class="wrapper">
			<h1>{$page.nazev}</h1>
			<p>{$page.popis}</p>
			<section id="referenceItems">
					<div class="row">
						{foreach from=$items item=reference key=key name=references}
						{if $smarty.foreach.references.index%2 eq 0 and not $smarty.foreach.references.first}<div class="row">{/if}
							<div class="col-sm-6">
								<a href="{$url_base}{$reference.nazev_seo}">
									<div class="referenceItem">
										<div class="row">
											<div class="col-xs-4">
	                                    		<img src="{$reference.icon.small}" class="img-responsive" alt="{$reference.nazev}"/>
	                               	 		</div>
	                               	 		<div class="col-xs-8">
			                                    <h3>{$reference.nazev}</h3>
			                                    <span class="makeMeButton">{translate str="Fotogalerie"}</span>
			                                </div>
			                            </div>
			                        </div>
						 		</a>
							</div>
						{if $smarty.foreach.references.iteration%2 eq 0 and not $smarty.foreach.references.last}<div class="row">{/if}
						{/foreach}
					</div>
			</section>
		</div>
	</article>
</section>

 