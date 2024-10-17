<x-app-layout>
    <div class="bg-gray-100 flex flex-col lg:flex-row min-h-screen">

        <!-- Sidebar Navigation -->
        <aside class="bg-gray-800 text-white w-full lg:w-64 min-h-screen p-4">
            <nav>
                <ul class="space-y-2">
                    <!-- Agenda Section -->
                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>Agenda</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('agenda.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Agenda
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('agenda.create') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    Create Agenda
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Users Section -->
                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                <span>Users</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('users.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Users
                                </a>
                            </li>
                        </ul>
                    </li>
        <!-- Events Section -->
                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="fas fa-chart-bar mr-2"></i>
                                <span>Events</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('events.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Events
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('events.create') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    Create Event
                                </a>
                            </li>
                        </ul>
                    </li>
            <!-- Annual Conferences Section -->
                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt mr-2"></i>
                                <span>Annual Conferences</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('conferences.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Conferences
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('conferences.create') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    Create Conference
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--                    <!-- Speakers Section -->--}}
                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="fas fa-microphone mr-2"></i>
                                <span>Speakers</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('speakers.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Speakers
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('speakers.create') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    Create Speaker
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--                    <!-- Tickets Section -->--}}
                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                <span>Tickets</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('tickets.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Tickets
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tickets.create') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    Create Ticket
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--                    <!-- Employees Section -->--}}

                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="fas fa-user-tie mr-2 text-xs"></i>
                                <span>Employees</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('employees.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Employees
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('employees.create') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    Create Employees
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--                    <!--General Info Section -->--}}
                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="far fa-building mr-2"></i>
                                <span>General Info</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('generalInfo.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View General Info
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--                    <!--Blogs Section -->--}}
                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="far fa-newspaper mr-2"></i>
                                <span>Blogs</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('blogs.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Blogs
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('blogs.create') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    Create Blog
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--                    <!--Comments Section -->--}}

                    <li class="dropdown-option">
                        <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                            <div class="flex items-center">
                                <i class="fas fa-comments mr-2"></i>
                                <span>Comments</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                        <ul class="dropdown-menu ml-4 hidden">
                            <li>
                                <a href="{{ route('comments.index') }}"
                                   class="block p-2 hover:bg-gray-700 flex items-center">
                                    <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                    View Comments
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Calendar Area -->
        <div class="bg-gray-100 flex-1 p-4">
            <div x-data="calendar()"
                 class="max-w-full lg:max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-8 p-8">
                <!-- Calendar Header -->
                <div class="flex justify-between items-center mb-6">
                    <button @click="previousMonth()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md">
                        &lt; Prev
                    </button>
                    <div class="text-2xl font-semibold">
                        <span x-text="monthName"></span> <span x-text="year"></span>
                    </div>
                    <button @click="nextMonth()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md">
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
                        <div class="h-24 min-h-[6rem] p-4"></div>
                    </template>

                    <template x-for="day in daysInMonth">
                        <div :class="{
                            'bg-blue-800 text-white': isToday(day),
                            'bg-indigo-200': hasEvent(day),
                            'bg-gray-100 hover:bg-indigo-500 hover:text-white': !isToday(day) && !hasEvent(day)
                        }"
                             class="h-24 min-h-[6rem] p-4 border rounded-lg cursor-pointer transition">
                            <div class="text-lg font-bold" x-text="day"></div>
                            <div class="text-xs text-gray-500" x-text="hasEvent(day) ? hasEvent(day) : ''"></div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dropdownOptions = document.querySelectorAll(".dropdown-option");

                dropdownOptions.forEach(function (option) {
                    option.addEventListener("click", function () {
                        const menu = option.querySelector(".dropdown-menu");
                        menu.classList.toggle("hidden");
                    });
                });
            });

            //calendar
            function calendar() {
                return {
                    month: new Date().getMonth(),
                    year: new Date().getFullYear(),
                    daysInMonth: [],
                    blankDays: [],
                    events: @json($events),
                    conferences: @json($annual_conferences),
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
                            return event.title;
                        }

                        const conference = this.conferences.find(conference => conference.date === dateStr);
                        if (conference) {
                            return conference.title;
                        }

                        return false;
                    },
                    isToday(day) {
                        return this.year === this.currentYear && this.month === this.currentMonth && this.currentDay === day;
                    },
                    calculateDays() {
                        const daysInMonth = this.getDaysInMonth(this.month, this.year);
                        const blankDays = this.getBlankDays(this.month, this.year);

                        this.daysInMonth = Array.from({length: daysInMonth}, (v, k) => k + 1);
                        this.blankDays = Array.from({length: blankDays}, () => '');
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
    </div>
</x-app-layout>
