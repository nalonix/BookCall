<!-- calendar.blade.php -->
<div id="calendar">
    <div class="flex justify-between">
        <button onclick="changeMonth(-1)">⬅️</button>
        <span id="calendarMonth"></span>
        <button onclick="changeMonth(1)">➡️</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        </thead>
        <tbody id="calendarGrid"></tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/available-days')
            .then(response => response.json())
            .then(data => {
                const availableDays = data.availableDays;

                console.log("Available Days:", availableDays);
                // Do something with availableDays
            })
            .catch(error => console.error('Error fetching available days:', error));


        let currentMonth = new Date();

        function renderCalendar() {
            const monthName = currentMonth.toLocaleString('default', {
                month: 'long'
            });
            const year = currentMonth.getFullYear();
            document.getElementById('calendarMonth').textContent = `${monthName} ${year}`;

            const firstDay = new Date(year, currentMonth.getMonth(), 1).getDay();
            const daysInMonth = new Date(year, currentMonth.getMonth() + 1, 0).getDate();

            let grid = "<tr>";
            for (let i = 0; i < firstDay; i++) grid += "<td></td>";

            for (let day = 1; day <= daysInMonth; day++) {
                const date = `${year}-${String(currentMonth.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const isAvailable = availableDays.includes(new Date(date).toLocaleString('en-US', {
                    weekday: 'long'
                }));

                grid += `<td>${isAvailable ? `<button onclick="selectDate('${date}')">${day}</button>` : day}</td>`;

                if ((firstDay + day) % 7 === 0) grid += "</tr><tr>";
            }

            grid += "</tr>";
            document.getElementById('calendarGrid').innerHTML = grid;
        }

        function changeMonth(direction) {
            currentMonth.setMonth(currentMonth.getMonth() + direction);
            renderCalendar();
        }

        window.selectDate = function(date) {
            const event = new CustomEvent('dateSelected', {
                detail: {
                    date
                }
            });
            document.dispatchEvent(event);
        };

        renderCalendar();
    });
</script>