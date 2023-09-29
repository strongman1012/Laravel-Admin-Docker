<canvas id="comboChart" width="auto" height="90vh"></canvas>
<script>
$(function () {
    var ctx = document.getElementById("comboChart").getContext('2d');
    var labels = <?php echo json_encode($labels); ?>;
    var datasets = <?php echo json_encode($datasets); ?>;
    var yAxes = <?php echo json_encode($yAxes); ?>;
    console.log(labels,'labels',datasets,'datasets')
    var comboChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets,
        },
        options: {
            scales: {
                yAxes: yAxes,
            },
        },
    });
});
</script><?php /**PATH /var/www/resources/views/laravel-admin/chart.blade.php ENDPATH**/ ?>