<script setup>
import CardStats from "@/Components/Cards/CardStats.vue";
</script>
<template>
    <!-- Header -->
    <div class="relative bg-emerald-600 md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!-- Card stats -->
                <div class="flex flex-wrap">
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="VISITORS"
                            statTitle="350,897"
                            statArrow="up"
                            statPercent="3.48"
                            statPercentColor="text-emerald-500"
                            statDescripiron="Site visitors today"
                            statIconName="far fa-chart-bar"
                            statIconColor="bg-red-500"
                        />
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="CATEGORIES"
                            statTitle="2,356"
                            statArrow="down"
                            statPercent="3.48"
                            statPercentColor="text-red-500"
                            statDescripiron="Count of categories"
                            statIconName="fas fa-chart-pie"
                            statIconColor="bg-orange-500"
                        />
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="POSTS"
                            statTitle="924"
                            statArrow="down"
                            statPercent="1.10"
                            statPercentColor="text-orange-500"
                            statDescripiron="Count of posts"
                            statIconName="fas fa-users"
                            statIconColor="bg-pink-500"
                        />
                    </div>
                    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                        <card-stats
                            statSubtitle="ONLINE VISITORS"
                            statTitle="49,65%"
                            statArrow="up"
                            statPercent="12"
                            statPercentColor="text-emerald-500"
                            statDescripiron="Users on the site at this time"
                            statIconName="fas fa-percent"
                            statIconColor="bg-emerald-500"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
