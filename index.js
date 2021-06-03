// === pass input data ===

function searchPostcode() {
    const postcode = document.getElementById('postcodeField').value
    window.location.href = "result.html?postcode=" + postcode
}
 

function searchAddress() {
    const address = document.getElementById('addressField').value
    window.location.href = "result.html?addr=" + address
}

