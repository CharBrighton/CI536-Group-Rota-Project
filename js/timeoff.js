let current_date = new Date(Date.now());  // Gets current date as Date object

Date.prototype.ymd = function () {  // creating method for Date class which returns the date in YYYY-MM-DD format
    let y = this.getFullYear()
    let m = this.getMonth() + 1
    if (m < 10) {  // Making single digit months have a leading zero for formatting
        m = `0${m}`
    }
    let d = this.getDate();
    if (d < 10) {  // Making single digit days have a leading zero for formatting
        d = `0${d}`
    }

    return `${y}-${m}-${d}`  // Outputting formatted string
}

Date.prototype.nextYear = function () {  // creating method for Date class which creates a new date object for 1 year in the future
    return new Date(this.setFullYear(this.getFullYear() + 1));
}

window.addEventListener("DOMContentLoaded", () => {

    let tomorrow = new Date();
    tomorrow.setDate(current_date.getDate() + 1)

    // Setting minimum and maximum values for date selection input on current request form
    document.getElementById("inpAddRequest").setAttribute("min", tomorrow.ymd());
    document.getElementById("inpAddRequest").setAttribute("max", current_date.nextYear().ymd());

    // Checks if any record exists for each section, displaying a message if none
    check_for_results(document.getElementById("current-scroll"));
    check_for_results(document.getElementById("previous-scroll"));


})

function check_for_results(element) {
    if (element.childElementCount === 1) {  // How many records are in the element, default = 1 (the header)
        // Removes header and creates new 'no results' element
        element.removeChild(element.firstElementChild)
        let no_results = document.createElement("p")
        no_results.innerHTML = "No Results."
        no_results.classList.add("request-div");
        element.appendChild(no_results)
    }
}