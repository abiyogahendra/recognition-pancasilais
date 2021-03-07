var pancasilais = parseInt($('input[name=data_pancasilais]').val()) 
var netral = parseInt($('input[name=data_netral]').val())
var negative = parseInt($('input[name=data_negative]').val())


Highcharts.chart('report-persentase', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Riwayat Pelabelan'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
      name: 'Pancasilais',
      y: pancasilais,
      sliced: true,
      selected: true
    }, {
      name: 'Netral',
      y: netral
    }, {
      name: 'Negative',
      y: negative
    }]
  }]
});