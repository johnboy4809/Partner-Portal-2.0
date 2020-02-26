var $mc = jQuery.noConflict(); // remove conficts with $ for any plugin js

var cases       = $mc('#casesChart');
var test        = $mc('#myChart');
var printers    = $mc('#printersChart');

var myChart = new Chart(test, {
    type: 'doughnut',
    data: {
        labels: [],
        datasets: [{
            data: [],
            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
    }
});

var printerChart = new Chart(printers, {
    type: 'doughnut',
    data: {
        labels: [],
        datasets: [{
            data: [],
            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
    }
});

// logic to get new data
var getData = function() {
    $mc.ajax({
        type 		: 'post',
        dataType 	: 'json',
        url			: ajaxurl,
        data		: "action=chart-cases-totals",    
        success 	: function(data) {
            myChart.data.labels = data.labels
            myChart.data.datasets[0].data = data.values;
            myChart.update();
        }
    });    
};

var getPrinters = function() {
    $mc.ajax({
        type 		: 'post',
        dataType 	: 'json',
        url			: ajaxurl,
        data		: "action=chart-class-totals",    
        success 	: function(data) {
            printerChart.data.labels = data.labels
            printerChart.data.datasets[0].data = data.values;
            printerChart.update();
        }
    });    
};





$mc(function() {
    'use strict';

    // get new data every 3 seconds
    // setInterval(getData, 3000);
    
    // getData();
    // getPrinters();

});       