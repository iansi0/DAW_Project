function createDateChart(title,seriesData,months,name,text,id){
    var options = {
        series: [{
        name: name,
        data: seriesData
      }],
        chart: {
        height: 350,
        type: 'bar',
      },
      colors:['#22C55E', '#2563EB', '#EAB308', '#DB2777', '#775DD0', '#0D9488', '#BE185D', '#4338CA', '#991B1B', '#15803D', '#0369A1', '#C2410C', '#A3E635', '#FFDC00'],
      
      title:{
        text: title,
        align:'center',
        style:{
            fontSize: '20px',
            fontFamily: 'system-ui'
        }
      },
      plotOptions: {
        bar: {
          borderRadius: 10,
          dataLabels: {
            position: 'top', // top, center, bottom
          },
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        offsetY: -20,
        style: {
          fontSize: '12px',
          colors: ["#304758"]
        }
      },
      
      xaxis: {
        categories: months,
        position: 'top',
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        crosshairs: {
          fill: {
            type: 'gradient',
            gradient: {
              colorFrom: '#D8E3F0',
              colorTo: '#BED1E6',
              stops: [0, 100],
              opacityFrom: 0.4,
              opacityTo: 0.5,
            }
          }
        },
        tooltip: {
          enabled: true,
        }
      },
      yaxis: {
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false,
        },
        labels: {
          show: false,
          formatter: function (val) {
            return val;
          }
        }
      
      },
      title: {
        text: text,
        floating: true,
        offsetY: 330,
        align: 'center',
        style: {
          color: '#444'
        }
      }
      };

      var chart = new ApexCharts(document.querySelector(id), options);
      chart.render();
    
}