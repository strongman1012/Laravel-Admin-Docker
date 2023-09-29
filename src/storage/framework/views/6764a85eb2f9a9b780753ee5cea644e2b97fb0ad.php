<?php if(!$holdAll): ?>
<div class="btn-group <?php echo e($all, false); ?>-btn" style="display:none;margin-right: 5px;">
    <a class="btn btn-sm btn-default hidden-xs"><span class="selected"></span></a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <?php if(!$actions->isEmpty()): ?>
    <ul class="dropdown-menu" role="menu">
        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($action instanceof \Encore\Admin\Actions\BatchAction): ?>
                <li><?php echo $action->render(); ?></li>
            <?php else: ?>
                <li><a href="#" class="<?php echo e($action->getElementClass(false), false); ?>"><?php echo $action->render(); ?> </a></li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
</div>
<?php endif; ?>

<script>
$('.<?php echo e($all, false); ?>').iCheck({checkboxClass:'icheckbox_minimal-blue'});

$('.<?php echo e($all, false); ?>').on('ifChanged', function(event) {
    if (this.checked) {
        $('.<?php echo e($row, false); ?>-checkbox').iCheck('check');
    } else {
        $('.<?php echo e($row, false); ?>-checkbox').iCheck('uncheck');
    }
}).on('ifClicked', function () {
    if (this.checked) {
        $.admin.grid.selects = {};
    } else {
        $('.<?php echo e($row, false); ?>-checkbox').each(function () {
            var id = $(this).data('id');
            $.admin.grid.select(id);
        });
    }

    var selected = $.admin.grid.selected().length;

    if (selected > 0) {
        $('.<?php echo e($all, false); ?>-btn').show();
    } else {
        $('.<?php echo e($all, false); ?>-btn').hide();
    }

    $('.<?php echo e($all, false); ?>-btn .selected')
        .html("<?php echo e(trans('admin.grid_items_selected'), false); ?>".replace('{n}', selected));
});
</script>
<?php /**PATH /var/www/resources/views/laravel-admin/grid/batch-actions.blade.php ENDPATH**/ ?>