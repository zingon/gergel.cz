{if $web_owner.ga_code}
<div class="row">
        <script type="text/javascript">
            var tableId = {$web_owner.ga_code};
        </script>
    <div class="col-sm-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Přístupy od předešlého měsíce</h3>
            </div>
            <div class="panel-body">
                <div id="pristupy" style="width: 100%"></div>
                <div id="authorize-views" class="alert alert-danger authorize" style="display: none; width: 100%;">
                    <button class="btn btn-danger authorize-button" style="display: none; ">Authorize</button>
                    <button class="btn btn-danger logout-button" style="display: none; ">Logout</button>
                    <span class="text"">Musíte se přihlásit k účtu spravující patřičné Google Analytics.</span>
                </div>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading clearfix">
                <div class="panel-title">
                    <h3 class="panel-title pull-left">Přístupy podle zemí</h3>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs" disabled id="chooseGeoGraphButton">Sloupcový</button>
                        <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" id="chooseGeoGraph" role="menu">
                            <li data-change="1"><a href="javascript:changeGraphZeme(1)" >Sloupcový</a></li>
                            <li data-change="0"><a href="javascript:changeGraphZeme(0)">Geografický</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body" id="geo_body">
                <div id="zeme"></div>
                <div id="authorize-country" class="alert alert-danger authorize" style="display: none; width: 100%;">
                    <button class="btn btn-danger authorize-button" style="display: none; ">Authorize</button>
                    <button class="btn btn-danger logout-button" id="logout-button" style="display: none; ">Logout</button>
                    <span class="text"">Musíte se přihlásit k účtu spravující patřičné Google Analytics.</span>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-{if $web_owner.ga_code}3{else}12{/if}">
        <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title">Podíl prohlížečů</h3>
            </div>
            <div class="panel-body">
                <div id="prohlizece" style="width: 100%"></div>
                <div id="browsers-views" class="alert alert-danger authorize" style="display: none; width: 100%;">
                    <button class="btn btn-danger authorize-button" style="display: none; ">Authorize</button>
                    <button class="btn btn-danger logout-button" style="display: none; ">Logout</button>
                    <span class="text"">Musíte se přihlásit k účtu spravující patřičné Google Analytics.</span>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="{$media_path}admin/js/auth_util.js"></script>
    <script src="{$media_path}admin/js/dashboard.js"></script>
    <script src="{$media_path}admin/js/graphs.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
{/if}
