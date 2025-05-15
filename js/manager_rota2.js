function getdbshifts() {
    const lwr = ["mon_results", "tue_results", "wed_results", "thu_results", "fri_results", "sat_results", "sun_results"];
    const upr = ["Mon_date", "Tue_date", "Wed_date", "Thu_date", "Fri_date", "Sat_date", "Sun_date"];

    for (let i = 0; i < 7; i++) {
        console.log("iteration " + i);
        setTimeout(() => logic(upr[i], lwr[i]), 2);
    }

    function logic(xdate, xresults) {
        const dateElem = document.getElementById(xdate);
        if (!dateElem) {
            console.error(`Element with id '${xdate}' not found.`);
            return;
        }

        let x = dateElem.getAttribute('data-value');
        console.log("DATA_VALUE: " + x);

        var dataToSend = "date=" + encodeURIComponent(x);
        console.log("DATA TO SEND: " + dataToSend);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../logic/getshiftsforday.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log("Response: " + xhr.responseText);
                    const para = document.getElementById(xresults);
                    if (para) {
                        para.innerHTML = xhr.responseText;
                    } else {
                        console.error(`Element with id '${xresults}' not found.`);
                    }
                } else {
                    console.error("Error FROM XHR:", xhr.status);
                }
            }
        };
        xhr.send(dataToSend);
    }
}
