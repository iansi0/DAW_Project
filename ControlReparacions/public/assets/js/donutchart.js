
function createDonut(seriesArray,labelsArray,id){
    var options = {
        series: seriesArray,
        chart: {
            toolbar: {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                  download: true,
                },
            },
            width: 380,
            type: 'pie',
        },
        labels: labelsArray,
        responsive: [{
        breakpoint: 480,
        options: {
            chart: {
            width: 200
            },
            legend: {
            position: 'bottom'
            }
        }
        }]
    };

    var chart = new ApexCharts(document.querySelector(id), options);
    chart.render();
}
