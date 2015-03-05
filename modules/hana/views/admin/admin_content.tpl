{* sablona obsahu v administracni casti - zpravidla obaluje editacni tabulku, nebo formular, pripadne jiny generovany obsah *}
<div class="row">
    <div class="col-xs-12">
        <h2>{$submodule_title}{if $submodule_description} <small>{$submodule_description}</small>{/if}</h2>
    </div>
</div>
{$admin_content}