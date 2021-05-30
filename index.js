
function searchPostcode() {
    // pass input data
    const postcode = document.getElementById('postcodeField').value
    var obj = JSON.parse('{"Post Code":"EH7 6FD","ranks":{"Total Rank":"6305","Income":"5990.0","Employment":"5627.0","Education":"5862.0","Health":"6387.0","Geographic Access":"4195.0","Crime":"4798.0","Housing":"1836.0"}}')
    console.log(obj)

    window.location.href = "result.html?postcode=" + postcode

}
 


function searchAddress() {
    const address = document.getElementById('addressField').value

}

