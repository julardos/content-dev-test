<template>
    <Head>
        <title></title>
    </Head>

    <Header>
        <template #menu>
            <Menu :links="this.auth.user.length !== 0 ? menu : menuGuest" />
            <Hamburger
                :active="mobileMenuOpen"
                @click.prevent="mobileMenuOpen = !mobileMenuOpen"
            />
        </template>

        <template #mobile-menu>
            <MobileMenu
                :links="this.auth.user.length !== 0 ? menu : menuGuest"
                v-show="mobileMenuOpen"
            />
        </template>
    </Header>

    <div class="app-page">
        <Notice />

        <div class="app-page__inner">
            <slot />
        </div>
    </div>
</template>

<script>
    import { router } from "@inertiajs/core";

    import Header from "@js/Components/Header.vue";
    import Menu from "@js/Components/Menu.vue";
    import Hamburger from "@js/Components/Hamburger.vue";
    import MobileMenu from "@js/Components/MobileMenu.vue";

    export default {
        name: "App Layout",

        props: {
            auth: {

            }
        },

        components: {
            Header,
            Menu,
            Hamburger,
            MobileMenu,
        },

        data() {
            return {
                menu: [
                    {
                        label: "Home",
                        route: "home",
                        components: ['Home/Index'],
                    },
                    {
                        label: "Your Post",
                        route: "post",
                        components: ['Post/Index'],
                    },
                    {
                        label: "Account",
                        route: "account.edit",
                        components: ['Account/Edit'],
                    },
                    {
                        label: "Logout",
                        route: "logout",
                        method: "post",
                        components: [],
                    },
                ],

                menuGuest: [
                    {
                        label: "Home",
                        route: "home",
                        components: ['Home/Index'],
                    },
                    {
                        label: "Login",
                        route: "login",
                        method: "get",
                        components: ['Login/Show'],
                    },
                    {
                        label: "Register",
                        route: "register",
                        method: "get",
                        components: ['Register/Show'],
                    },
                ],

                mobileMenuOpen: false,
            };
        },

        mounted() {
            console.log(this.auth.user.length !== 0)
            router.on("success", () => {
                this.mobileMenuOpen = false;
            });
        },
    };
</script>

<style lang="scss">
    body {
        background-color: #eee;
    }

    .app-page__inner {
        @extend %d-mv-120;
        @extend %m-mv-20;
        @extend %d-p-60;
        @extend %m-p-20;
        width: 94%;
        max-width: 900px;
        margin-right: auto;
        margin-left: auto;
        background-color: #fff;
    }
</style>
