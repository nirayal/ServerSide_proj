window.onload = function data_statistics() {
    var request = new XMLHttpRequest();
    request.onreadystatechange=function(){
        var a;
        if(request.readyState == 4 && request.status == 200)
        {
            //this is the return
            console.log(request);
            var response = JSON.parse(this.responseText);
            console.log(response['graph_1']['response']);
            
            //graph 1
            var first_graph_data = response["graph_1"]["response"];

            //graph 2
            var second_graph_data = response["graph_2"]["response"]['graph2_cities'];
            var dataPointsArray = [];
 
            for (const [key,value] of Object.entries(second_graph_data)) {
                dataPointsArray.push({ label: (key), y: parseFloat(value) });
            }
            
            //graph 3

            
        }
        //graph 1
        var chart = new CanvasJS.Chart("chartContainer", {
                    exportEnabled: true,
                    animationEnabled: true,
                    title:{
                        text: "The safety among the survey answers"
                    },
                    axisX: {
                        title: "Safety Level"
                    },
                    axisY: {
                        title: "Amount of Answers",
                        titleFontColor: "#4F81BC",
                        lineColor: "#4F81BC",
                        labelFontColor: "#4F81BC",
                        tickColor: "#4F81BC",
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
                        name: "Not Safe",
                        showInLegend: true,      
                        yValueFormatString: "#0 People",
                        dataPoints: [
                            { label: "public transport",  y: parseInt(first_graph_data['graph1_ques_25_not_safe']) },
                            { label: "self light public transport", y: parseInt(first_graph_data['graph1_ques_34_not_safe']) },
                        ]
                    },
                    {
                        type: "column",
                        name: "Mid Safe",
                        showInLegend: true,      
                        yValueFormatString: "#0 People",
                        dataPoints: [
                            { label: "public transport",  y: parseInt(first_graph_data['graph1_ques_25_mid_safe']) },
                            { label: "self light public transport", y: parseInt(first_graph_data['graph1_ques_34_mid_safe']) },
                        ]
                    },
                    {
                        type: "column",
                        name: "Very Safe",
                        showInLegend: true,
                        yValueFormatString: "#0 People",
                        dataPoints: [
                            { label: "public transport",  y: parseInt(first_graph_data['graph1_ques_25_very_safe']) },
                            { label: "self light public transport", y: parseInt(first_graph_data['graph1_ques_34_very_safe']) },
                        ]
                    }]
                });
        chart.render();

        //graph 2

        var chart1 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "The avarage travel time to the collage by city"
            },
            axisY: {
                scaleBreaks: {
                    customBreaks: [{
                        startValue: null,
                        endValue: null
                    }]
                }
            },
            data: [{
                type: "column",
                yValueFormatString: "#0 Minutes",
                dataPoints: dataPointsArray
            }]

        });       
        chart1.render();




        
    }
    request.open("POST","statistics.php",true);
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    request.send();
}

//for chart 1
function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else {
        e.dataSeries.visible = true;
    }
    e.chart.render();
}
