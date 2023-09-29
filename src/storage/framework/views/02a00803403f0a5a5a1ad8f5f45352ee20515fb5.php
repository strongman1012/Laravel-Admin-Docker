

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard'), false); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status'), false); ?>

                        </div>
                    <?php endif; ?>


                    <p><?php echo e(date("Y/m/d"), false); ?></p>

                    <form method="get" action="<?php echo e(route('product.volume.index'), false); ?>">
                        <select name="line_id">
                            <?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($line->id, false); ?>">
                                    <?php echo e($line->name, false); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <input type="submit" value="決定" / >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\RCHH_Works\Crowdworks\Laravel\Laravel-admin\jpf_pm\src\resources\views/line/index.blade.php ENDPATH**/ ?>