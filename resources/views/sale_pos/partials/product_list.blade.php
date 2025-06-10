<div class="table-wrapper">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 80px;">P.Code</th>
                <th style="width: 200px;">P.Name</th>
                <th style="width: 80px;">Unit</th>
                <th style="width: 80px;">Qty</th>
                <th style="width: 120px;">Rate</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products->sortBy('sub_sku') as $product)
                <tr>
                    <td>{{ $product->sub_sku }}</td>
                    <td>{{ $product->name }} @if($product->type == 'variable') - {{ $product->variation }} @endif</td>
                    <td>{{ $product->unit ?? 'Nos' }}</td>
                    <td>
                        @if($product->enable_stock)
                            {{ @num_format($product->qty_available) }}
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        @format_currency($product->selling_price)
                        @if(!empty($show_prices))
                            @foreach($product->group_prices as $group_price)
                                @if(array_key_exists($group_price->price_group_id, $allowed_group_prices))
                                    <br>
                                    <small class="text-muted">
                                        {{ $allowed_group_prices[$group_price->price_group_id] }}: 
                                        @format_currency($group_price->price_inc_tax)
                                    </small>
                                @endif
                            @endforeach
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">@lang('lang_v1.no_products_to_display')</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<style>

	#product_list_body{
		overflow-y:hidden;
	}
	.table-wrapper {
    max-height: 485px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
    font-size: 13px;
}

.table thead {
    position: sticky;
    top: 0;
    background-color: #007bff;
    color: white;
    z-index: 1;
}

.table th,
.table td {
    padding: 6px 10px;
    text-align: left;
    vertical-align: middle;
    border: 1px solid #dee2e6;
    white-space: nowrap;
}

.table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

    .lg\:tw-w-\[40\%\] {
        width: 60%;
    }

.table tbody tr:hover {
    background-color: #f1f1f1;
}

</style>