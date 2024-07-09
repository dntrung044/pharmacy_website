<template>
    <div
        class="mx-auto grid gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:items-start lg:gap-y-10"
    >
        <p class="text-base font-semibold leading-7 text-indigo-600">
            Deploy faster
        </p>
        <h1
            class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
        >
            A better workflow
        </h1>
        <p class="mt-6 text-xl leading-8 text-gray-700">
            Aliquet nec orci mattis amet quisque ullamcorper neque, nibh sem. At
            arcu, sit dui mi, nibh dui, diam eget aliquam. Quisque id at vitae
            feugiat egestas.
        </p>
    </div>
    <p>
        Faucibus commodo massa rhoncus, volutpat. Dignissim sed eget risus enim.
        Mattis mauris semper sed amet vitae sed turpis id. Id dolor praesent
        donec est. Odio penatibus risus viverra tellus varius sit neque erat
        velit. Faucibus commodo massa rhoncus, volutpat. Dignissim sed eget
        risus enim. Mattis mauris semper sed amet vitae sed turpis id.
    </p>
    <ul role="list" class="mt-8 space-y-8 text-gray-600">
        <li class="flex gap-x-3">
            <CloudArrowUpIcon
                class="mt-1 h-5 w-5 flex-none text-indigo-600"
                aria-hidden="true"
            />
            <span
                ><strong class="font-semibold text-gray-900"
                    >Push to deploy.</strong
                >
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Maiores impedit perferendis suscipit eaque, iste dolor
                cupiditate blanditiis ratione.</span
            >
        </li>
        <li class="flex gap-x-3">
            <LockClosedIcon
                class="mt-1 h-5 w-5 flex-none text-indigo-600"
                aria-hidden="true"
            />
            <span
                ><strong class="font-semibold text-gray-900"
                    >SSL certificates.</strong
                >
                Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui
                lorem cupidatat commodo.</span
            >
        </li>
        <li class="flex gap-x-3">
            <ServerIcon
                class="mt-1 h-5 w-5 flex-none text-indigo-600"
                aria-hidden="true"
            />
            <span
                ><strong class="font-semibold text-gray-900"
                    >Database backups.</strong
                >
                Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus.
                Et magna sit morbi lobortis.</span
            >
        </li>
    </ul>
    <p class="mt-8">
        Et vitae blandit facilisi magna lacus commodo. Vitae sapien duis odio id
        et. Id blandit molestie auctor fermentum dignissim. Lacus diam tincidunt
        ac cursus in vel. Mauris varius vulputate et ultrices hac adipiscing
        egestas. Iaculis convallis ac tempor et ut. Ac lorem vel integer orci.
    </p>
    <h2 class="mt-16 text-2xl font-bold tracking-tight text-gray-900">
        No server? No problem.
    </h2>
    <p class="mt-6">
        Id orci tellus laoreet id ac. Dolor, aenean leo, ac etiam consequat in.
        Convallis arcu ipsum urna nibh. Pharetra, euismod vitae interdum mauris
        enim, consequat vulputate nibh. Maecenas pellentesque id sed tellus
        mauris, ultrices mauris. Tincidunt enim cursus ridiculus mi.
        Pellentesque nam sed nullam sed diam turpis ipsum eu a sed convallis
        diam.
    </p>
</template>

<script setup>
import {
    CloudArrowUpIcon,
    LockClosedIcon,
    ServerIcon,
} from "@heroicons/vue/20/solid";
</script>
