let current_date_int = Date.now()
let current_date_obj = new Date(current_date_int);
let current_user_id = 27; // TODO: Get ID Dynamically from master JS file (need to know which file that is)

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

    get_json()
    let ymd = current_date_obj.ymd();

    const currentDateInput = document.createElement("input")
    currentDateInput.setAttribute("type", "hidden")
    currentDateInput.setAttribute("name", "currentDate")
    currentDateInput.setAttribute("value", ymd)
    document.getElementById("requestForm").appendChild(currentDateInput)

    const currentUserID = document.createElement("input")
    currentUserID.setAttribute("type", "hidden")
    currentUserID.setAttribute("name", "userID")
    currentUserID.setAttribute("value", current_user_id.toString())
    document.getElementById("requestForm").appendChild(currentUserID)

    let tomorrow = new Date();
    tomorrow.setDate(current_date_obj.getDate() + 1)
    console.log(tomorrow)
    document.getElementById("inpAddRequest").setAttribute("min", tomorrow.ymd());
    document.getElementById("inpAddRequest").setAttribute("max", current_date_obj.nextYear().ymd());
})

async function get_json() {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            insert_dates(JSON.parse(this.responseText))
        }
    }

    xhttp.open("GET", "../logic/get_all_timeoff_requests.php")
    xhttp.send()
}

function append_class(obj, new_class) {
    return `${obj.getAttribute('class')} ${new_class}`;
}

function insert_dates(json) {
    for (const requestID in json) {
        const request = json[requestID]
        console.log(request)
        if (parseInt(request['EmployeeID']) !== current_user_id || request['RequestStatus'] === '-2')  {
            continue;
        }

        const checkbox = document.createElement('input')
        const newDiv = document.createElement('div')
        const datePara = document.createElement('p')
        const requestDatePara = document.createElement('p')
        const requestStatusPara = document.createElement('p')

        checkbox.setAttribute("value",  request['RequestedDate'])
        checkbox.setAttribute("name", "cancel-checkbox")
        checkbox.setAttribute("type", "radio")
        checkbox.setAttribute("form", "requestForm")
        newDiv.setAttribute('class', 'request-div');
        datePara.innerHTML = request['RequestedDate'];
        requestDatePara.innerHTML = request['DateOfRequest'];

        switch (request['RequestStatus']) {
            case '1':
                requestStatusPara.innerHTML = "Accepted";
                newDiv.setAttribute('class', append_class(newDiv, "accepted-row"));
                break;
            case '0':
                requestStatusPara.innerHTML = "Pending";
                newDiv.setAttribute('class', append_class(newDiv, "pending-row"));
                break;
            case '-1':
                requestStatusPara.innerHTML = "Declined";
                newDiv.setAttribute('class', append_class(newDiv, "declined-row"));
                break;
        }

        let upcoming_window = document.getElementById('current-scroll')

        if (Date.parse(request['RequestedDate']) < current_date_int) {
            upcoming_window = document.getElementById('previous-scroll')
        } else {
            newDiv.appendChild(checkbox)
        }

        newDiv.appendChild(datePara);
        newDiv.appendChild(requestDatePara);
        newDiv.appendChild(requestStatusPara);


        upcoming_window.appendChild(newDiv);

    }

}