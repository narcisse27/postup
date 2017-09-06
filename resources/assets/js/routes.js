import VueRouter from 'vue-router';

let routes = [
  /*
  {
    path: '/',
    component: require('./views/test')
  }
  */
  {
    path: '/',
    name: 'desk',
    component: require('./views/Desk')
  },/*
   {
   path: '/desk/template',
   component: require('./views/Template')
   },*/
  {
    name: 'template-view',
    path: '/template/:type/:slug',
    component: require('./views/Template')
  },
  {
    path: '/history',
    component: require('./views/Postulation/History')
  },
  {
    path: '/mail-filler',
    component: require('./views/Payment/Payment')
  }
];

export default new VueRouter({
  routes
});
