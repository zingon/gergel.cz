<section>
	<article id="contact">
		<div class="wrapper">
			<h1>{$item.nazev}</h1>
			<div class="row">
				<div class="row-same-height">
					<div class="col-sm-4 col-sm-height col-top">
						<div>{$item.uvodni_popis}</div>
					</div>
					<div class="col-sm-8 col-sm-height col-top">
                        <div class="mapa">
                            <iframe src="{$map}" height="306px" frameborder="0" style="border:0"></iframe>
                        </div>
                    </div>
				</div>
			</div>
			<div class="row">
				{$item.popis}
			</div>
		</div>
	</article>
</section>