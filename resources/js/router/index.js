import Vue from 'vue'

import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from "../components/App";
import Home from "../components/Home";
import Login from "../components/auth/Login";
import ForgotPassword from "../components/auth/ForgotPassword";
import Register from "../components/auth/Register";
import Join from "../components/auth/Join";
import Category from "../components/Category";
import Profile from "../components/Profile";
import OrderAd from "../components/OrderAd";
import Page from "../components/Page";
/* Account */
import Dashboard from "../components/account/Dashboard";
import Videos from "../components/account/Videos";
import Account from "../components/account/Account";
import Orders from "../components/account/Orders";
import OrderGift from "../components/OrderGift";
import UserAlerts from "../components/account/UserAlerts";
import Logs from "../components/account/Logs";


const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },
        {
            path: '/login',
            component: Login,
            name: 'login'
        },
        {
            path: '/forgot-password',
            component: ForgotPassword,
            name: 'forgot_password'
        },
        {
            path: '/register',
            component: Register,
            name: 'register'
        },
        {
            path: '/page/:slug',
            component: Page,
            name: 'page'
        },
        {
            path: '/join',
            component: Join,
            name: 'join'
        },
        {
            path: '/category/:id',
            component: Category,
            name: 'category'
        },
        {
            path: '/user/:username',
            component: Profile,
            name: 'profile'
        },
        {
            path: '/order/:id',
            component: OrderAd,
            name: 'order'
        },
        {
            path: '/order-gift/:id',
            component: OrderGift,
            name: 'order_gift'
        },
        {
            path: '/dashboard',
            component: Dashboard,
            name: 'dashboard'
        },
        {
            path: '/videos',
            component: Videos,
            name: 'videos'
        },
        {
            path: '/account',
            component: Account,
            name: 'account'
        },
        {
            path: '/orders',
            component: Orders,
            name: 'orders'
        },
        {
            path: '/alerts',
            component: UserAlerts,
            name: 'alerts'
        },
        {
            path: '/logs',
            component: Logs,
            name: 'logs'
        }
    ]
});

export default routes;
