<section id="intro">
    <div class="wrapper row">
		{widget controller="page"} 	
		
	</div>
</section>
 <section>
    <article id="aboutUs" class="wrapper">
		<h1>{$item.nadpis}</h1>
		<div class="row">
            <div class="col-sm-10">
				<p>{$item.uvodni_popis}</p>
			</div>
			<div class="col-sm-2">
                <img src="{$item.photo}" class="img-responsive" alt="ISO"/>
            </div>
		</div>
		<div class="row">
        	{$item.popis}     
        	 
        </div>
	</article>
</section> 
 <section id="news">
    <div class="wrapper">
    	
		{widget controller="article"}
	</div>
</section>