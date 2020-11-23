Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'nova-manufacture',
      path: '/nova-manufacture',
      component: require('./components/Tool'),
    },
  ])
})
