import './bootstrap';
import dashboard from "./components/dashboard";

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.dashboard = dashboard
Alpine.start();
