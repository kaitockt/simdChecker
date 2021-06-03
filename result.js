window.addEventListener("load", function() {
    let href = window.location.href


    // === search by postcode ===

    if(href.includes("postCode")) {

        // === get and display data from url ===

        let postcode = href.substring(href.indexOf("postCode")+9, href.length)
        if(postcode.includes("+")) {
            var stdPostcode = postcode.replaceAll("+", " ")
        }
        
        let result_postcode = document.getElementById('result_postcode')
        result_postcode.innerHTML = stdPostcode

        // === get data from database ===

        this.fetch(`getsimd.php?pc=${postcode}`)
        .then(response => response.json())
        .then(data => {
            let ranks = data["ranks"]

            // counting and output
            countAndOutput(ranks)
        })

    }


    // === search by address ===

    if(href.includes("addr")) {

        // === get data from url ===

        let address = href.substring(href.indexOf("addr")+5, href.length)

        // === get data from database ===

        this.fetch(`getpostcode.php?addr=${address}`)
        .then(response => response.json())
        .then(data => {
            let ranks = data["ranks"]

            // display address and postcode data
            if(address.includes("+")) {
                var stdAddr = address.replaceAll("+", " ")
            }
            let result_postcode = document.getElementById('result_postcode')
            result_postcode.innerHTML = stdAddr+" -- "+data["Post Code"]

            // counting and output
            countAndOutput(ranks)

        })
        
    }
})


function countAndOutput(ranks) {

    let datazone = 6976 // datazone in 2020

        // color of each grade
        divColor = {
            1: "#a50026",
            2: "#d73027",
            3: "#f46d43",
            4: "#fdae61",
            5: "#fee090",
            6: "#e0f3f8",
            7: "#abd9e9",
            8: "#74add1",
            9: "#4575b4",
            10: "#313695"
        }
        
        for(const rank in ranks) {

            // count the decile of each category
            let decile = parseFloat(`${ranks[rank]}`)/datazone*10

            // find their grade by rounding up their decile
            let grade = Math.ceil(decile)
            console.log(rank+" -- "+decile+" -- "+grade)
            
            // === html display ===

            let resultDiv = this.document.getElementById(`${rank}`)
            
            // content
            resultDiv.innerHTML = `
                <p>${rank}: ${ranks[rank]}</p>
                <p>Grade: ${grade}</p>
            `
            // background color
            resultDiv.style.background = `${divColor[grade]}` 

            // font color
            if([1,2,3,8,9,10].includes(grade)) {
                resultDiv.style.color = "white"
            }
            
        }
}

function displayMoreInfo() {
    document.getElementById('moreInfo').style.display = "block"
    document.getElementById('moreInfoBtn').style.display = "none"
}