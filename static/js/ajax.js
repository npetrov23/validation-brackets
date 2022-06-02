
document.querySelector(".button").addEventListener("click",function(e){
    let val = document.querySelector(".bracket_input").value;
    let answer = document.querySelector(".answer")
    let history = document.querySelector(".test")
    let warning = document.querySelector(".warning")

    if(val === "") {
        answer.innerHTML = "";
        warning.innerHTML = '<div class="alert alert-danger" role="alert">Заполните поле!</div>';
    }
    else
    {
        fetch("/vendor/brackets.php/", {
            method: 'POST',
            body: val
        })
        .then(response => response.json())
        .then(function(data) {  
            warning.innerHTML = "";
            answer.innerHTML = '<div class="alert alert-primary text" role="alert">' + data["success"] + '</div>';
            history.insertAdjacentHTML("afterbegin", "<tr><td>" + val + "</td><td>" + data["success"] + "</td></tr>")
         })
    }

})
