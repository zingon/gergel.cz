--- testovací šablona knihovny AutoForm ---<br />

Kontejner: {$nadpis}<br />
Obsah vnějšího kontejneru: {$vnejsi.nazev_seo}<br />
Obsah vnitřního kontejneru - id: {$vnejsi.vnitrni.id}<br />
Obsah vnitřního kontejneru - pop: {$vnejsi.vnitrni.lb_popis}<br />

{foreach name=vn from=$vnejsi key=key item=item}
  <br />{$item.id} - {$item.nazev_seo}
{/foreach}