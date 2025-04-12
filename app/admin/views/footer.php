<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Doanh thu ($)',
                data: [5000, 10000, 15000, 20000, 25000, 30000],
                backgroundColor: 'rgba(255, 99, 132, 0.6)'
            }]
        }
    });
</script>
