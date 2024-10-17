<x-app-layout>
    <div class="bg-gray-100 flex">
        <!-- Calendar Component -->
        <div x-data="calendar()" class="flex-1 max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-8 p-8">
            <!-- Calendar Header (Month/Year and navigation) -->
            <div class="flex justify-between items-center mb-6">
                <button @click="previousMonth()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md">
                    &lt; Prev
                </button>
                <div class="text-2xl font-semibold">
                    <span x-text="monthName"></span> <span x-text="year"></span>
                </div>
                <button @click="nextMonth()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md">
                    Next &gt;
                </button>
                <button @click="goToToday()" class="ml-4 bg-indigo-600 text-white px-6 py-2 rounded-md">
                    Today
                </button>
            </div>

            <!-- Weekdays -->
            <div class="grid grid-cols-7 text-center font-semibold text-gray-600 mb-4">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>

            <!-- Days -->
            <div class="grid grid-cols-7 gap-4 text-center text-gray-800">
                <template x-for="blankDay in blankDays">
                    <div class="h-24 p-4"></div>
                </template>

                <template x-for="day in daysInMonth">
                    <div :class="{
            'bg-blue-800 text-white': isToday(day),
            'bg-indigo-200': hasEvent(day),
            'bg-gray-100 hover:bg-indigo-500 hover:text-white': !isToday(day) && !hasEvent(day)
        }"
                         class="h-24 p-4 border rounded-lg cursor-pointer transition">
                        <div class="text-lg font-bold" x-text="day"></div>
                        <div class="text-xs text-gray-500" x-text="hasEvent(day) ? hasEvent(day) : ''"></div>
                    </div>
                </template>
            </div>
        </div>
    </div>

        <script>
            function calendar() {
                return {
                    month: new Date().getMonth(),
                    year: new Date().getFullYear(),
                    daysInMonth: [],
                    blankDays: [],
                    events: @json($events), // Pass the events from the controller
                    conferences: @json($annual_conferences), // Pass the conferences from the controller
                    currentDay: new Date().getDate(),
                    currentMonth: new Date().getMonth(),
                    currentYear: new Date().getFullYear(),

                    monthName() {
                        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        return monthNames[this.month];
                    },
                    getDaysInMonth(month, year) {
                        return new Date(year, month + 1, 0).getDate();
                    },
                    getBlankDays(month, year) {
                        return new Date(year, month, 1).getDay();
                    },
                    hasEvent(day) {
                        const dateStr = `${this.year}-${String(this.month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

                        const event = this.events.find(event => event.date === dateStr);
                        if (event) {
                            return event.title; // Assuming your events have a 'title' field
                        }

                        const conference = this.conferences.find(conference => conference.date === dateStr);
                        if (conference) {
                            return conference.title; // Assuming your conferences have a 'title' field
                        }

                        return false; // No event or conference
                    },
                    isToday(day) {
                        return this.year === this.currentYear && this.month === this.currentMonth && this.currentDay === day;
                    },
                    calculateDays() {
                        const daysInMonth = this.getDaysInMonth(this.month, this.year);
                        const blankDays = this.getBlankDays(this.month, this.year);

                        this.daysInMonth = Array.from({ length: daysInMonth }, (v, k) => k + 1);
                        this.blankDays = Array.from({ length: blankDays }, () => '');
                    },
                    nextMonth() {
                        if (this.month === 11) {
                            this.month = 0;
                            this.year++;
                        } else {
                            this.month++;
                        }
                        this.calculateDays();
                    },
                    previousMonth() {
                        if (this.month === 0) {
                            this.month = 11;
                            this.year--;
                        } else {
                            this.month--;
                        }
                        this.calculateDays();
                    },
                    goToToday() {
                        this.month = new Date().getMonth();
                        this.year = new Date().getFullYear();
                        this.calculateDays();
                    },
                    init() {
                        this.calculateDays();
                    }
                };
            }

        </script>


</x-app-layout>


