// Copyright 2012 Google Inc. All Rights Reserved.
var data_results = new Array();

function makeApiCall() {

    gapi.client.analytics.data.ga.get({
        'ids': 'ga:'+tableId,
        'start-date': getPreviousMonthFormatted(),
        'end-date': getTodayFormatted(),
        'metrics': 'ga:sessions, ga:newUsers',
        'dimensions': 'ga:date',
    }).execute(handleCoreReportingResults);

    gapi.client.analytics.data.ga.get({
        'ids': 'ga:'+tableId,
        'start-date': getPreviousMonthFormatted(),
        'end-date': getTodayFormatted(),
        'metrics': 'ga:sessions',
        'dimensions': 'ga:browser',
    }).execute(handleCoreReportingBrowserResults);

    gapi.client.analytics.data.ga.get({
        'ids': 'ga:'+tableId,
        'start-date': getPreviousMonthFormatted(),
        'end-date': getTodayFormatted(),
        'metrics': 'ga:sessions',
        'dimensions': 'ga:country',
        'sort' : "-ga:sessions"
    }).execute(handleCoreReportingCountryResults);
}



/* Odchycení výsledků */
function handleCoreReportingResults(results) {
  if (!results.code) {
    data_results[0] =  results;
    printGraphPristupy(results);
  } else {
      printError($("#authorize-views"));
  }
}

function handleCoreReportingBrowserResults(results) {
    if (!results.code) {
        data_results[1] =  results;
        printGraphProhlizece(results);
    } else {
        printError($("#browsers-views"))
    }
}

function handleCoreReportingCountryResults(results) {
    if (!results.code) {
        data_results[2] =  results;
        printGraphZeme(results);
    } else {
        printError($("#authorize-country"))
    }
}


/* Pokud se vykytne chyba, vypíše odhlášení k danému grafu */
function printError(loc)
{
    var text = loc.children("span.text");
    var a_button = loc.children("button.authorize-button");
    var l_button = loc.children("button.logout-button");
    text.text(" Tento účet nemá oprávnění k přístupu.");
    a_button.css("display", "none");
    l_button.css("display","");
    loc.css("display", "");
    l_button.click(function(e){

        $.ajax({
            type: "POST",
            url: "https://accounts.google.com/logout"
        }).done(function( msg ) {
            location.reload()
        });
    });
}

function getTodayFormatted()
{
    var dateTime = new Date();
    var month = dateTime.getMonth() +1;
    var day = dateTime.getDate();

    if (month < 10)
        month = "0"+month;

    if (day < 10)
        day = "0"+day;

    var today = dateTime.getFullYear()+"-"+month+"-"+day;

    return today;
}

function getPreviousMonthFormatted()
{
    var dateTime = new Date();

    var prevMonth = dateTime.getMonth();

    if (prevMonth <= 0)
        prevMonth = 12;

    if (prevMonth < 10)
        prevMonth = "0"+prevMonth;

    var prevMonthFormatted = dateTime.getFullYear()+"-"+prevMonth+"-01";

    return prevMonthFormatted;
}