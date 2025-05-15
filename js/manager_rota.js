window.addEventListener('load', function () {
    let modifier = 0;

    function rotadates() {
        const today = new Date();
        const dayOfWeek = today.getDay();
        const firstMonday = new Date(today);

        firstMonday.setDate(today.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1));
        firstMonday.setDate(firstMonday.getDate() + modifier);

        const dayNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
        const highlightIds = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];

        for (let i = 0; i < 7; i++) {
            const currentDay = new Date(firstMonday);
            currentDay.setDate(currentDay.getDate() + i);

            const dateElem = document.getElementById(`${dayNames[i]}_date`);
            if (dateElem) {
                dateElem.textContent = currentDay.toDateString().slice(0, 10);
                dateElem.setAttribute('data-value', currentDay.toISOString().split('T')[0]);
            }

            if (modifier === 0 && currentDay.toDateString() === today.toDateString()) {
                document.getElementById(highlightIds[i])?.style.setProperty('background-color', 'yellow');
            } else {
                document.getElementById(highlightIds[i])?.style.removeProperty('background-color');
            }
        }
    }

    function getdbshifts() {
        const dayNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
        const startDateElem = document.getElementById("Mon_date");
        const endDateElem = document.getElementById("Sun_date");

        if (!startDateElem || !endDateElem) {
            console.error("Start or end date elements not found");
            return;
        }

        const startDate = startDateElem.getAttribute("data-value");
        const endDate = endDateElem.getAttribute("data-value");

        if (!startDate || !endDate) {
            console.error("Start or end date data-value missing");
            return;
        }

        fetch("../logic/getshiftsforweek.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}`
        })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(shiftsByDate => {
                dayNames.forEach(dayName => {
                    const dateElem = document.getElementById(`${dayName}_date`);
                    const container = document.getElementById(`${dayName.toLowerCase()}_results`);

                    if (!dateElem || !container) return;

                    const date = dateElem.getAttribute("data-value");

                    container.innerHTML = ""; // clear previous shifts

                    if (shiftsByDate[date] && shiftsByDate[date].length > 0) {
                        shiftsByDate[date].forEach(shift => {
                            const p = document.createElement("p");
                            p.textContent = `${shift.first_name} ${shift.last_name} | Start: ${shift.start_time} | End: ${shift.end_time} | Break: ${shift.break_time}`;
                            container.appendChild(p);
                        });
                    } else {
                        container.innerHTML = "<p>No Shifts For This Date</p>";
                    }
                });
            })
            .catch(error => {
                console.error("Error fetching shifts:", error);
            });
    }

    function updateRota() {
        rotadates();
        getdbshifts();
    }

    updateRota();

    document.querySelector('#prev').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier -= 7;
        updateRota();
    });

    document.querySelector('#next').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier += 7;
        updateRota();
    });

    document.querySelector('#today').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = 0;
        updateRota();
    });
});
