@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @include('layouts.toastr')

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('product.volume.update') }}">

                        @csrf

                        <p>{{ date("Y/m/d") }}</p>

                        <p>{{ $line->name }}</p>

                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                        <table>
                            <tr>
                                <td>開始</td><td>終了</td><td>製品</td><td>作業者数</td><td>生産数</td><td>目標</td>
                            </tr>
                            @for ($h=\WorkType::WORK_START; $h < \WorkType::WORK_END; $h++)
    
                                <input type="hidden" name="result[{{ $h }}][line_id]" value="{{ $line->id }}" />
                                <tr>
                                    <td>
                                        {{ $h }}:00 <input type="hidden" name="result[{{ $h }}][work_start]" value="{{ $h }}" />
                                    </td>
                                    <td>
                                        {{ $h }}:59 <input type="hidden" name="result[{{ $h }}][work_end]" value="{{ $h }}" />
                                    </td>
                                    <td>
                                        <select id="product-at{{ $h }}" name="result[{{ $h }}][product_id]" class="product" data-h="{{ $h }}"> 
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" 
                                                    @if ( $volumes[$h]['product_id'] ?? null === $product->id )
                                                        selected 
                                                    @endif
                                                >
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        @php
                                            $name_worker = "result[$h][count_worker]";
                                            $value_worker = old("result.$h.count_worker", $volumes[$h]['count_worker'] ?? '');
                                        @endphp
                                        <input type="number" name="{{ $name_worker }}" value="{{ $value_worker }}" />
                                    </td>
                                    <td>
                                        @php
                                            $name_volume = "result[$h][count_volume]";
                                            $old_volume = old("result.$h.count_volume", $volumes[$h]['count_volume'] ?? '');
                                        @endphp
                                        <input type="number" name="{{ $name_volume }}" value="{{ $old_volume }}" />
                                    </td>
                                    <td>
                                        <select id="goal-at{{ $h }}" name="result[{{ $h }}][goal]" disabled>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    @if ( $volumes[$h]['product_id'] ?? null == $product->id )
                                                        selected 
                                                    @endif
                                                >
                                                    {{ $product->goal }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endfor
                        </table>

                        <input type="submit" value="確定" / >
                    </form>


                    <form id="formProductVolume">
                        @csrf
                        <button id="plus" data-add="1">+</button>
                        <button id="minus" data-add="-1">-</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
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

@endsection
