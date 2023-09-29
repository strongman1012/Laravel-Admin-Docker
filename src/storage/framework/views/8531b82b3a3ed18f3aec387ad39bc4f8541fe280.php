<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo e($label, false); ?></label>
    <div class="col-sm-8" >
        <div class="input-group input-group-sm">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text"
                   class="form-control"
                   id="<?php echo e($id['start'], false); ?>"
                   placeholder="<?php echo e($label, false); ?>"
                   name="<?php echo e($name['start'], false); ?>"
                   value="<?php echo e(request()->input("{$column}.start", \Illuminate\Support\Arr::get($value, 'start')), false); ?>"
                   autocomplete="off"
            />

            <span class="input-group-addon" style="border-left: 0; border-right: 0;">-</span>

            <input type="text"
                   class="form-control"
                   id="<?php echo e($id['end'], false); ?>"
                   placeholder="<?php echo e($label, false); ?>"
                   name="<?php echo e($name['end'], false); ?>"
                   value="<?php echo e(request()->input("{$column}.end", \Illuminate\Support\Arr::get($value, 'end')), false); ?>"
                   autocomplete="off"
            />
        </div>
    </div>
</div><?php /**PATH E:\RCHH_Works\Crowdworks\Laravel\Laravel-admin\jpf_pm\src\resources\views/laravel-admin/filter/betweenDatetime.blade.php ENDPATH**/ ?>