import auth from './middleware/auth'
import guest from './middleware/guest'
import subscribed from "./middleware/subscribed";

import Home from './views/Home.vue'
import Login from './views/Login.vue'
import Upload from "./views/Upload";
import Plans from "./views/Plans";
import Checkout from "./views/Checkout";
import Account from "./views/Account";
import Swap from "./views/Swap";
import Download from "./views/Download";
import Register from "./views/Register";

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            middleware: [guest]
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            middleware: [guest]
        }
    },
    {
        path: '/uploads',
        name: 'uploads',
        component: Upload,
        meta: {
            middleware: [auth]
        }
    },
    {
        path: '/plans',
        name: 'plans',
        component: Plans
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
        props: route => ({plan: route.query.plan}),
        meta: {
            middleware: [auth]
        }
    },
    {
        path: '/download/:uuid',
        name: 'download-uuid',
        component: Download,
        props: route => ({uuid: route.params.uuid, token: route.query.token})
    },
    {
        path: '/account',
        name: 'account',
        component: Account,
        meta: {
            middleware: [auth]
        }
    },
    {
        path: '/swap',
        name: 'swap',
        component: Swap,
        meta: {
            middleware: [auth, subscribed]
        }
    }
];
