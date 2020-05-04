<template>
    <div>
        <div
            v-if="reviewOpened"
        >
            <h1 class="text-lg mt-10 mb-4 pb-2 border-b-2 border-gray-300 w-1/4">
                Dôvod zamietnutia
            </h1>

            <textarea
                name="review-note"
                class="text-gray-700 w-full bg-gray-300 p-2 rounded focus:outline-none placeholder-gray-500"
                rows="4"
                :required="required"
            >{{note}}</textarea>
        </div>

        <div class="flex flex-row justify-end mt-10">

            <button
                type="submit"
                class="flex justify-center items-center px-3 py-1 focus:outline-none hover:cursor-pointer border border-gray-600 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-full ml-3"
                @click="openReview"
            >
                Zamietnuť s dôvodom
            </button>

            <button
                type="submit"
                class="flex justify-center items-center px-3 py-1 focus:outline-none hover:cursor-pointer bg-red-600 text-white hover:bg-red-500 rounded-full ml-3"
                @click="submit"
                ref="submitButton"
            >
                Schváliť
            </button>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['note'],

        data() {
            return {
                reviewOpened: false,
                required: false,
            }
        },

        methods: {
            openReview(event) {
                if (!this.reviewOpened) {
                    event.preventDefault();
                    this.reviewOpened = true;
                    this.required = true;
                }
            },
            submit() {
                this.required = false;
            }
        }
    }
</script>
