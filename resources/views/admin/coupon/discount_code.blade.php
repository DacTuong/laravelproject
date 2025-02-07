@extends('admin_layout')
@section('admin_content')
<form action="{{URL::to('/save-coupon')}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <h3>Phiếu giảm giá</h3>
    </div>
    <div class="form-group">
        <label>Tên mã</label>
        <input type="text" class="form-control" name="name_code" value="">
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="discountCodeInput">Mã giảm giá</label>
            <input type="text" name="discountCode" class="form-control" id="discountCodeInput" value="">
        </div>
    </div>
    <div class="form-group">
        <label>Số lượng</label>
        <input type="text" class="form-control" name="qty_code" value="">
    </div>
    <div class="form-group">
        <label>Hình thức giảm</label>
        <select name="type_code" id="type_code">
            <option value="fixed">Theo số tiền</option>
            <option value="percent">Theo phần trăm</option>
        </select>
    </div>
    <div class="form-group">
        <label>Giá trị phiếu</label>
        <input type="number" class="form-control" name="discount_amount" id="discount_amount" value="">
    </div>

    <label>Ngày bắt đầu</label>
    <input type="date" class="" name="start_date" value="">


    <label>Ngày kết thúc</label>
    <input type="date" class="" name="end_date" value="">
    <div>
        <button type="submit" name="save_coupon" class="btn btn-primary">Lưu mã giảm giá</button>
    </div>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type_code');
        const discountInput = document.getElementById('discount_amount');

        function validateDiscountInput() {
            if (typeSelect.value === 'percent') {
                discountInput.value = discountInput.value.slice(0, 2);
            } else {
                discountInput.value = '';
            }
        }

        typeSelect.addEventListener('change', validateDiscountInput);

        // Gọi hàm validateDiscountInput để kiểm tra ngay khi trang được tải
        validateDiscountInput();

        // Giới hạn ký tự nhập vào cho discount khi type là percent
        discountInput.addEventListener('input', function() {
            if (typeSelect.value === 'percent') {
                discountInput.value = discountInput.value.slice(0, 2);
            }
        });
    });
</script>

@endsection