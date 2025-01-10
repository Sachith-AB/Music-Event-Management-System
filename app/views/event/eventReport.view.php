<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Report</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventReport.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

        <div class = "event-header">

            <div class="event-header-content">

                    <h1>Global Beats Festival</h1>

                <div class="date-venue">

                    <div class="icon">
                        <div class="calender-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        
                        <h3>Date : 05/01/2025 </h3>
                    </div>

                    <div class="icon">
                        <div class="venue-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        
                        <h3> Venue : Lotus tower</h3>
                    </div>
                    
                
                    <div class="icon">
                        <div class="users-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        
                        <h3>Total Attendees : 1000</h3>
                    </div>

                    


                </div>
                   

                    


            </div>
                
        </div>

        <div class= "chart-container">

                <div class = "bar-chart">
                    <h3>Revenue by Tickets</h3>
                    <canvas id='barChart'></canvas>

                </div>

                <div class = "pie-chart">
                    <h3>Expense Breakdown</h3>
                    <canvas id="pieChart"></canvas>
                </div>
        </div>

        <div class="profit-container">
                <i class="fa-solid fa-arrow-up"></i>
                <h1>Net Profit : 1500000<h1>
        </div>

        <div class="rating-container">
                <i class="fa fa-star" aria-hidden="true"></i>
                <h2>Overall Rating : 4.5<h2>
                <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class = "word-cloud">
            <h4>Word Cloud</h4>
            <p>words here</p>
        </div>

        <div class = "feedback-container">

            <h4>feedback</h4>
        </div>


        <script>
            //Barchart: Revenue by tickets
            const barCtx = document.getElementById('barChart').getContext('2d');
            new Chart(barCtx,{
                type: 'bar',
                data: {
                    labels: ['VIP','General','Student'],
                    datasets: [{
                        label: 'Revenue ($)',
                        data : [12000,15000,5000],
                        backgroundColor:['#4CAF50', '#FFC107', '#2196F3']
                    }]
                },
                options: {
                    responsive : true,
                    maintainAspectRatio: true,
                    aspectRatio: 2, 
                    plugins: {
                        legend: {display: true},
                        title: {display: true, text: 'Revenue by tickets'}
                    }
                }
            });

            //Pie chart: Expense Breakdown
            const pieCtx = document.getElementById('pieChart').getContext('2d');
            new Chart(pieCtx, {
                type:'pie',
                data: {
                    labels: ['Marketing','Venue','Logistics'],
                    datasets : [{
                        data: [4000, 7000, 3000],
                        backgroundColor:  ['#FF5722', '#8BC34A', '#03A9F4']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {display: true},
                        title: {display: true, text: 'Expense Breakdown'}
                    }
                }
            });
        </script>





</body>

</html>

