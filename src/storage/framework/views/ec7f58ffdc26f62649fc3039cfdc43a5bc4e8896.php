<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        <?php if(config('admin.show_environment')): ?>
            <strong>Env</strong>&nbsp;&nbsp; <?php echo config('app.env'); ?>

        <?php endif; ?>

        &nbsp;&nbsp;&nbsp;&nbsp;

        <?php if(config('admin.show_version')): ?>
        <strong>Version</strong>&nbsp;&nbsp; <?php echo \Encore\Admin\Admin::VERSION; ?>

        <?php endif; ?>

    </div>
    <!-- Default to the left -->
    <strong>heraeus electro nite</strong>
</footer><?php /**PATH E:\RCHH_Works\Crowdworks\Laravel\Laravel-admin\jpf_pm\src\resources\views/laravel-admin/partials/footer.blade.php ENDPATH**/ ?>