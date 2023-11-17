window.onload = function(){
    var lookup = document.getElementById("lookup");
    var lookupcities = document.getElementById("cities");

    lookup.addEventListener("click", (e)=>{
        e.preventDefault();
        console.log("click");
        var qry = document.getElementById("country").value;
        var rqst = new XMLHttpRequest();
        var url = "http://localhost/info2180-lab5/world.php?country=" + qry;

        rqst.onreadystatechange = function(){
            if(rqst.readyState == XMLHttpRequest.DONE){
                if(rqst.status == 200){
                var cntry = rqst.responseText;
                var result = document.getElementById("result");
                result.innerHTML = cntry;
                
                }else{
                    alert("Something went wrong");
                }
            }
        }
        rqst.open("GET", url, true);
        rqst.send();
    });

    lookupcities.addEventListener("click", (e)=>{
        e.preventDefault();
        console.log("click");
        var qry = document.getElementById("country").value;
        var rqst = new XMLHttpRequest();
        var url = "http://localhost/info2180-lab5/world.php?country=" + qry + "&context=cities";

        rqst.onreadystatechange = function(){
            if(rqst.readyState == XMLHttpRequest.DONE){
                if(rqst.status == 200){
                    var cntry = rqst.responseText;
                    var result = document.getElementById("result");
                    result.innerHTML = cntry;
                
                }else{
                    alert("Something Went Wrong");
                }
            }
        }

        rqst.open("GET", url, true);
        rqst.send();
    });

}