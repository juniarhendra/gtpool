jQuery(document).ready(function(){
	
    var m2 = new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'line-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { y: '2006', a: 50},
            { y: '2007', a: 60},
            { y: '2008', a: 45},
            { y: '2009', a: 40},
            { y: '2010', a: 50},
            { y: '2011', a: 60},
            { y: '2012', a: 65}
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Series A'],
        gridTextColor: 'rgba(255,255,255,0.5)',
        lineColors: ['#fff'],
        lineWidth: '2px',
        hideHover: 'none',
        smooth: true,
        grid: true
   });
});