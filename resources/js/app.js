import { initGlobal } from './pages/global';
import { initHome } from './pages/home';
import { initProductDetail } from './pages/product-detail';
import { initAnnouncements } from './pages/announcements';
import { initActivities } from './pages/activities';
import { initLogin } from './pages/login';

document.addEventListener('DOMContentLoaded', () => {
    initGlobal();
    initHome();
    initProductDetail();
    initAnnouncements();
    initActivities();
    initLogin();
});
