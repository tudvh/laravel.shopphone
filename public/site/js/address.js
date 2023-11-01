const provinceWrapper = $(".provinces");
const districtWrapper = $(".districts");
const wardWrapper = $(".wards");

function getDefaultDistrictElement() {
    let defaultDistrictElement =
        '<option value="">--CHỌN QUẬN HUYỆN--</option>';
    return defaultDistrictElement;
}

function getDefaultWardElement() {
    let defaultWardElement = '<option value="">--CHỌN PHƯỜNG XÃ--</option>';
    return defaultWardElement;
}

// Set data province element
$.ajax({
    url: `${rootUrl}/address/province`,
    type: "GET",
    success: setDataProvinceElement,
    error: console.log,
});

function setDataProvinceElement(listProvince) {
    const provinceSelected = provinceWrapper.data("provinceid");

    const listProvinceElement = listProvince
        .map((province) => {
            if (province.id == provinceSelected) {
                return `<option selected value="${province.id}">${province.name}</option>`;
            } else {
                return `<option value="${province.id}">${province.name}</option>`;
            }
        })
        .join("");

    provinceWrapper.append(listProvinceElement);

    setSummary();

    if (provinceSelected) {
        getListDistrict(provinceSelected);
    }
}

// Set data district element
$(".provinces").change(() => {
    districtWrapper.attr("data-districtid", 0);
    districtWrapper.data("districtid", 0);

    const provinceID = $(".provinces").val();

    if (provinceID) {
        getListDistrict(provinceID);
    } else {
        setDataDistrictElement();
    }

    setDataWardElement();
    setSummary();
});

function getListDistrict(provinceID) {
    $.ajax({
        url: `${rootUrl}/address/district/${provinceID}`,
        type: "GET",
        success: setDataDistrictElement,
        error: console.log,
    });
}

function setDataDistrictElement(listDistrict = []) {
    const districtSelected = districtWrapper.data("districtid");

    listDistrictElement =
        getDefaultDistrictElement() +
        listDistrict
            .map((district) => {
                if (district.id == districtSelected) {
                    return `<option selected value="${district.id}">${district.name}</option>`;
                } else {
                    return `<option value="${district.id}">${district.name}</option>`;
                }
            })
            .join("");

    districtWrapper.html(listDistrictElement);

    if (districtSelected) {
        getListWard(districtSelected);
    }
}

// Set data ward element
$(".districts").change(() => {
    wardWrapper.attr("data-wardid", 0);
    wardWrapper.data("wardid", 0);

    const districtID = $(".districts").val();

    if (districtID) {
        getListWard(districtID);
    } else {
        setDataWardElement();
    }
});

function getListWard(districtID) {
    $.ajax({
        url: `${rootUrl}/address/ward/${districtID}`,
        type: "GET",
        success: setDataWardElement,
        error: console.log,
    });
}

function setDataWardElement(listWard = []) {
    const wardSelected = wardWrapper.data("wardid");

    listWardElement =
        getDefaultWardElement() +
        listWard
            .map((ward) => {
                if (ward.id == wardSelected) {
                    return `<option selected value="${ward.id}">${ward.name}</option>`;
                } else {
                    return `<option value="${ward.id}">${ward.name}</option>`;
                }
            })
            .join("");

    wardWrapper.html(listWardElement);
}
