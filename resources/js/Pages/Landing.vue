<script setup>
import Navbar from "@/components/Navbars/AuthNavbar.vue";
import FooterComponent from "@/components/Footers/Footer.vue";
import WidgetHeader from "@/components/Landing/WidgetHeader.vue"
import WidgetMiddleLeft from "@/Components/Landing/WidgetMiddleLeft.vue";
import WidgetMiddleCenter from "@/Components/Landing/WidgetMiddleCenter.vue";
import WidgetMiddleRight from "@/Components/Landing/WidgetMiddleRight.vue";
import WidgetBodyTopLeft from "@/Components/Landing/WidgetBodyTopLeft.vue";
import WidgetBodyTopRight from "@/Components/Landing/WidgetBodyTopRight.vue";
import WidgetBodyTopSecondLeft from "@/Components/Landing/WidgetBodyTopSecondLeft.vue";
import WidgetBodyTopSecondRight from "@/Components/Landing/WidgetBodyTopSecondRight.vue";
import WidgetBodyMiddleTop from "@/Components/Landing/WidgetBodyMiddleTop.vue";
import WidgetBodyMiddleCenter from "@/Components/Landing/WidgetBodyMiddleCenter.vue";
import WidgetBodyBottomTop from "@/Components/Landing/WidgetBodyBottomTop.vue";
import WidgetBodyBottomMiddle from "@/Components/Landing/WidgetBodyBottomMiddle.vue";
import WidgetBodyContactForm from "@/Components/Landing/WidgetBodyContactForm.vue";

const backgroundImage = "background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1267&q=80');"
const props = defineProps(['widgets']);

</script>

<template>
    <div>
        <Navbar/>
        <main>
            <div
                class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75"
            >
                <div
                    class="absolute top-0 w-full h-full bg-center bg-cover"
                    :style=backgroundImage
                >
          <span
              id="blackOverlay"
              class="w-full h-full absolute opacity-75 bg-black"
          ></span>
                </div>
                <div class="container relative mx-auto">
                    <div class="items-center flex flex-wrap">
                        <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                            <div class="pr-12">
                                <WidgetHeader :widgetHeader=props.widgets.widgetHeader></WidgetHeader>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
                    style="transform: translateZ(0);"
                >
                    <svg
                        class="absolute bottom-0 overflow-hidden"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none"
                        version="1.1"
                        viewBox="0 0 2560 100"
                        x="0"
                        y="0"
                    >
                        <polygon
                            class="text-blueGray-200 fill-current"
                            points="2560 0 2560 100 0 100"
                        ></polygon>
                    </svg>
                </div>
            </div>
            <section class="pb-20 bg-blueGray-200 -mt-24">
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap">
                        <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
                            >
                                <div class="px-4 py-5 flex-auto">
                                    <WidgetMiddleLeft
                                        :widgetMiddleLeft=props.widgets.widgetMiddleLeft></WidgetMiddleLeft>
                                </div>
                            </div>
                        </div>

                        <div class="w-full md:w-4/12 px-4 text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
                            >
                                <div class="px-4 py-5 flex-auto">
                                    <WidgetMiddleCenter
                                        :widgetMiddleCenter=props.widgets.widgetMiddleCenter></WidgetMiddleCenter>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
                            >
                                <div class="px-4 py-5 flex-auto">
                                    <WidgetMiddleRight
                                        :widgetMiddleRight=props.widgets.widgetMiddleRight></WidgetMiddleRight>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center mt-32">
                        <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
                            <WidgetBodyTopLeft :widgetBodyTopLeft=props.widgets.widgetBodyTopLeft></WidgetBodyTopLeft>
                        </div>

                        <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
                            <WidgetBodyTopRight
                                :widgetBodyTopRight=props.widgets.widgetBodyTopRight></WidgetBodyTopRight>
                        </div>
                    </div>
                </div>
            </section>

            <section class="relative py-20">
                <div
                    class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20 h-20"
                    style="transform: translateZ(0);"
                >
                    <svg
                        class="absolute bottom-0 overflow-hidden"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none"
                        version="1.1"
                        viewBox="0 0 2560 100"
                        x="0"
                        y="0"
                    >
                        <polygon
                            class="text-white fill-current"
                            points="2560 0 2560 100 0 100"
                        ></polygon>
                    </svg>
                </div>

                <div class="container mx-auto px-4">
                    <div class="items-center flex flex-wrap">
                        <WidgetBodyTopSecondLeft
                            :widgetBodyTopSecondLeft=props.widgets.widgetBodyTopSecondLeft></WidgetBodyTopSecondLeft>

                        <WidgetBodyTopSecondRight
                            :widgetBodyTopSecondRight=props.widgets.widgetBodyTopSecondRight></WidgetBodyTopSecondRight>

                    </div>
                </div>
            </section>

            <section class="pt-20 pb-48">
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap justify-center text-center mb-24">
                        <WidgetBodyMiddleTop
                            :widgetBodyMiddleTop=props.widgets.widgetBodyMiddleTop></WidgetBodyMiddleTop>
                    </div>
                    <div class="flex flex-wrap">
                        <WidgetBodyMiddleCenter
                            :widgetBodyMiddleCenter=props.widgets.widgetBodyMiddleCenter></WidgetBodyMiddleCenter>
                    </div>
                </div>
            </section>

            <section class="pb-20 relative block bg-blueGray-800">
                <div
                    class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20 h-20"
                    style="transform: translateZ(0);"
                >
                    <svg
                        class="absolute bottom-0 overflow-hidden"
                        xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none"
                        version="1.1"
                        viewBox="0 0 2560 100"
                        x="0"
                        y="0"
                    >
                        <polygon
                            class="text-blueGray-800 fill-current"
                            points="2560 0 2560 100 0 100"
                        ></polygon>
                    </svg>
                </div>

                <div class="container mx-auto px-4 lg:pt-24 lg:pb-64">
                    <WidgetBodyBottomTop
                        :widgetBodyBottomTop=props.widgets.widgetBodyBottomTop></WidgetBodyBottomTop>
                    <WidgetBodyBottomMiddle
                        :widgetBodyBottomMiddle=props.widgets.widgetBodyBottomMiddle></WidgetBodyBottomMiddle>
                </div>
            </section>
            <section class="relative block py-24 lg:pt-0 bg-blueGray-800">
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap justify-center lg:-mt-64 -mt-48">
                        <div class="w-full lg:w-6/12 px-4">
                            <div
                                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200"
                            >
                                <WidgetBodyContactForm
                                    :widgetBodyContactForm=props.widgets.widgetBodyContactForm></WidgetBodyContactForm>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <FooterComponent :widgetFooter=props.widgets.widgetFooter></FooterComponent>
    </div>
</template>
