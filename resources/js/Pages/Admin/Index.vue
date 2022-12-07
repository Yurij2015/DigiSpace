<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import AdminNavbar from "@/Components/Navbars/AdminNavbar.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";
import FooterAdmin from "@/Components/Footers/FooterAdmin.vue";

defineProps(['ordersPerMonth', 'profileImg']);

</script>

<template>
    <Head><title>Admin Panel</title></Head>
    <div>
        <sidebar/>
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar/>
            <HeaderStats/>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div>
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                        <div class="rounded-t bg-white mb-0 px-6 py-6">
                            <div class="text-center flex justify-between">
                                <h6 class="text-blueGray-700 text-xl font-bold">About</h6>
                            </div>
                        </div>
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                HISTORY
                            </h6>
                            <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mt-2">
                                <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tempus at enim hendrerit ultrices. Nunc quis bibendum metus, quis fringilla purus. Etiam vel metus fermentum nunc sagittis commodo eu fermentum diam. Sed ultrices metus mauris, a porttitor odio gravida vel. Curabitur nec leo a purus dignissim tristique nec sit amet mauris. Nam sem velit, vehicula et rutrum eget, malesuada id lectus. Aliquam orci sem, interdum id ultricies eu, fringilla pellentesque ante. Integer feugiat, augue eget ornare auctor, elit libero ullamcorper massa, non elementum dolor risus eget leo. Nulla vitae risus tristique, rhoncus sem et, finibus augue. Nam cursus imperdiet lacus non ullamcorper. Praesent nec viverra augue. Duis massa sapien, faucibus non tellus a, accumsan ullamcorper tellus. Fusce fermentum lacus id arcu accumsan, eu commodo massa efficitur.</p>

                                <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800">Donec blandit tellus ut odio imperdiet congue. Aliquam auctor mauris vitae dolor ultricies tristique. Nunc eget semper tortor. Nullam auctor consectetur felis, ac luctus ex hendrerit a. Donec tincidunt orci velit, nec eleifend nisl tincidunt ac. Sed quis enim varius leo ullamcorper imperdiet. Aenean tincidunt libero in justo maximus, vel dapibus tortor mattis. Etiam at mi est.</p>

                                <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800">Sed convallis nibh sed turpis iaculis facilisis nec volutpat elit. Aliquam erat volutpat. Sed vel enim mauris. Etiam quis mauris sagittis, luctus ex at, molestie libero. Nulla eget sapien hendrerit, pretium mi ut, bibendum tellus. Nunc sed mattis eros. Quisque viverra est id facilisis venenatis. Phasellus elementum euismod finibus. Aenean fringilla volutpat velit, eu porttitor sem rhoncus id. Phasellus at dui vitae ex porta venenatis. Aenean ac commodo risus. Nam quis urna sit amet est viverra cursus.</p>

                                <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800">In augue mi, ullamcorper eu dignissim a, pellentesque vel sem. Etiam lorem nibh, posuere sed posuere vitae, commodo vel quam. Cras semper commodo purus in imperdiet. Donec rutrum libero ac mattis gravida. Donec a dolor vel ipsum posuere elementum eget imperdiet leo. Curabitur dolor nibh, euismod sed feugiat ut, consectetur vel nisi. Cras tortor felis, placerat et ex vel, lacinia laoreet nunc. Maecenas ornare tempus dolor a semper. Nunc pulvinar scelerisque purus, sit amet sagittis risus finibus non. Aliquam porttitor sapien leo, vel congue mi pretium in. Nulla suscipit, mi sit amet accumsan porttitor, diam augue elementum mauris, nec aliquam erat est nec tellus. Sed a lectus ac erat auctor feugiat eu aliquam ex. Suspendisse potenti. Suspendisse ac tortor aliquet, sodales felis ac, luctus mi.</p>

                                <p class="text-base font-light leading-relaxed mt-0 mb-4 text-emerald-800">Mauris dolor dolor, porttitor sed pretium at, pulvinar eu urna. Nullam aliquam malesuada elit, et imperdiet neque ultricies id. Praesent sit amet urna libero. Morbi in faucibus elit. Vivamus non neque pretium, ullamcorper erat at, facilisis lacus. Sed eu feugiat ligula. Curabitur sed nisl sagittis, sodales ante porttitor, congue dolor. Etiam fringilla elit in dui laoreet maximus. Etiam interdum pulvinar malesuada. Donec vehicula condimentum interdum. Maecenas in lacus at neque ullamcorper sagittis in at ex. Morbi elementum arcu eget eros ornare, vitae interdum ligula consequat. Integer at sem ultricies, rhoncus diam ut, mollis libero. Maecenas porta nisl ac lectus posuere consectetur. Sed semper dolor non pretium dictum.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <FooterAdmin/>
            </div>
        </div>
    </div>
</template>
