<?php if(session('flash_message')): ?>
<script>
    $(function(){

        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-full-width",
        }

        toastr.success('<?php echo e(session("flash_message"), false); ?>');
    });
</script>
<?php endif; ?><?php /**PATH E:\RCHH_Works\Crowdworks\Laravel\Laravel-admin\jpf_pm\src\resources\views/layouts/toastr.blade.php ENDPATH**/ ?>