import { createWebHistory, createRouter } from "vue-router";
const routes =  [

  {
    path: "/",
    name: "login",
    component: () => import("./components/Login")
  },
  {
    path: "/registration",
    name: "registration",
    component: () => import("./components/Registration")
  },
  {
    path: "/profile",
    name: "profile",
    component: () => import("./components/Profile")
  },
  {
    path: "/user-list",
    name: "user-list",
    component: () => import("./components/Users")
  }
  ,
  {
    path: "/user-role/:id",
    name: "user-role",
    component: () => import("./components/User-Role")
    
  },
  {
    path: "/logout",
    name: "logout",
    component: () => import("./components/Logout")
    
  },
  {
    path: "/create-role",
    name: "create-role",
    component: () => import("./components/Role-Create")
    
  }
];
const router = createRouter({
  history: createWebHistory(),
  routes,
});
router.beforeEach((to ) => {

  if (to.name=="login" && localStorage.getItem("token")) 
  return '/profile'
if (to.name=="profile" && !localStorage.getItem("token")) 
  return '/'
if (to.name=="user-list" && !localStorage.getItem("token")) 
  return '/'
if (to.name=="user-role" && !localStorage.getItem("token")) 
  return '/'
if (to.name=="logout" && !localStorage.getItem("token")) 
  return '/'
if (to.name=="create-role" && !localStorage.getItem("token")) 
  return '/'

})
export default router;