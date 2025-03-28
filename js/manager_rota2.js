function getdbshifts() {

    for (let i = 0; i < 7; i++) {
        const lwr = ["mon_results", "tue_results", "wed_results", "thu_results", "fri_results", "sat_results", "sun_results"];
        const upr = ["Mon_date", "Tue_date", "Wed_date", "Thu_date", "Fri_date", "Sat_date", "Sun_date"];

        logic(upr[i], lwr[i]);

    }


    function logic(xdate, xresults) {

        let x = document.getElementById(xdate).getAttribute('data-value');
        console.log(x);

        var dataToSend = "date=" + encodeURIComponent(x);
        // Prepare the data to send
        var xhr = new XMLHttpRequest();
        // Create a new XMLHttpRequest object
        xhr.open("POST", "../logic/getshiftsforday.php", true);
        // Specify the request method, PHP script URL, and asynchronous
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        // Set the content type
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                // Check if the request is complete
                if (xhr.status === 200) {
                    // Check if the request was successful
                    console.log(xhr.responseText);
                    // Output the response from the PHP script
                    const para = document.getElementById(xresults);
                    para.innerHTML = xhr.responseText;
                } else {
                    console.error("Error:", xhr.status);
                    // Log an error if the request was unsuccessful
                }
            }
        };
        xhr.send(dataToSend);
        // Send the data to the PHP script

    }
}