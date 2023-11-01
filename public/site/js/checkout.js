const productTotalPrice = $(".product-total-price").data("index");
const shippingFeeElement = $(".shipping-fee");
const shippingFeeInputElement = $(".shipping-fee-value");
const totalPriceElement = $(".total-price");

let shippingFee;

function setSummary() {
    let provinceID = provinceWrapper.val();

    if (provinceID == 48) {
        shippingFee = 20000;
    } else {
        shippingFee = 35000;
    }

    let totalPrice = shippingFee + parseInt(productTotalPrice);

    shippingFeeInputElement.val(shippingFee);

    shippingFeeElement.html(
        shippingFee.toLocaleString("vi-VN", {
            style: "currency",
            currency: "VND",
        })
    );

    totalPriceElement.html(
        totalPrice.toLocaleString("vi-VN", {
            style: "currency",
            currency: "VND",
        })
    );
}
