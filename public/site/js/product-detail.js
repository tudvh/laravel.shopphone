// Product image slide

const sliderElement = document.querySelector(".slider");
const sliderDotsWrapper = sliderElement.querySelector(".slider-dots-wrapper");

const nextBtn = document.querySelector(".slider-next");
const prevBtn = document.querySelector(".slider-prev");

const sliderMain = document.querySelector(".slider-main");
const sliderItems = document.querySelectorAll(".slider-item");

const sliderDots = document.querySelector(".slider-dots");
const sliderDotItem = document.querySelectorAll(".slider-dot-item");

let sliderWidth = sliderElement.offsetWidth;
let position = 1;
let sliderItemsLen = sliderItems.length;

changeDot();

nextBtn.addEventListener("click", () => {
    if (position < sliderItemsLen) {
        position += 1;

        changeSlide();
        changeDot();
    } else {
        return;
    }
});

prevBtn.addEventListener("click", () => {
    if (position > 1) {
        position -= 1;

        changeSlide();
        changeDot();
    } else {
        return;
    }
});

sliderDotItem.forEach((item) => {
    item.addEventListener("click", (e) => {
        position = parseInt(e.target.dataset.index) + 1;

        changeSlide();
        changeDot();
    });
});

function changeSlide() {
    let positionX = (position - 1) * -sliderWidth;
    sliderMain.style.transform = `translateX(${positionX}px)`;
}

function changeDot() {
    let positionX = (position - 1) * -100 - 50;
    sliderDots.style.transform = `translateX(${positionX}px)`;

    for (item of sliderDotItem) {
        item.classList.remove("active");
    }

    sliderDotItem[position - 1].classList.add("active");
}

// End product image slide

// Add product to cart

const btnAddToCartElement = document.querySelector(".btn-add-to-cart");
const productQuantityElement = document.querySelector(
    ".product-quantity input[type=number]"
);
const productID = document.querySelector("meta[name=product-id]").dataset.index;

btnAddToCartElement.addEventListener("click", (e) => {
    e.preventDefault();

    const productQuantity = productQuantityElement.value;
    const _url = `${rootUrl}/cart/add/${productID}?quantity=${productQuantity}`;

    location.href = _url;
});

// End add product to cart
