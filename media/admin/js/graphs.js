/**
 * Created by Tom on 1.6.14.
 */


// Graf přístupů
function printGraphPristupy(graphData) {
    var table = new google.visualization.DataTable();

    table.addColumn('date', 'Den');
    table.addColumn('number', 'Přístupy');
    table.addColumn('number', 'Nové přístupy');

    for (var i = 0; i < (graphData.rows.length); i++)
    {
        var date = graphData.rows[i][0];
        var dateForRow = new Date(date.substring(0,4), (parseInt(date.substring(4,6))-1), date.substring(6,8));

        table.addRow([dateForRow, parseInt(graphData.rows[i][1]), parseInt(graphData.rows[i][2])]);
    }

    var options = {
        point: 2
    };

    var chart = new google.visualization.AreaChart(document.getElementById('pristupy'));
    chart.draw(table, options);

}

// Graf přístupů přes prohlížeče
function printGraphProhlizece(graphData) {
    var table = new google.visualization.DataTable();

    table.addColumn('string', 'Prohlížeč');
    table.addColumn('number', 'Přístupy');

    for (var i = 0; i < graphData.rows.length; i++)
    {
        table.addRow([graphData.rows[i][0], parseInt(graphData.rows[i][1])]);
    }

    var options = {
        chartArea: {'width': '90%', 'height': '90%'},
        pieHole: 0.4,
    };
    var chart = new google.visualization.PieChart(document.getElementById('prohlizece'));
    chart.draw(table, options);

}

// Graf přístupů ze zemí
function printGraphZeme(graphData, set) {

    /* Nastaví sloupcový nebo geografický graf (výchozí je sloupcový) */
    var col = 1;

    if (localStorage.getItem("geoGraph") !== null)
        col = localStorage.getItem("geoGraph");

    /* Nastaví správné zobrazení tlačítek */
    setGeoGraphButton(col);

    /* Vynuluje div s původním grafem pokud je nastaveno set */
    if (typeof set !== "undefined" && set == true)
    {
        $("#geo_body #zeme").remove();
        $("#geo_body").prepend("<div id=\"zeme\"></div>");
    }


    var table = new google.visualization.DataTable();

    table.addColumn('string', 'Country');
    table.addColumn('number', 'Přístupy');

    for (var i = 0; i < graphData.rows.length; i++)
    {
        if (graphData.rows[i][0] == "(not set)")
            graphData.rows[i][0] = "Others";

        table.addRow([graphData.rows[i][0], parseInt(graphData.rows[i][1])]);
    }

    var options = {
        colorAxis: {colors: ['#f5f5f5','#267114']}
    };
    if (col == 0)
        var chart = new google.visualization.GeoChart(document.getElementById('zeme'));
    else
        var chart = new google.visualization.ColumnChart(document.getElementById('zeme'));
    chart.draw(table, options);
}

function changeGraphZeme(id)
{
    localStorage.setItem("geoGraph", id);
    printGraphZeme(data_results[2], true);
}

/* Nastaví tlačítko u grafu přístupů ze země */

function setGeoGraphButton(id)
{
    $("ul#chooseGeoGraph li").removeClass("active");
    var item = $("ul#chooseGeoGraph li[data-change="+id+"]");
    item.addClass("active");
    var anchor = item.children("a");
    $("#chooseGeoGraphButton").text(anchor.text());
}


/* Stará se o to, aby se grafy chovali responzivně */
$(function(){
    $(window).resize(function(e){
        printGraphPristupy(data_results[0]);
        printGraphProhlizece(data_results[1]);
        printGraphZeme(data_results[2]);
    })
})


