window.addEventListener('load', function (evt) {
    const day = new Date();
     console.log(day,"=== date")
    let modifier = 0;
    setTimeout(rotadates, 2);
    setTimeout(getdbshifts, 2);

    //prev button -7 from all dates
    this.document.querySelector('#prev').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = modifier - 7;
        setTimeout(rotadates, 2);
        setTimeout(getdbshifts, 2);
    });

    //next button adds 7 to all dates
    this.document.querySelector('#next').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = modifier + 7;
        setTimeout(rotadates, 2);
        setTimeout(getdbshifts, 2);
    });

    //today button sets modifier to 0
    this.document.querySelector('#today').addEventListener('click', function (evt) {
        evt.preventDefault();
        modifier = 0;
        setTimeout(rotadates, 2);
        setTimeout(getdbshifts, 2);
    });

    function rotadates() {
        const today = new Date();
        const dayOfWeek = today.getDay();
        const firstMonday = new Date(today);

        // Calculate most recent Monday
        firstMonday.setDate(today.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1));

        // Apply modifier (in days)
        firstMonday.setDate(firstMonday.getDate() + modifier);

        const dayNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
        const highlightIds = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];

        for (let i = 0; i < 7; i++) {
            const currentDay = new Date(firstMonday); // clone base Monday
            currentDay.setDate(currentDay.getDate() + i);

            const dateElem = document.getElementById(`${dayNames[i]}_date`);
            if (dateElem) {
                // Display format: e.g., "Mon Jan 15"
                const displayDate = currentDay.toDateString().slice(0, 10);
                dateElem.textContent = displayDate;
                dateElem.setAttribute('data-value', currentDay.toISOString().split('T')[0]);
            }

            // Highlight only if viewing current week and it's today's day
            if (modifier === 0 && currentDay.toDateString() === today.toDateString()) {
                document.getElementById(highlightIds[i])?.style.setProperty('background-color', 'yellow');
            } else {
                document.getElementById(highlightIds[i])?.style.removeProperty('background-color');
            }
        }
    }


});