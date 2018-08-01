$(document).ready(function() {
    console.log('monitor loaded');

    var heartbeat = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var temperature = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    var tempChart = new Chartist.Line('#temperature', {
        // labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        series: [
            [temperature.slice(temperature.length-30, temperature.length)],
        ]
    }, {
        high: 50,
        low: 0,
        fullWidth: true,
        chartPadding: {
            right: 40
        }
    });

    var beatChart = new Chartist.Line('#heartbeat', {
        // labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        series: [
            [heartbeat.slice(heartbeat.length-30, heartbeat.length)],
        ]
    }, {
        high: 200,
        low: 0,
        fullWidth: true,
        chartPadding: {
            right: 40
        }
    });

    function render() {
        retrive();

        var newBeat = getRandomInt(1, 200);
        document.getElementById('heartbeat-current').innerHTML = newBeat;
        var newTemp = getRandomInt(1, 50);
        document.getElementById('temperature-current').innerHTML = newTemp;
        heartbeat.push(newBeat);
        temperature.push(newTemp);
        // var newSeries = {series: [[increment, increment+1, increment-2, increment+3, increment]]};
        var beatSeries = {
            series: [heartbeat.slice(heartbeat.length-30, heartbeat.length)]
        };
        var tempSeries = {
            series: [temperature.slice(temperature.length-30, temperature.length)]
        };
        beatChart.update(beatSeries);
        tempChart.update(tempSeries);
        console.log('updated');
        setTimeout(render, 1000);
    }

    render();
});
