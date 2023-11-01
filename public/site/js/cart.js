// Edit product cart

const listCartItemElement = document.querySelectorAll(".cart-item");

for (let cartItemElement of listCartItemElement) {
    const productID = cartItemElement.dataset.index;

    const quantityElement = cartItemElement.querySelector(".quantity input");
    const editCartElement = cartItemElement.querySelector(".action .edit");

    editCartElement.addEventListener("click", (e) => {
        e.preventDefault();

        const cartQuantity =
            quantityElement.value != "" ? quantityElement.value : 1;

        location.href = `${currentUrl}/update/${productID}/${cartQuantity}`;
    });
}

// End edit product cart

// Select product cart

const checkAllElement = document.querySelector(".cart th input");
const listCheckElement = document.querySelectorAll(
    ".cart td input[type=checkbox]"
);
const totalCheckElement = document.querySelector(".total-check");

if (checkAllElement) {
    checkAllElement.addEventListener("change", () => {
        selectProductCart(checkAllElement.checked);
    });
}

listCheckElement.forEach((checkElement) => {
    checkElement.addEventListener("change", () => {
        setTotalCheck();
    });
});

function selectProductCart(isCheck) {
    for (checkElement of listCheckElement) {
        checkElement.checked = isCheck;
    }

    setTotalCheck();
}

function setTotalCheck() {
    let totalCheck = 0;

    for (checkElement of listCheckElement) {
        if (checkElement.checked) {
            totalCheck += 1;
        }
    }

    totalCheckElement.innerHTML = totalCheck;

    // Is check all?
    if (totalCheck == listCheckElement.length) {
        checkAllElement.checked = true;
    } else if (totalCheck == 0) {
        checkAllElement.checked = false;
    }
}

// End select product cart

// Remove select product cart

const removeManyElement = document.querySelector(".remove-many");

if (removeManyElement) {
    removeManyElement.addEventListener("click", (e) => {
        e.preventDefault();

        const totalCheckArr = [];

        listCheckElement.forEach((checkElement) => {
            if (checkElement.checked) {
                totalCheckArr.push(checkElement.dataset.index);
            }
        });

        if (totalCheckArr.length) {
            const totalCheckString = totalCheckArr.toString();

            location.href = `${currentUrl}/remove/${totalCheckString}`;
        }
    });
}

// End remove select product cart
