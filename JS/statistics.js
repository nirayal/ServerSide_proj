function data_statistics() {
    var request = new XMLHttpRequest();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200)
        {
            //this is the return
            console.log(request);
            var response = JSON.parse(this.responseText);
            console.log(response['graph_1']['response']);
            
            //graph 1
            first_graph_data = response["graph_1"]["response"];
            parseInt(first_graph_data['graph1_ques_25_mid_safe']);
            


                
        }
    }
    request.open("POST","statistics.php",true);
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send();
}



// window.onload = function () {

//     var chart = new CanvasJS.Chart("chartContainer", {
//         exportEnabled: true,
//         animationEnabled: true,
//         title:{
//             text: "The safety among the survey answers"
//         },
//         axisX: {
//             title: "Safety Level"
//         },
//         axisY: {
//             title: "Amount of Answers",
//             titleFontColor: "#4F81BC",
//             lineColor: "#4F81BC",
//             labelFontColor: "#4F81BC",
//             tickColor: "#4F81BC",
//             includeZero: true
//         },
//         toolTip: {
//             shared: true
//         },
//         legend: {
//             cursor: "pointer",
//             itemclick: toggleDataSeries
//         },
//         data: [{
//             type: "column",
//             name: "Not Safe",
//             showInLegend: true,      
//             yValueFormatString: "# People",
//             dataPoints: [
//                 { label: "public transport",  y: 10 },//js
//                 { label: "self light public transport", y: 20 }, //js
//             ]
//         },
//         {
//             type: "column",
//             name: "Mid Safe",
//             showInLegend: true,      
//             yValueFormatString: "# People",
//             dataPoints: [
//                 { label: "public transport",  y: 20 },//js
//                 { label: "self light public transport", y: 20 }, //js
//             ]
//         },
//         {
//             type: "column",
//             name: "Very Safe",
//             showInLegend: true,
//             yValueFormatString: "# People",
//             dataPoints: [
//                 { label: "public transport",  y: 20 },//js
//                 { label: "self light public transport", y: 20 }, //js
//             ]
//         }]
//     });
//     chart.render();
    
//     function toggleDataSeries(e) {
//         if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
//             e.dataSeries.visible = false;
//         } else {
//             e.dataSeries.visible = true;
//         }
//         e.chart.render();
//     }
    
// }

window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        exportEnabled: true,
        animationEnabled: true,
        title:{
            text: "Car Parts Sold in Different States"
        },
        subtitles: [{
            text: "Click Legend to Hide or Unhide Data Series"
        }], 
        axisX: {
            title: "States"
        },
        axisY: {
            title: "Oil Filter - Units",
            titleFontColor: "#4F81BC",
            lineColor: "#4F81BC",
            labelFontColor: "#4F81BC",
            tickColor: "#4F81BC",
            includeZero: true
        },
        axisY2: {
            title: "Clutch - Units",
            titleFontColor: "#C0504E",
            lineColor: "#C0504E",
            labelFontColor: "#C0504E",
            tickColor: "#C0504E",
            includeZero: true
        },
        toolTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        data: [{
            type: "column",
            name: "Oil Filter",
            showInLegend: true,      
            yValueFormatString: "#,##0.# Units",
            dataPoints: [
                { label: "New Jersey",  y: 19034.5 },
                { label: "Texas", y: 20015 },
                { label: "Oregon", y: 25342 },
                { label: "Montana",  y: 20088 },
                { label: "Massachusetts",  y: 28234 }
            ]
        },
        {
            type: "column",
            name: "Clutch",
            axisYType: "secondary",
            showInLegend: true,
            yValueFormatString: "#,##0.# Units",
            dataPoints: [
                { label: "New Jersey", y: 210.5 },
                { label: "Texas", y: 135 },
                { label: "Oregon", y: 425 },
                { label: "Montana", y: 130 },
                { label: "Massachusetts", y: 528 }
            ]
        }]
    });
    chart.render();
    
    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        e.chart.render();
    }
    
}