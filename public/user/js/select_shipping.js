$(document).ready(function () {
    $("#city").change(function () {
        var id_city = $(this).val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: "/select-district-shipping", // Đảm bảo URL này đúng
            method: "POST",
            data: {
                id_city: id_city,
                _token: _token,
            },
            success: function (data) {
                $("#district").html(data);
            },
        });
    });

    $("#district").change(function () {
        var id_district = $(this).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/select-wards-shipping", // Đảm bảo URL này đúng
            method: "POST",
            data: {
                id_district: id_district,
                _token: _token,
            },
            success: function (data) {
                $("#wards").html(data);
            },
        });
    });

    $("#wards").change(function () {
        var valuesArray = [60000, 70000, 80000, 90000, 100000, 120000, 150000];
        var randomValue =
            valuesArray[Math.floor(Math.random() * valuesArray.length)];
        var formattedValue = randomValue.toLocaleString("vi-VN");
        $("#feeship").html(formattedValue);
        var priceCartText = $("#price_cart").text();
        // alert(priceCartText);
        var priceCartInt = parseInt(priceCartText.replace(/\./g, ""));
        // alert(priceCartInt);

        var totalOrder = priceCartInt + randomValue;
        // alert(totalOrder);
        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $("#displayTotal").html(formatNumber(totalOrder) + " đ");
    });
});
