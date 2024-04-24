import './bootstrap';

import { createApp } from "vue";
import CreateTransaction from "./components/CreateTransaction.vue"

createApp()
    .component("create-transaction", CreateTransaction)
    .mount("#app");
