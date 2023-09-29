
<?php $__env->startSection('content'); ?>
<canvas id="myChart"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');

const chartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
        label: 'Sales',
        data: [65, 59, 80, 81, 56, 55, 40],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
    }]
};

new Chart(ctx, {
    type: 'bar', // Change this to the desired chart type (e.g., 'line', 'bar', 'pie', etc.)
    data: chartData,
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/chart.blade.php ENDPATH**/ ?>