
function createDonut(title,seriesArray,labelsArray,id){
    var colorChart;
    console.log(seriesArray);
    if (id=="#state") {
        colorChart=['#333333', '#9B2C2C', '#C53030', '#EF4444', '#F87171', '#FCD34D', '#FBBF24', '#F59E0B','#48BB78', '#34D399', '#22C55E', '#16A34A', '#2563EB', '#4B5563'];
    }else{
        colorChart=[ '#22C55E', '#2563EB', '#EAB308', '#DB2777', '#775DD0', '#0D9488', '#BE185D', '#4338CA', '#991B1B', '#15803D', '#0369A1', '#C2410C', '#A3E635', '#FFDC00'];
    }

    if (id=="#center") {
        format='€';
    }else if(id=="#state"){
        format='%';
    }else{
        format='%';
    }
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
            width: 500,
            type: 'pie',
            
        },

        colors: colorChart,
          
        title:{
            text: title,
            align:'center',
            style:{
                fontSize: '20px',
                fontFamily: 'system-ui'
            }
        },
        labels: labelsArray,
        tooltip: {
            enabled: true,
            
            formatter: function (val, opts) {
                return val+format;
            },
            
          },
        
        responsive: [{
        breakpoint: 480,
        options: {
            chart: {
            width: 300
            },
            legend: {
                position: 'bottom',
                width:'40px',
            }
        }
        }]
    };

    var chart = new ApexCharts(document.querySelector(id), options);
    chart.render();
}
