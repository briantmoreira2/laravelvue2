import VueRouter from 'vue-router';


let routes=[
{
	path:'/users',
	component:require('./components/Usuarios')
},
{
	path:'/customers',
	component:require('./components/Clientes')
},
{
	path:'/orders',
	component:require('./components/Pedidos')
}
];

export default new VueRouter({
	mode: 'history',
	routes,
	linkActiveClass: 'active'
});
