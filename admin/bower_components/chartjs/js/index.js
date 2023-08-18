var ctx = document.getElementById("myFirst").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Red", "Orange", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: 'Votes',
            data: [1, 4, 2, 3, 4, 3],
            backgroundColor: [
                '#1abc9c',
                '#e67e22',
                'rgba(255, 206, 86, 02)',
                'rgba(75, 192, 192, 02)',
                'rgba(153, 102, 255, 2)',
                'rgba(255, 159, 64, 2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});




// vertical bar chart code


var ctx = document.getElementById("myBar").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Orange", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: 'Votes',
            data: [1, 19, 5, 5, 4, 3],
            backgroundColor: [
                '#1abc9c',
                '#e67e22',
                'rgba(255, 206, 86, 02)',
                'rgba(75, 192, 192, 02)',
                'rgba(153, 102, 255, 2)',
                'rgba(255, 159, 64, 2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});



//Horizontal bar chart

var ctx = document.getElementById("myHBar").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ["Red", "Orange", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: 'Votes',
            data: [10, 6, 5, 8, 4, 3],
            backgroundColor: [
                '#1abc9c',
                '#e67e22',
                'rgba(255, 206, 86, 02)',
                'rgba(75, 192, 192, 02)',
                'rgba(153, 102, 255, 2)',
                'rgba(255, 159, 64, 2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});


//Line chart

var ctx = document.getElementById("myLine").getContext('2d');

var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Votes",
            backgroundColor: 'rgb(0,40,99,0)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 10, 45],
        }]
    },

    // Configuration options go here
    options: {}
});