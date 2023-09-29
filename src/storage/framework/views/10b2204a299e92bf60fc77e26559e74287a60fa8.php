<div class="btn-group" style="margin-right: 5px" data-toggle="buttons">
    <label class="btn btn-sm btn-dropbox <?php echo e($btn_class, false); ?> <?php echo e($expand ? 'active' : '', false); ?>" title="<?php echo e(trans('admin.filter'), false); ?>">
        <input type="checkbox"><i class="fa fa-filter"></i><span class="hidden-xs">&nbsp;&nbsp;<?php echo e(trans('admin.filter'), false); ?></span>
    </label>

    <?php if($scopes->isNotEmpty()): ?>
    <button type="button" class="btn btn-sm btn-dropbox dropdown-toggle" data-toggle="dropdown">

        <span><?php echo e($label, false); ?></span>
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <?php $__currentLoopData = $scopes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scope): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $scope->render(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <li role="separator" class="divider"></li>
        <li><a href="<?php echo e($cancel, false); ?>"><?php echo e(trans('admin.cancel'), false); ?></a></li>
    </ul>
    <?php endif; ?>
</div>

<script>
var $btn = $('.<?php echo e($btn_class, false); ?>');
var $filter = $('#<?php echo e($filter_id, false); ?>');

$btn.unbind('click').click(function (e) {
    if ($filter.is(':visible')) {
        $filter.addClass('hide');
    } else {
        $filter.removeClass('hide');
    }
});
</script>
<?php /**PATH E:\RCHH_Works\Crowdworks\Laravel\Laravel-admin\jpf_pm\src\resources\views/laravel-admin/filter/button.blade.php ENDPATH**/ ?>