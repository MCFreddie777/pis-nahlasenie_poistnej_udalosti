<style>
    [v-cloak] {
        display: none;
    }
</style>

<template>
    <div class="antialiased sans-serif">
        <div v-cloak>
            <div class="w-64">
                <div class="relative">
                    <input
                        :name="name"
                        type="hidden"
                        ref="date"
                        :required="required"
                        :disabled="disabled"
                    >
                    <input
                        type="text"
                        readonly
                        v-model="datepickerValue"
                        @click="open()"
                        @keydown.escape="showDatepicker = false"
                        class="w-full pl-4 pr-10 py-3 leading-none rounded focus:outline-none text-gray-700 font-medium bg-gray-300"
                        :class="{'border-2 border-red-600':error}"
                        placeholder="Select date"
                        :required="required"
                        :disabled="disabled"
                    >

                    <div
                        class="absolute top-0 right-0 px-3"
                        :class="error ? 'py-3' : 'py-2'"
                        v-if="!disabled"
                    >
                        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <div
                        class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0"
                        style="width: 17rem; z-index:1;"
                        v-show="showDatepicker"
                        @blur="showDatepicker = false"
                        @focusout="showDatepicker = false">

                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <span v-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                                <span v-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                            </div>
                            <div>
                                <button
                                    type="button"
                                    class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                    @click="substractMonth()">
                                    <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                                <button
                                    type="button"
                                    class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                    @click="addMonth()">
                                    <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-3 -mx-1">
                            <template v-for="(day, index) in DAYS">
                                <div style="width: 14.26%" class="px-1">
                                    <div
                                        v-text="day"
                                        class="text-gray-800 font-medium text-center text-xs"></div>
                                </div>
                            </template>
                        </div>

                        <div class="flex flex-wrap -mx-1">
                            <template v-for="blankday in blankdays">
                                <div
                                    style="width: 14.28%"
                                    class="text-center border p-1 border-transparent text-sm"
                                ></div>
                            </template>
                            <template v-for="(date, dateIndex) in no_of_days">
                                <div style="width: 14.28%" class="px-1 mb-1">
                                    <div
                                        @click="getDateValue(date)"
                                        v-text="date"
                                        class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': isToday(date), 'text-gray-700 hover:bg-blue-200': !isToday(date) }"
                                    ></div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: {
            name: {
                default: 'date'
            },
            disabled: {
                type: Boolean,
                default: false
            },
            required: {
                type: Boolean,
                default: false
            },
            value: {
                default: undefined
            },
            error: {
                type: Boolean,
                default: false
            }
        },

        data() {
            return {
                MONTH_NAMES: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                DAYS: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                showDatepicker: false,
                datepickerValue: '',

                month: undefined,
                year: '',
                no_of_days: [],
                blankdays: [],
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            }
        },

        mounted() {
            this.initDate();
            this.getNoOfDays();
        },

        methods: {

            open() {
                this.showDatepicker = !this.showDatepicker;
                this.error = false;
            },

            initDate() {
                const today = this.value ? new Date(this.value) : new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();
                this.datepickerValue = today.toDateString();
                this.$refs.date.value = today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + today.getDate()).slice(-2);
            },


            isToday(date) {
                const today = new Date(new Date().setHours(0, 0, 0, 0));
                const d = new Date(this.year, this.month, date);
                return today.toDateString() === d.toDateString();
            },

            getDateValue(date) {
                let selectedDate = new Date(this.year, this.month, date);
                this.datepickerValue = selectedDate.toDateString();
                this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + (selectedDate.getMonth() + 1)).slice(-2) + "-" + ('0' + selectedDate.getDate()).slice(-2);
                this.showDatepicker = false;
            },

            substractMonth() {
                if (this.month !== 0)
                    this.month--
                else {
                    this.month = 11;
                    this.year--;
                }
                this.getNoOfDays();
            },

            addMonth() {
                if (this.month !== 11)
                    this.month++
                else {
                    this.month = 0;
                    this.year++;
                }
                this.getNoOfDays();
            },

            getNoOfDays() {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                // find where to start calendar day of week
                let dayOfWeek = new Date(this.year, this.month).getDay();
                let blankdaysArray = [];
                for (var i = 1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i);
                }

                let daysArray = [];
                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }

                this.blankdays = blankdaysArray;
                this.no_of_days = daysArray;
            },
        },
    }
</script>
