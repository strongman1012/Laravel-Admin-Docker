<div class="dropdown pull-right column-selector">
    <button type="button" class="btn btn-sm btn-instagram dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-table"></i>
        &nbsp;
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <ul>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                if (empty($visible)) {
                    $checked = 'checked';
                } else {
                    $checked = in_array($key, $visible) ? 'checked' : '';
                }
                ?>

                <li class="checkbox icheck">
                    <label>
                        <input type="checkbox" class="column-select-item" value="<?php echo e($key, false); ?>" <?php echo e($checked, false); ?>/>&nbsp;&nbsp;&nbsp;<?php echo e($label, false); ?>

                    </label>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
        <li class="divider"></li>
        <li class="text-right">
            <button class="btn btn-sm btn-default column-select-all"><?php echo e(__('admin.all'), false); ?></button>&nbsp;&nbsp;
            <button class="btn btn-sm btn-primary column-select-submit"><?php echo e(__('admin.submit'), false); ?></button>
        </li>
    </ul>
</div>

<style>
.column-selector {
    margin-right: 10px;
}

.column-selector .dropdown-menu {
    padding: 10px;
    height: auto;
    max-height: 500px;
    overflow-x: hidden;
}

.column-selector .dropdown-menu ul {
    padding: 0;
}

.column-selector .dropdown-menu ul li {
    margin: 0;
}

.column-selector .dropdown-menu label {
    width: 100%;
    padding: 3px;
}
</style>

<script>
$('.column-select-submit').on('click', function () {

    var defaults = <?php echo json_encode($defaults, 15, 512) ?>;
    var selected = [];

    $('.column-select-item:checked').each(function () {
        selected.push($(this).val());
    });

    if (selected.length == 0) {
        return;
    }

    var url = new URL(location);

    if (selected.sort().toString() == defaults.sort().toString()) {
        url.searchParams.delete('_columns_');
    } else {
        url.searchParams.set('_columns_', selected.join());
    }

    $.pjax({container:'#pjax-container', url: url.toString()});
});

$('.column-select-all').on('click', function () {
    $('.column-select-item').iCheck('check');
    return false;
});

$('.column-select-item').iCheck({
    checkboxClass:'icheckbox_minimal-blue'
});
</script>
<?php /**PATH E:\RCHH_Works\Crowdworks\Laravel\Laravel-admin\jpf_pm\src\resources\views/laravel-admin/components/grid-column-selector.blade.php ENDPATH**/ ?>