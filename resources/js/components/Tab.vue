<template>
    <div class="tab-content text-gray-800">

        <div class="header px-10 py-5 text-center">
            <div class="text-white text-2xl uppercase font-semibold tracking-widest">Laracasts</div>
        </div>

        <div class="sub-header px-10 py-2 mb-10 text-gray-400">
            Searching for: "<span class="query font-semibold text-white" v-html="query"></span>"
        </div>

        <div class="layout-col pb-4">

            <div v-if="isLoading" class="text-center">
                <i class="fas fa-spinner fa-spin fa-32 mr-2"></i>
                Searching laracasts.com for "<span v-html="query" class="font-semibold"></span>"
            </div>

            <div v-if="!isLoading && !threads.length" class="text-center">
                There are no threads on
                <a href="https://laracasts.com/discuss" class="font-semibold text-blue-500 hover:text-blue-600">https://laracasts.com/discuss</a>
                that match your problem.
            </div>

            <a v-if="!isLoading && threads.length > 0" v-for="thread in threads" :href="thread.link" target="_blank"
               class="block px-4 py-2 mb-4 border-l-8 rounded flex justify-between items-center"
               :class="thread.answered ? 'border-green-400 bg-green-100 border' : 'border-gray-400 bg-gray-100 hover:border-blue-500'">
                <div>
                    <h3 v-html="thread.title" class="font-semibold mb-2"></h3>

                    <div class="text-xs">
                        <a :href="thread.authorLink" target="_blank" class="uppercase font-bold text-blue-500 hover:text-blue-600"
                           v-html="thread.authorName"></a>
                        <span class="text-gray-500">replied</span>
                        <span class="text-gray-500 font-bold" v-html="thread.updatedAt"></span>
                    </div>
                </div>
                <div v-if="thread.answered">
                    <span class="relative px-3 py-1 text-xs text-white bg-green-500 rounded-full border border-green-400 uppercase font-semibold ml-4">
                        Best Answer
                    </span>
                </div>
            </a>

        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: [
            'meta',
        ],

        inject: [
            'report'
        ],

        data() {
            return {
                isLoading: false,
                query: this.report.message,
                threads: [],
            }
        },

        mounted() {
            this.crawl()
        },

        methods: {
            crawl: function () {
                this.isLoading = true

                axios.post('/ignition-vendor/stefanbauer/ignition-laracasts-tab/search', {
                    'query': this.query,
                }).then(response => {
                    this.threads = response.data
                    this.isLoading = false
                })
            }
        }
    }
</script>

<style scoped>
    .header {
        background-image: -webkit-gradient(linear, left top, right top, from(#5b79a2), to(#2e4469));
        background-image: linear-gradient(90deg, #5b79a2, #2e4469);
    }

    .sub-header {
        background-color: #2e4469;
    }

    @import "../../../node_modules/tailwindcss/dist/utilities.css";
</style>
