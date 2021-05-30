window.addEventListener("load", function(){
    let href = window.location.href;
    if(href.includes("postCode")){

        // === get and display data from url ===

        let postcode = href.substring(href.indexOf("postCode")+9, href.length);
        
        let result_postcode = document.getElementById('result_postcode')
        result_postcode.innerHTML = postcode

        // === get data via JSON ===

        var obj = JSON.parse('{"Post Code":"EH7 6FD","ranks":{"Total Rank":"6305","Income":"5990.0","Employment":"5627.0","Education":"5862.0","Health":"6387.0","Geographic Access":"4195.0","Crime":"4798.0","Housing":"1836.0"}}')
        let ranks = obj["ranks"]


        // === counting  and output ===

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
})