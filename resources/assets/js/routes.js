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
];

export default new VueRouter({
  routes
});
