document.addEventListener('DOMContentLoaded', function(event) {
    const colorGrade = {
        1: '980528',
        2: 'c53029',
        3: 'df6742',
        4: 'e7a15d',
        5: 'e8ce87',
        6: 'cddfe5',
        7: '9ec8d7',
        8: '6ca0c2',
        9: '426ea8',
        10: '30358c'
    }

    //check by post code
    document.getElementById("submit-pc").addEventListener("click", function(){
        let postCode = document.getElementById("postCode").value;
        document.getElementById('result-body').innerHTML="";
        checkByPostCode(postCode);
    });

    //search by address
    document.getElementById("submit-addr").addEventListener("click", function(){
        let addr = document.getElementById("addr").value;
        document.getElementById('result-body').innerHTML="";
        searchByAddr(addr);
    });
        

    function checkByPostCode(postCode){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                //show result card
                document.getElementById("result").style.display = "block"
                //show post code on result card header
                document.getElementById("result-pc").innerHTML=postCode

                //show simd
                let simds = JSON.parse(this.responseText)["ranks"];
                let divSimd = document.createElement("div");
                divSimd.id = "simd";
                document.getElementById("result-body").appendChild(divSimd);
                for(const k in simds){
                    document.getElementById('simd').appendChild(createSIMDBox(k, simds[k]));
                }

                //show Cloest POIs
                let pois = response["poi"];
                console.log(pois);
                for(const poi in pois){
                    let p = document.createElement('p');
                    p.innerHTML = poi + ": " + pois[poi];
                    document.getElementById('result-body').appendChild(p);
                }
            }
        };
        xhttp.open("GET", "getsimd.php?pc="+postCode, true);
        xhttp.send();
    }

    function searchByAddr(addr){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){

            if(this.readyState == 4 && this.status == 200){
                let response = JSON.parse(this.responseText);
                //show result card
                document.getElementById("result").style.display = "block";
                //show address and post code on result card header
                document.getElementById("result-pc").innerHTML=addr + " - " + response["Post Code"];

                //show simd
                let simds = response["ranks"];
                let divSimd = document.createElement("div");
                divSimd.id = "simd";
                document.getElementById("result-body").appendChild(divSimd);
                for(const k in simds){
                    document.getElementById('simd').appendChild(createSIMDBox(k, simds[k]));
                }

                //show Cloest POIs
                let pois = response["poi"];
                console.log(pois);
                for(const poi in pois){
                    let p = document.createElement('p');
                    p.innerHTML = "Nearest " + poi + ": " + pois[poi];
                    document.getElementById('result-body').appendChild(p);
                }
            } else {
                console.log(this.status)
            }
        }
        xhttp.open("GET", "getpostcode.php?addr="+addr+"+scotland", true);
        xhttp.send();
    }

    function createSIMDBox(name, rank){
        let total = 6976;
        let grade = Math.ceil((rank / total)*10);

        let card  = document.createElement("div");
        card.classList.add("card", "simd");
        if([1,2,10].includes(grade)){
            card.style.color = "#FFF"
        }
        //color 
        card.style.backgroundColor = "#"+colorGrade[grade]

        card.innerHTML = `<h4>${name}</h3><p>Rank: ${rank}</p><p>Grade: ${grade}</p>`
        return card;
    }
})