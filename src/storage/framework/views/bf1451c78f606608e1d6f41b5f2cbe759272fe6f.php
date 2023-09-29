

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard'), false); ?></div>

                <div class="card-body">

                    <?php echo $__env->make('layouts.toastr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status'), false); ?>

                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?php echo e(route('product.volume.update'), false); ?>">

                        <?php echo csrf_field(); ?>

                        <p><?php echo e(date("Y/m/d"), false); ?></p>

                        <p><?php echo e($line->name, false); ?></p>

                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php echo e($error, false); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <table>
                            <tr>
                                <td>開始</td><td>終了</td><td>製品</td><td>作業者数</td><td>生産数</td><td>目標</td>
                            </tr>
                            <?php for($h=\WorkType::WORK_START; $h < \WorkType::WORK_END; $h++): ?>
    
                                <input type="hidden" name="result[<?php echo e($h, false); ?>][line_id]" value="<?php echo e($line->id, false); ?>" />
                                <tr>
                                    <td>
                                        <?php echo e($h, false); ?>:00 <input type="hidden" name="result[<?php echo e($h, false); ?>][work_start]" value="<?php echo e($h, false); ?>" />
                                    </td>
                                    <td>
                                        <?php echo e($h, false); ?>:59 <input type="hidden" name="result[<?php echo e($h, false); ?>][work_end]" value="<?php echo e($h, false); ?>" />
                                    </td>
                                    <td>
                                        <select id="product-at<?php echo e($h, false); ?>" name="result[<?php echo e($h, false); ?>][product_id]" class="product" data-h="<?php echo e($h, false); ?>"> 
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product->id, false); ?>" 
                                                    <?php if( $volumes[$h]['product_id'] ?? null === $product->id ): ?>
                                                        selected 
                                                    <?php endif; ?>
                                                >
                                                    <?php echo e($product->name, false); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <?php
                                            $name_worker = "result[$h][count_worker]";
                                            $value_worker = old("result.$h.count_worker", $volumes[$h]['count_worker'] ?? '');
                                        ?>
                                        <input type="number" name="<?php echo e($name_worker, false); ?>" value="<?php echo e($value_worker, false); ?>" />
                                    </td>
                                    <td>
                                        <?php
                                            $name_volume = "result[$h][count_volume]";
                                            $old_volume = old("result.$h.count_volume", $volumes[$h]['count_volume'] ?? '');
                                        ?>
                                        <input type="number" name="<?php echo e($name_volume, false); ?>" value="<?php echo e($old_volume, false); ?>" />
                                    </td>
                                    <td>
                                        <select id="goal-at<?php echo e($h, false); ?>" name="result[<?php echo e($h, false); ?>][goal]" disabled>
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product->id, false); ?>"
                                                    <?php if( $volumes[$h]['product_id'] ?? null == $product->id ): ?>
                                                        selected 
                                                    <?php endif; ?>
                                                >
                                                    <?php echo e($product->goal, false); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </table>

                        <input type="submit" value="確定" / >
                    </form>


                    <form id="formProductVolume">
                        <?php echo csrf_field(); ?>
                        <button id="plus" data-add="1">+</button>
                        <button id="minus" data-add="-1">-</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
            }
        });

        $(function() {
            $('select.product').on('change', function (e) {
                $('#goal-at' + $(this).data('h')).val($(this).val())
            });
            
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\RCHH_Works\Crowdworks\Laravel\jpf_pm\src\resources\views/product/index.blade.php ENDPATH**/ ?>