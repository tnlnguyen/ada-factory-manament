// Load corechart packages.
google.charts.load('current', {'packages':['corechart']});
google.charts.load('current', {'packages':['bar']});
google.charts.load('current', {'packages':['line']});

// Draw the pie chart, line chartbar and chart when Charts is loaded.
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    // Datatable for piechart and colchart
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Animals');
    data.addColumn('number', 'No');
    data.addColumn({ role: 'style'});
    data.addRows([
        ['Dogs', 10, '#FE572D'],
        ['Cats', 8, '#FFD000'],
        ['Fish', 12, '#37C3C4'],
        ['Hamsters', 7, '#43AF88'],
        ['Other', 3, '#21252B']
    ]);

    // Piechart options
    var piechart_options = {//title:'SIMPLE PIE CHART',
                            width: 700,
                            height:400,
                            slices: {
                                0: { color: '#FE572D' },
                                1: { color: '#FFD000' },
                                2: { color: '#37C3C4' },
                                3: { color: '#43AF88' },
                                4: { color: '#21252B' },
                            }
    };

    // Draw piechart
    var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
    piechart.draw(data, piechart_options);


    // Datatable for linechart
    var data2 = google.visualization.arrayToDataTable([ 
        ['Month', 'Phones', 'Tablets', 'Laptops'],
            ['Jan', 114, 164, 234],
            ['Feb', 138, 178, 278],
            ['Mar', 200, 150, 270],         
            ['Apr', 235, 135, 190],
            ['May', 190, 160, 230]
        ]);

    // Linechart options
    var linechart_options = {//title: 'SIMPLE LINE CHART',
                            width: 700,
                            height: 400,
                            legend: { position: 'bottom' },
                            pointSize: 5,
                            series: {
                                0: { color: '#FE572D' },
                                1: { color: '#FFD000' },
                                2: { color: '#37C3C4' },
                            }
    };

    // Draw linechart
    var linechart = new google.visualization.LineChart(document.getElementById('linechart_div'));
    linechart.draw(data2, linechart_options);

    // Colchart options
    var colchart_options2 = {//title: 'Device Sale',
                            width: 700,
                            height: 400,
                            legend: 'none',
                            series: {
                                0: { color: '#FE572D' },
                                1: { color: '#FFD000' },
                                2: { color: '#37C3C4' },
                            }
                        };

    // Draw colchart
    var colchart2 = new google.visualization.ColumnChart(document.getElementById('colchart_div'));
    colchart2.draw(data2, colchart_options2);
}