import { createWebHistory, createRouter } from "vue-router";
import Home from "./components/auth/Home.vue";
import Role from "./components/master/Role.vue";
import Kpis from "./components/auth/Kpis.vue";
import Permissions from "./components/master/Permit.vue"
import Brands from "./components/master/Brand.vue"
import Categories from "./components/master/Category.vue"
import Users from "./components/master/User.vue";
import Amc from "./components/master/AmcMaster.vue";

import Customer from "./components/master/Customer.vue"
import CustomerDetails from "./components/customers/CustomerDetails.vue"

import Discount from "./components/master/Discount.vue"
import Departments from "./components/master/Department.vue";

import Products from "./components/product/Product.vue"
import AddProducts from "./components/product/NewProduct.vue"
import Inventory from "./components/product/Inventory.vue";

import Orders from "./components/orders/Order.vue";
import AmcOrder from "./components/amc/Amc.vue";
import AmcOrderDetails from "./components/amc/AmcDetails.vue";
import OrderDetails from "./components/orders/OrderDetails.vue";

const routes = [
  {
    path: "/admin/home",
    name: "Home",
    component: Home,
  },{
    path: "/admin/kpi",
    name: "Kpis",
    component: Kpis,
  },{
    path: "/admin/roles",
    name: "Role",
    component: Role,
  },{
    path: "/admin/permissions/:id",
    name: "Permissions",
    component: Permissions,
  },{
    path: "/admin/users",
    name: "Users",
    component: Users,
  },{
    path: "/admin/brands",
    name: "Brands",
    component: Brands,
  },{
    path: "/admin/categories",
    name: "Categories",
    component: Categories,
  },{
    path: "/admin/departments",
    name: "Departments",
    component: Departments,
  },{
    path: "/admin/amc-master",
    name: "Amc",
    component: Amc,
  },{
    path: "/admin/discount-master",
    name: "Discount",
    component: Discount,
  },{
    path: "/admin/customers",
    name: "Customer",
    component: Customer,
  },{
    path: "/admin/add-products",
    name: "AddProducts",
    component: AddProducts,
  },{
    path: "/admin/products",
    name: "Products",
    component: Products,
  },{
    path: "/admin/inventory",
    name: "Inventory",
    component: Inventory,
  },{
    path: "/admin/orders",
    name: "Orders",
    component: Orders,
  },{
    path: "/admin/amc",
    name: "AmcOrder",
    component: AmcOrder,
  },{
    path: "/admin/order-details/:id",
    name: "OrderDetails",
    component: OrderDetails,
  },{
    path: "/admin/amc-details/:id",
    name: "AmcOrderDetails",
    component: AmcOrderDetails,
  },{
    path: "/admin/customer-details/:id",
    name: "CustomerDetails",
    component: CustomerDetails,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;