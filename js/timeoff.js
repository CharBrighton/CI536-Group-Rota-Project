let current_date_int = Date.now()
let current_date_obj = new Date(current_date_int);

Date.prototype.ymd = function () {
    let y = this.getFullYear()
    let m = this.getMonth() + 1
    if (m < 10) {
        m = `0${m}`
    }
    let d = this.getDate();
    return `${y}-${m}-${d}`
}

Date.prototype.nextYear = function () {
    return new Date(this.setFullYear(this.getFullYear() + 1));
}

window.addEventListener("DOMContentLoaded", () => {
    let tomorrow = new Date();
    tomorrow.setDate(current_date_obj.getDate() + 1)
    document.getElementById("inpAddRequest").setAttribute("min", tomorrow.ymd());
    document.getElementById("inpAddRequest").setAttribute("max", current_date_obj.nextYear().ymd());

    check_for_results( current_scroll = document.getElementById("current-scroll"));
    check_for_results( current_scroll = document.getElementById("previous-scroll"));


})

function check_for_results(element) {
    if (element.childElementCount === 1) {
        element.removeChild(current_scroll.firstElementChild)

        let no_results = document.createElement("p")
        no_results.innerHTML = "No Results."
        no_results.classList.add("request-div");
        element.appendChild(no_results)
    }
}