
const hideShow = document.getElementById("hideShow");
let btn = document.getElementById("hideShowBtn");
const show = () => {

    if(hideShowBtn.innerHTML == "Show more") {
        hideShowBtn.innerHTML = "Show less";
        hideShow.style.whiteSpace = "wrap";
    }
    else {
        hideShowBtn.innerHTML = "Show more"
        hideShow.style.whiteSpace = "nowrap";
    }
}

const info = document.querySelector(".show");
const infoCard = document.querySelector(".infoCard");
const showMoreInfo = () => {
    let btn = document.getElementById("infoBtn");

    if(btn.innerHTML == "Show more") {
        info.style = "display: flex; white-space: wrap; flex-wrap: wrap";
        infoCard.style.display = "block";
        btn.innerHTML = "Show less"
    }
    else {
        info.style = "display: block; white-space: nowrap;"
        infoCard.style.display = "inline-block";
        btn.innerHTML = "Show more"
    }
}