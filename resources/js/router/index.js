import Vue from 'vue'

import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from "../components/App";
import Home from "../components/Home";
import Login from "../components/auth/Login";
import Register from "../components/auth/Register";
import Join from "../components/auth/Join";
import Category from "../components/Category";
import Profile from "../components/Profile";
import OrderAd from "../components/OrderAd";
/* Account */
import Dashboard from "../components/account/Dashboard";
import Videos from "../components/account/Videos";
import Account from "../components/account/Account";
import Orders from "../components/account/Orders";
import OrderGift from "../components/OrderGift";


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
            path: '/register',
            component: Register,
            name: 'register'
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
            path: '/user/:id',
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
        }
    ]
});

export default routes;
